<?php

namespace App\Services;

use App\Models\Students;
use App\Models\StudentsCodigoNucleo;
use App\Models\StudentsInscripciones;
use App\Models\Nucleos;
use App\Models\Carreras;
use App\Models\TramoTrayecto;
use App\Models\Notas;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;

use function PHPUnit\Framework\isEmpty;

class TelegramBotService
{
    protected Api $telegram;

    // Constantes para los tipos de estado
    const STATE_WAITING_CEDULA_INFO = 'waiting_cedula_info';
    const STATE_WAITING_CEDULA_NOTAS = 'waiting_cedula_notas';

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Procesar una actualización entrante (puede ser de webhook o polling)
     */
    public function handleUpdate(array $update): void
    {
        // Verificar si es un callback query (botón presionado)
        if (isset($update['callback_query'])) {
            $this->handleCallbackQuery($update['callback_query']);
            return;
        }

        // Verificar si es un mensaje
        if (isset($update['message'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'] ?? '';
            $this->handleMessage($chatId, $text);
        }
    }

    protected function handleCallbackQuery(array $callbackQuery): void
    {
        $chatId = $callbackQuery['from']['id'];
        $data = $callbackQuery['data'];
        $callbackQueryId = $callbackQuery['id'];

        // Responder al callback query inmediatamente
        $this->telegram->answerCallbackQuery(['callback_query_id' => $callbackQueryId]);

        $this->processCallbackData($chatId, $data);
    }

    protected function handleMessage(int $chatId, string $text): void
    {
        $text = trim($text);

        // Verificar si es un comando
        if (str_starts_with($text, '/')) {
            $this->handleCommand($chatId, $text);
            return;
        }

        // Si no es comando, verificar si estamos esperando entrada del usuario
        $this->handleUserInput($chatId, $text);
    }

    protected function handleCommand(int $chatId, string $text): void
    {
        $parts = explode(' ', $text, 2);
        $command = strtolower($parts[0]);
        $argumentString = isset($parts[1]) ? trim($parts[1]) : '';

        if (str_contains($command, '@')) {
            $command = explode('@', $command)[0];
        }

        switch ($command) {
            case '/start':
                $this->askForCedula($chatId);
                break;

            case '/menu':
                $this->sendMainMenu($chatId);
                break;

            case '/help':
                $this->sendHelp($chatId);
                break;

            case '/info':
                $this->sendInfo($chatId);
                break;

            default:
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Comando '$command' no reconocido. Usa /menu para ver las opciones.",
                ]);
                break;
        }
    }

