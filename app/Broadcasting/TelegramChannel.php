<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;

class TelegramChannel
{
    public $tgbot;

    public $chatId = null;
    
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct($tgbot){
        //
        $this->setTgbot($tgbot);
    }

    /**
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     * @return mixed
     */
    public function send($notifiable, Notification $notification){
        $msg = $notification->toTelegram($notifiable);

        // to do : send msg to user's id
        $ret = $this->tgbot->sendMessage(
            $this->getChatId() ?? config('telegram.ids.main'), 
            $msg
        );

        return $ret;
    }

	public function getTgbot(){
		return $this->tgbot;
	}

	public function setTgbot($tgbot){
		$this->tgbot = $tgbot;

		return $this;
	}

	public function getChatId(){
		return $this->chatId;
	}

	public function setChatId($chatId){
		$this->chatId = $chatId;

		return $this;
	}
}
