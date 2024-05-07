<?php

namespace App\Services\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "help";

    /**
     * @var string Command Description
     */
    protected $description = "Untuk help";

    /**
     * @inheritdoc
     */
    // public function handle($arguments)
    public function handle() {
        $this->replyWithMessage(['text' => SecretConst::getTelegramHelp()]);
    }
}