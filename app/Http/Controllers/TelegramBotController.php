<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\Request;

class TelegramBotController extends Controller
{
    protected TelegramBotService $service;

    public function __construct(TelegramBotService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request)
    {
        $this->service->handleUpdate($request->all());
        return response('OK');
    }
}
