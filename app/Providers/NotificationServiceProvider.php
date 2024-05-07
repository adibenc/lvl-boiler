<?php

namespace App\Providers;

use App\Broadcasting\TelegramChannel;
use App\Services\TelegramBotService;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('telegram', function () {
                return new TelegramChannel(
                    new TelegramBotService(
                        config("telegram.bots.default.token")
                    )
                );
            });
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
