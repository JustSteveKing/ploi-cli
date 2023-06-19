<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\ConfigRepository;
use Illuminate\Support\ServiceProvider;

final class ConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConfigRepository::class, function () {
            $path = isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'testing'
                ? base_path('tests')
                : ($_SERVER['HOME'] ?? $_SERVER['USERPROFILE']);

            $path .= '/.config/ploi/config.json';

            return new ConfigRepository(
                path: $path,
            );
        });
    }
}
