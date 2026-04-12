<?php

namespace App\Services;

use App\Models\TelegramUser;
use App\Models\Students;
use App\Models\Materias;
use App\Models\Notas;
use Telegram\Bot\Api;

class TelegramNotificationService
{
    protected Api $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Notificar al estudiante cuando se le ingresa una calificación
     */
    public function notifyNewCalificacion(string $cedula, string $materiaNombre, array $notas): bool
    {
        $telegramUser = TelegramUser::findByCedula($cedula);

        if (!$telegramUser) {
            return false;
        }

        // Verificar si el usuario tiene notificaciones activas
        if (!$telegramUser->notificaciones) {
            return false;
        }

        $message = "📝 *Nueva Calificación Registrada*\n\n";
        $message .= "📚 Materia: *$materiaNombre*\n\n";
        $message .= "📊 Calificaciones:\n";

        if (isset($notas['nota_uno'])) {
            $message .= "   Nota 1: {$notas['nota_uno']}\n";
        }
        if (isset($notas['nota_dos'])) {
            $message .= "   Nota 2: {$notas['nota_dos']}\n";
        }
        if (isset($notas['nota_tres'])) {
            $message .= "   Nota 3: {$notas['nota_tres']}\n";
        }
        if (isset($notas['nota_cuatro'])) {
            $message .= "   Nota 4: {$notas['nota_cuatro']}\n";
        }
        if (isset($notas['nota_extra']) && $notas['nota_extra']) {
            $message .= "   Recuperación: {$notas['nota_extra']}\n";
        }

        $message .= "\n_Usted puede consultar sus notas usando /menu_";

        try {
            $this->telegram->sendMessage([
                'chat_id' => $telegramUser->chat_id,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
            return true;
        } catch (\Exception $e) {
            \Log::error("Error enviando notificación Telegram: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Verificar si un estudiante tiene Telegram registrado
     */
    public function hasTelegramUser(string $cedula): bool
    {
        return TelegramUser::where('cedula', $cedula)->exists();
    }

    /**
     * Obtener el chat_id de un estudiante
     */
    public function getChatId(string $cedula): ?int
    {
        $user = TelegramUser::findByCedula($cedula);
        return $user ? $user->chat_id : null;
    }
}