    protected function handleUserInput(int $chatId, string $text): void
    {
        $state = $this->getUserState($chatId);

        if (!$state) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "Usa /menu para ver las opciones disponibles.",
            ]);
            return;
        }

        switch ($state['state']) {
            case self::STATE_WAITING_CEDULA_INFO:
                $student = Students::where('cedula', $text)->first();
                if (!$student) {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "❌ No se encontró ningún estudiante con la cédula: $text\n\nPor favor, intenta con otra cédula.\nNo coloques texto ni caracteres especiales.",
                    ]);
                    return;
                }
                TelegramUser::updateOrCreateByChatId($chatId, $text);
                $this->setUserState($chatId, null);
                $this->sendMainMenu($chatId);
                break;

            default:
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Algo salió mal. Usa /menu para empezar de nuevo.",
                ]);
                $this->setUserState($chatId, null);
                break;
        }
    }

    protected function processCallbackData(int $chatId, string $data): void
    {
        $parts = explode(':', $data);
        $action = $parts[0];
        $param = $parts[1] ?? null;

        $state = $this->getUserState($chatId);

        switch ($action) {
            case 'menu':
                $this->sendMainMenu($chatId);
                break;

            case 'salir':
                $this->handleSalir($chatId);
                break;

            case 'info':
                $telegramUser = TelegramUser::findByChatId($chatId);
                if (!$telegramUser || !Students::where('cedula', $telegramUser->cedula)->exists()) {
                    $this->askForCedula($chatId);
                    return;
                }
                $this->showStudentInfo($chatId, $telegramUser->cedula);
                break;

            case 'notas':
                $telegramUser = TelegramUser::findByChatId($chatId);
                if (!$telegramUser || !Students::where('cedula', $telegramUser->cedula)->exists()) {
                    $this->askForCedula($chatId);
                    return;
                }
                $this->startNotasFlow($chatId, $telegramUser->cedula);
                break;

            case 'nucleo':
                if ($param) {
                    $this->showCarrerasForNucleo($chatId, $param);
                }
                break;

            case 'carrera':
                if ($param) {
                    $this->showTramosForCarrera($chatId, $param);
                }
                break;

            case 'tramo':
                if ($param) {
                    $this->showNotasForTramo($chatId, $param);
                }
                break;

            case 'atras_nucleo':
                $cedula = $state['cedula'] ?? '';
                if ($cedula) {
                    $this->sendNucleosSelection($chatId, $cedula);
                } else {
                    $this->sendMainMenu($chatId);
                }
                break;

            case 'atras_carrera':
                $nucleoId = $state['nucleo_id'] ?? null;
                if ($nucleoId) {
                    $this->showCarrerasForNucleo($chatId, $nucleoId);
                }
                break;

            case 'atras_tramo':
                $carreraId = $state['carrera_id'] ?? null;
                if ($carreraId) {
                    $this->showTramosForCarrera($chatId, $carreraId);
                }
                break;
        }
    }

    protected function getUserState(int $chatId): ?array
    {
        return Cache::get("telegram_state_$chatId");
    }

    protected function setUserState(int $chatId, ?array $state): void
    {
        if ($state === null) {
            Cache::forget("telegram_state_$chatId");
        } else {
            Cache::put("telegram_state_$chatId", $state, now()->addHours(2));
        }
    }

    protected function sendMainMenu(int $chatId): void
    {
        $keyboard = Keyboard::make()->inline();

        $keyboard->row([
            Keyboard::inlineButton(['text' => '👤 Info Estudiante', 'callback_data' => 'info']),
        ]);

        $keyboard->row([
            Keyboard::inlineButton(['text' => '📊 Ver Notas', 'callback_data' => 'notas']),
        ]);

        $keyboard->row([
            Keyboard::inlineButton(['text' => '🚪 Salir', 'callback_data' => 'salir']),
        ]);

        $telegramUser = TelegramUser::findByChatId($chatId);
        $studentName = '';
        if ($telegramUser) {
            $student = Students::where('cedula', $telegramUser->cedula)->first();
            if ($student) {
                $studentName = "\n👤 Estudiante: *$student->primer_name $student->primer_apellido*\n";
            }
        }

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "🎓 *Bienvenido al Bot de ReadyGrades*$studentName\n\nSelecciona una opción:",
            'parse_mode' => 'Markdown',
            'reply_markup' => $keyboard,
        ]);
    }

    protected function sendHelp(int $chatId): void
    {
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "📚 *Comandos disponibles:*\n\n" .
                "/start - Iniciar el bot\n" .
                "/menu - Mostrar menú principal\n" .
                "/help - Mostrar esta ayuda\n" .
                "/info - Información del bot\n",
            'parse_mode' => 'Markdown',
        ]);
    }

    protected function sendInfo(int $chatId): void
    {
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "*Bot de ReadyGrades*\n\n" .
                "Este bot te permite consultar tu información académica y calificaciones si eres estudiante de algún núcleo académico de la UPTTMBI.\n\n" .
                "Usa /menu para comenzar.",
            'parse_mode' => 'Markdown',
        ]);
    }

    protected function askForCedula(int $chatId): void
    {
        $this->setUserState($chatId, ['state' => self::STATE_WAITING_CEDULA_INFO]);
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "*Bienvenido al Bot de ReadyGrades*\n\n" .
                "Por favor, ingresa tu número de cédula para acceder a tu información académica:",
            'parse_mode' => 'Markdown',
        ]);
    }

    protected function handleSalir(int $chatId): void
    {
        $telegramUser = TelegramUser::findByChatId($chatId);
        if ($telegramUser) {
            $student = Students::where('cedula', $telegramUser->cedula)->first();
            $studentName = $student ? " $student->primer_name $student->primer_apellido" : '';
            $telegramUser->delete();
        }

        $this->setUserState($chatId, null);

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "👋 *Sesión cerrada*$studentName\n\n" .
                "Ya no recibirás notificaciones.\n\n" .
                "Usa /start para iniciar sesión.",
            'parse_mode' => 'Markdown',
        ]);
    }

    protected function showStudentInfo(int $chatId, string $cedula): void
    {
        $student = Students::where('cedula', $cedula)->first();

        if (!$student) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontró ningún estudiante con la cédula: $cedula",
            ]);
            return;
        }

        $keyboard = Keyboard::make()->inline();
        $keyboard->row([
            Keyboard::inlineButton(['text' => '🔙 Volver al menú', 'callback_data' => 'menu']),
        ]);

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "👤 *Datos del Estudiante*\n\n" .
                "- Cédula: " . ($student->nacionalidad === "VE" ? "V" : "E") . $student->cedula . "\n" .
                "- Nombre: $student->primer_name $student->segundo_name\n" .
                "- Apellido: $student->primer_apellido $student->segundo_apellido\n" .
                "- Correo: $student->email\n" .
                "- Género: ". ucwords($student->genero) .
                "\n\n=================================\n\n" .
                "Recuerde que la información que puede visualizar por éste medio són sólo dátos públicos, el resto de los datos que ingresaste en la inscripción sólo lo pueden ver personas administrativas de la institución.",
            'parse_mode' => 'Markdown',
            'reply_markup' => $keyboard,
        ]);
    }

    protected function startNotasFlow(int $chatId, string $cedula): void
    {
        $student = Students::where('cedula', $cedula)->first();

        if (!$student) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontró ningún estudiante con la cédula: $cedula",
            ]);
            return;
        }

        $this->setUserState($chatId, ['cedula' => $cedula]);
        $this->sendNucleosSelection($chatId, $cedula);
    }

    protected function sendNucleosSelection(int $chatId, string $cedula): void
    {
        $student = Students::where('cedula', $cedula)->first();
        if (!$student) return;

        $studentCodigoNucleo = StudentsCodigoNucleo::where('students_data_id', $student->id)
            ->with('nucleo')
            ->get();

        if ($studentCodigoNucleo->isEmpty()) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontraron núcleos registrados para este estudiante.",
            ]);
            return;
        }

        $nucleoIds = $studentCodigoNucleo->pluck('nucleo_id')->unique();
        $nucleos = Nucleos::whereIn('id', $nucleoIds)->get();

        if ($nucleos->isEmpty()) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontraron núcleos disponibles.",
            ]);
            return;
        }

        $keyboard = Keyboard::make()->inline();

        foreach ($nucleos as $nucleo) {
            $keyboard->row([
                Keyboard::inlineButton([
                    'text' => "🏛️ " . $nucleo->nucleo,
                    'callback_data' => 'nucleo:' . $nucleo->id
                ]),
            ]);
        }

        $keyboard->row([
            Keyboard::inlineButton(['text' => '🔙 Volver al menú', 'callback_data' => 'menu']),
        ]);

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "🏛️ *Selecciona un Núcleo*\n\nEscoge el núcleo donde deseas ver tus notas:",
            'parse_mode' => 'Markdown',
            'reply_markup' => $keyboard,
        ]);
    }

    protected function showCarrerasForNucleo(int $chatId, string $nucleoId): void
    {
        $state = $this->getUserState($chatId);
        $cedula = $state['cedula'] ?? '';
        $student = Students::where('cedula', $cedula)->first();
        if (!$student) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ Sesión expirada. Usa /menu para empezar de nuevo.",
            ]);
            return;
        }

        $state['nucleo_id'] = $nucleoId;
        $this->setUserState($chatId, $state);

        $studentCodigoNucleo = StudentsCodigoNucleo::where('students_data_id', $student->id)
            ->where('nucleo_id', $nucleoId)
            ->first();

        if (!$studentCodigoNucleo) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontraron carreras para este núcleo.",
            ]);
            return;
        }

        $inscripciones = StudentsInscripciones::where('students_codigo_nucleo_id', $studentCodigoNucleo->id)
            ->with('carreras')
            ->get();

        $carreraIds = $inscripciones->pluck('carrera_id')->unique()->toArray();

        if (empty($carreraIds)) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontraron carreras registradas.",
            ]);
            return;
        }

        $carreras = Carreras::whereIn('id', $carreraIds)->get();
        $keyboard = Keyboard::make()->inline();

        foreach ($carreras as $carrera) {
            $keyboard->row([
                Keyboard::inlineButton([
                    'text' => "🎓 " . $carrera->carrera,
                    'callback_data' => 'carrera:' . $carrera->id
                ]),
            ]);
        }

        $keyboard->row([
            Keyboard::inlineButton(['text' => '⬅️ Atrás', 'callback_data' => 'atras_nucleo']),
            Keyboard::inlineButton(['text' => '🔙 Menú', 'callback_data' => 'menu']),
        ]);

        $nucleo = Nucleos::find($nucleoId);
        $nucleoNombre = $nucleo ? $nucleo->nucleo : 'Núcleo';

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "🎓 *Selecciona una Carrera* en *$nucleoNombre*\n\nEscoge la carrera de la cual deseas ver tus notas:",
            'parse_mode' => 'Markdown',
            'reply_markup' => $keyboard,
        ]);
    }

    protected function showTramosForCarrera(int $chatId, string $carreraId): void
    {
        $state = $this->getUserState($chatId);
        $cedula = $state['cedula'] ?? '';
        $nucleoId = $state['nucleo_id'] ?? null;
        $student = Students::where('cedula', $cedula)->first();
        if (!$student) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ Sesión expirada. Usa /menu para empezar de nuevo.",
            ]);
            return;
        }

        $state['carrera_id'] = $carreraId;
        $this->setUserState($chatId, $state);

        $studentCodigoNucleo = StudentsCodigoNucleo::where('students_data_id', $student->id)
            ->where('nucleo_id', $nucleoId)
            ->first();

        if (!$studentCodigoNucleo) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontró el código del núcleo.",
            ]);
            return;
        }

        $inscripciones = StudentsInscripciones::where('students_codigo_nucleo_id', $studentCodigoNucleo->id)
            ->where('carrera_id', $carreraId)
            ->with('tramoTrayecto.tramos')
            ->get();

        $tramoTrayectoIds = $inscripciones->pluck('tramo_trayecto_id')->unique()->toArray();

        if (empty($tramoTrayectoIds)) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontraron trimestres registrados.",
            ]);
            return;
        }

        $tramosTrayecto = TramoTrayecto::whereIn('id', $tramoTrayectoIds)
            ->with('tramos')
            ->get();

        $keyboard = Keyboard::make()->inline();

        foreach ($tramosTrayecto as $tt) {
            $tramoNombre = $tt->tramos ? $tt->tramos->tramos : 'Tramo ' . $tt->id;
            $keyboard->row([
                Keyboard::inlineButton([
                    'text' => "📚 " . $tramoNombre . " (Trayecto " . $tt->trayecto_id . ")",
                    'callback_data' => 'tramo:' . $tt->id
                ]),
            ]);
        }

        $keyboard->row([
            Keyboard::inlineButton(['text' => '⬅️ Atrás', 'callback_data' => 'atras_carrera']),
            Keyboard::inlineButton(['text' => '🔙 Menú', 'callback_data' => 'menu']),
        ]);

        $carrera = Carreras::find($carreraId);
        $carreraNombre = $carrera ? $carrera->carrera : 'Carrera';

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "📚 *Selecciona un Trimestre* en *$carreraNombre*\n\nEscoge el trimestre del cual deseas ver tus notas:",
            'parse_mode' => 'Markdown',
            'reply_markup' => $keyboard,
        ]);
    }

    protected function showNotasForTramo(int $chatId, string $tramoTrayectoId): void
    {
        $state = $this->getUserState($chatId);
        $cedula = $state['cedula'] ?? '';
        $nucleoId = $state['nucleo_id'] ?? null;
        $carreraId = $state['carrera_id'] ?? null;
        $student = Students::where('cedula', $cedula)->first();
        if (!$student) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ Sesión expirada. Usa /menu para empezar de nuevo.",
            ]);
            return;
        }

        $state['tramo_trayecto_id'] = $tramoTrayectoId;
        $this->setUserState($chatId, $state);

        $studentCodigoNucleo = StudentsCodigoNucleo::where('students_data_id', $student->id)
            ->where('nucleo_id', $nucleoId)
            ->first();

        if (!$studentCodigoNucleo) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontró el código del núcleo.",
            ]);
            return;
        }

        $inscripciones = StudentsInscripciones::where('students_codigo_nucleo_id', $studentCodigoNucleo->id)
            ->where('carrera_id', $carreraId)
            ->where('tramo_trayecto_id', $tramoTrayectoId)
            ->get();

        if ($inscripciones->isEmpty()) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontraron materias registradas para este trimestre.",
            ]);
            return;
        }

        $inscripcionIds = $inscripciones->pluck('id')->toArray();

        $notas = Notas::whereIn('students_inscripcion_id', $inscripcionIds)
            ->with('pensums.materias')
            ->get();

        if ($notas->isEmpty()) {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "❌ No se encontraron calificaciones para este trimestre.",
            ]);
            return;
        }

        $tramoTrayecto = TramoTrayecto::find($tramoTrayectoId);
        $tramoNombre = $tramoTrayecto && $tramoTrayecto->tramos ? $tramoTrayecto->tramos->tramos : 'Tramo';
        $carrera = Carreras::find($carreraId);
        $carreraNombre = $carrera ? $carrera->carrera : 'Carrera';

        $message = "📊 *Calificaciones - $carreraNombre*\n";
        $message .= "📅 Trimestre: $tramoNombre (Trayecto {$tramoTrayecto->trayecto_id})\n\n";

        foreach ($notas as $nota) {
            $materiaNombre = $nota->pensums && $nota->pensums->materias
                ? $nota->pensums->materias->materia
                : 'Materia Desconocida';

            $nota1 = $nota->nota_uno ?? '-';
            $nota2 = $nota->nota_dos ?? '-';
            $nota3 = $nota->nota_tres ?? '-';
            $nota4 = $nota->nota_cuatro ?? '-';
            $recuperacion = $nota->nota_recuperacion ?? '-';

            $suma = $nota1 + $nota2 + $nota3 + $nota4 + $nota->nota_extra;
            $definitiva = $suma / 4;

            $message .= "📝 *" . ucwords($materiaNombre) . "*\n";
            $message .= "- Nota 1: $nota1 | Nota 2: $nota2\n";
            $message .= "- Nota 3: $nota3 | Nota 4: $nota4\n";
            if (!empty($nota->nota_extra)) {
                $message .= "- Nota Extra: ". $nota->nota_extra ."\n";
            }
            $message .= "*- Definitiva $definitiva\n*";
            if ($recuperacion != '-') {
                $message .= "*- Recuperación: $recuperacion\n*";
            }
            $message .= "\n\n";
        }

        $keyboard = Keyboard::make()->inline();
        $keyboard->row([
            Keyboard::inlineButton(['text' => '⬅️ Atrás', 'callback_data' => 'atras_tramo']),
            Keyboard::inlineButton(['text' => '🔙 Menú', 'callback_data' => 'menu']),
        ]);

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown',
            'reply_markup' => $keyboard,
        ]);
    }
}
