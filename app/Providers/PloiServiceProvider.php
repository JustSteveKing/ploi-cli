<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\ConfigRepository;
use App\Repositories\PloiRepository;
use Illuminate\Support\ServiceProvider;
use Ploi\Ploi;

final class PloiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            abstract: PloiRepository::class,
            concrete: function () {
                /**
                 * @var ConfigRepository $config
                 */
                $config = $this->app->make(
                    abstract: ConfigRepository::class,
                );

                return new PloiRepository(
                    config: $config,
                    ploi: (new Ploi())->setApiToken(
                        token: $config->string('token'),
                    ),
                );
            },
        );
    }
}
