<?php

namespace App\Services\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Start Command to get you started";

    /**
     * @inheritdoc
     */
    // public function handle($arguments)
    public function handle() {
        $msg = 'Hello! Welcome to our bot, Here are our available commands:';

        // This will update the chat status to typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $commands = $this->getTelegram()->getCommands();

        // // Build the list
        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        // // Reply with the commands list
        $this->replyWithMessage(['text' => $msg."\n".$response]);

        $this->triggerCommand('subscribe');
    }
}