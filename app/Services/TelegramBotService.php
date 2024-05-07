<?php
namespace App\Services;

use Telegram\Bot\Api;

class TelegramBotService{
    static $BOT_TOKEN;
    
    function __construct($token) {
        $this->telegram = new Api($token);
        self::$BOT_TOKEN = $token;
    }

    function addCommands($cmds){
        return $this->telegram->addCommands($cmds);
    }

    function getMe(){
        $telegram = $this->telegram;
        $response = $telegram->getMe();

        return $response;
    }

    function getUpdates(){
        $telegram = $this->telegram;
        $response = $telegram->getUpdates();

        return $response;
    }
    
    function removeWebhook(){
        $telegram = $this->telegram;
        $response = $telegram->removeWebhook();

        return $response;
    }
    
    function sendMessage($chatid, $text){
        $telegram = $this->telegram;
        $response = $telegram->sendMessage([
            'chat_id' => $chatid, 
            'text' => $text
        ]);
          
        $messageId = $response->getMessageId();

        return $response;
    }
    
    function setWebHook($url){
        $response = $this->telegram->setWebhook([
            'url' => $url
        ]);
        
        return $response;
    }
}