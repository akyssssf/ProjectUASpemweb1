<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    public static function kirimPesan($pesan)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        if (!$token || !$chatId) {
            return;
        }

        try {
            Http::timeout(5)->get("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text'    => $pesan,
                'parse_mode' => 'HTML'
            ]);
        } catch (\Throwable $e) {
            Log::warning('Gagal mengirim notifikasi Telegram', [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
