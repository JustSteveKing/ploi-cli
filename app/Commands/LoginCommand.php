<?php

declare(strict_types=1);

namespace App\Commands;

use App\Repositories\ConfigRepository;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

final class LoginCommand extends Command
{
    protected $signature = 'login {--token= : Ploi API token}';

    protected $description = 'Authenticate with Ploi.';

    public function handle(ConfigRepository $config): int
    {
        $token = $this->option(
            key: 'token',
        );

        if (! $token) {
            $this->components->error(
                string: 'You need to pass your Ploi API token using the token argument.',
            );

            return SymfonyCommand::FAILURE;
        }

        $config->set(
            key: 'token',
            value: $token,
        );

        return SymfonyCommand::SUCCESS;
    }
}
