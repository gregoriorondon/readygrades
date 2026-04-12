<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    protected $table = 'telegram_users';

    protected $fillable = [
        'chat_id',
        'cedula',
        'notificaciones',
    ];

    /**
     * Buscar un usuario de Telegram por su cédula
     */
    public static function findByCedula(string $cedula): ?self
    {
        return static::where('cedula', $cedula)->first();
    }

    /**
     * Buscar un usuario de Telegram por su chat_id
     */
    public static function findByChatId(int $chatId): ?self
    {
        return static::where('chat_id', $chatId)->first();
    }

    /**
     * Actualizar o crear un usuario de Telegram por chat_id
     * Busca por chat_id primero - si existe, actualiza la cédula.
     * Si no existe, crea un nuevo registro.
     */
    public static function updateOrCreateByChatId(int $chatId, string $cedula): self
    {
        return static::updateOrCreate(
            ['chat_id' => $chatId],
            ['cedula' => $cedula]
        );
    }
}
