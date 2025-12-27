<?php

namespace App\Services;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

class TelegramNotify
{
    /**
     * Send Telegram notification
     * 
     * @param string|null $message The message to send
     * @param string|null $chatId Optional chat ID (uses default from config if not provided)
     * @return mixed|false Returns the Telegram response object on success, false on failure
     */
    public static function T_NOTIFY(?string $message = null, ?string $chatId = null)
    {
        try {
            // Get bot token from config (check multiple sources)
            $botToken = config('telegram.bots.mybot.token');
            if (empty($botToken)) {
                $botToken = config('values.telegram_bot_token');
            }
            if (empty($botToken)) {
                $botToken = env('TELEGRAM_BOT_TOKEN');
            }
            
            // Get chat ID from parameter or config
            if (empty($chatId)) {
                $chatId = config('values.telegram_chat_id');
            }
            if (empty($chatId)) {
                $chatId = env('TELEGRAM_CHAT_ID');
            }
            
            // Validate required parameters
            if (empty($botToken)) {
                Log::error('Telegram notification failed: Bot token not configured');
                return false;
            }
            
            if (empty($chatId)) {
                Log::error('Telegram notification failed: Chat ID not configured');
                return false;
            }
            
            if (empty($message)) {
                Log::warning('Telegram notification skipped: Empty message');
                return false;
            }
            
            // Send message using Telegram SDK
            // Use the bot directly with token if config doesn't work
            try {
                $response = Telegram::bot('mybot')->sendMessage([
                    'chat_id' => $chatId,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ]);
            } catch (\Exception $e) {
                // Fallback: create API instance directly with token
                $api = new \Telegram\Bot\Api($botToken);
                $response = $api->sendMessage([
                    'chat_id' => $chatId,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ]);
            }
            
            Log::info('Telegram notification sent successfully', [
                'chat_id' => $chatId,
                'message_id' => $response->messageId ?? ($response->get('message_id') ?? null),
            ]);
            
            return $response;
            
        } catch (\Exception $e) {
            Log::error('Telegram notification error: ' . $e->getMessage(), [
                'exception' => $e,
                'message' => $message ?? 'N/A',
                'chat_id' => $chatId ?? 'N/A',
            ]);
            return false;
        }
    }
    
    /**
     * Send lead notification to Telegram
     * 
     * @param \App\Models\Lead $lead The lead model instance
     * @return mixed|false Returns the Telegram response object on success, false on failure
     */
    public static function notifyNewLead($lead)
    {
        if (!$lead) {
            return false;
        }
        
        $message = "🔔 <b>New Lead Received</b>\n\n";
        $message .= "📋 <b>Type:</b> " . ucfirst($lead->type ?? 'Contact') . "\n";
        $message .= "👤 <b>Name:</b> " . htmlspecialchars($lead->name ?? 'N/A') . "\n";
        
        if ($lead->email) {
            $message .= "📧 <b>Email:</b> " . htmlspecialchars($lead->email) . "\n";
        }
        
        if ($lead->phone) {
            $message .= "📱 <b>Phone:</b> " . htmlspecialchars($lead->phone) . "\n";
        }
        
        if ($lead->subject) {
            $message .= "📌 <b>Subject:</b> " . htmlspecialchars($lead->subject) . "\n";
        }
        
        if ($lead->message) {
            $messageText = htmlspecialchars($lead->message);
            // Truncate long messages
            if (strlen($messageText) > 500) {
                $messageText = substr($messageText, 0, 500) . '...';
            }
            $message .= "💬 <b>Message:</b> " . $messageText . "\n";
        }
        
        $message .= "\n🕐 <b>Time:</b> " . $lead->created_at->format('Y-m-d H:i:s') . "\n";
        $message .= "🆔 <b>Lead ID:</b> #" . $lead->id;
        
        return self::T_NOTIFY($message);
    }
}

