<?php

namespace SardarBackend\RestfulApiHelper;

use Illuminate\Support\ServiceProvider;
use SardarBackend\RestfulApiHelper\RestfulApi\AppendsBuilder;
use SardarBackend\RestfulApiHelper\Console\Commands\ApiRequestCommand;
use SardarBackend\RestfulApiHelper\Console\Commands\ServiceModelCommand;

class RestfulApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('ApiResponseFacade', function(){
            return new AppendsBuilder ;
        });

        if ($this->app->runningInConsole()) {

            $this->commands([
                ApiRequestCommand::class,
                ServiceModelCommand::class,
            ]);

        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
