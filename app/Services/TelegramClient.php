<?php

namespace App\Services;

use App\Services\Telegram\Commands\StartCommand;
use App\Services\Telegram\Commands\DummyCommand;
use App\Services\Telegram\Commands\TicketCommand;
use App\Services\Telegram\Commands\HelpCommand;

class TelegramClient{
	function __construct() {
		$this->initTelegramBot()->addCommands();
	}

	public function initTelegramBot(){
		$tgbot = new TelegramBotService(
			config("telegram.bots.default.token")
		);
		$this->tgbot = $tgbot;

		return $this;
	}

	public function addCommands(){
		$this->tgbot->addCommands([
			StartCommand::class,
			DummyCommand::class,
			TicketCommand::class,
			HelpCommand::class,
		]);

		return $this;
	}

	public function message($t="", $data){
		$ret = [];
		switch($t){
			case "new-contact":
				$ret = "Kontak baru: \n".presonRet($data);
			break;
		}
		return $ret;
	}

	/**
	 * send msg to given scheme
	 * 
	 */
	public function send($t="", $data){
		$ret = null;
		switch($t){
			case "admin-group":
				$ret = $this->tgbot->sendMessage(
					config('telegram.ids.main'), 
					$data
				);
			break;
			case "many":
				$cids = $data["tg_chat_ids"];
				foreach($cids as $cid){
					$ret = $this->tgbot->sendMessage(
						$cid, 
						$data["send"]
					);
				}
			break;
		}

		return $ret;
	}

	public function responseToHook(){
		$update = $this->tgbot->telegram->commandsHandler(true);
		// $this->mlogger->logs("app", $update);
    }
}