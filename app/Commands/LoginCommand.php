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
        ) ?? $this->components->ask(
            question: 'Please enter your Ploi API Token.',
        );

        $config->set(
            key: 'token',
            value: $token,
        );

        return SymfonyCommand::SUCCESS;
    }
}
