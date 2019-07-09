<?php

namespace App\Providers;

use App\ConsoleCommunicator;
use App\Contracts\Communicator;
use App\WebCommunicator;
use Illuminate\Support\ServiceProvider;

class CommunicationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Communicator::class, function ($app) {
            if ($app->runningInConsole()) {
               return new ConsoleCommunicator();
            }

            return new WebCommunicator();
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
