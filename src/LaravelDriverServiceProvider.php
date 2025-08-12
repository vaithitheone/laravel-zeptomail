<?php

namespace ZohoMail\LaravelZeptoMail;

use Illuminate\Mail\MailManager;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use ZohoMail\LaravelZeptoMail\Transport\ZeptoMailTransport;


class LaravelDriverServiceProvider extends ServiceProvider
{


    public function boot()
    {
        $this->app->make(MailManager::class)->extend('zeptomail', function (array $config) {
            $config = array_merge($this->app['config']->get('zeptomail-driver', []), $config);

            $clientOptions = [
                'verify' => Arr::get($config, 'ssl_verify', true), // SSL verification
            ];

            return new ZeptoMailTransport(
                Arr::get($config, 'api_key'),
                Arr::get($config, 'host'),
                $clientOptions
            );


        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-driver.php'),
            ], 'config');
        }
    }
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zeptomail-driver.php', 'zeptomail-driver');
    }
}
