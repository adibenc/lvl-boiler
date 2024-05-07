<?php

namespace App\Services\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class TicketCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "tiket";

    /**
     * @var string Command Description
     */
    protected $description = "Untuk ticketing";

    protected $pattern = ".*";

    /**
     * @inheritdoc
     */
    // public function handle($arguments)
    public function handle() {
        $tg = $this->getTelegram();
        // $this->replyWithChatAction(['action' => Actions::TYPING]);
        $whu = $tg->getWebhookUpdate();
        $up = [
            "whu" => $whu->message->text,
            "args" => $this->getArguments()
        ];
        
        $msg = ['Tiket diterima: ', presonRet($up), " Tiket no: ####"];
        $this->replyWithMessage(
            ['text' => implode("\n", $msg)]
        );
    }
}