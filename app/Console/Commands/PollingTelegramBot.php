<?php

namespace App\Console\Commands;

use App\Services\TelegramBotService;
use Illuminate\Console\Command;
use Telegram\Bot\Api;

class PollingTelegramBot extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Procesa actualizaciones del bot de Telegram usando polling';

    public function handle(Api $telegram)
    {
        $service = new TelegramBotService($telegram);

        $this->info('Iniciando polling del bot de Telegram...');

        while (true) {
            $updates = $telegram->getUpdates();
            $lastUpdateId = 0;

            foreach ($updates as $update) {
                $lastUpdateId = $update->getUpdateId();

                // Convertir a array para el servicio
                $updateArray = $update->getRawResponse();

                $service->handleUpdate($updateArray);
                $this->info("Procesado update ID: $lastUpdateId");
            }

            if ($lastUpdateId > 0) {
                $telegram->getUpdates(['offset' => $lastUpdateId + 1]);
            }

            sleep(2);
        }
    }
}
