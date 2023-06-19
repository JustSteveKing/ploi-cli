<?php

declare(strict_types=1);

namespace App\Commands\Servers;

use App\Repositories\PloiRepository;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Throwable;

final class ListServers extends Command
{
    protected $signature = 'servers:list';

    protected $description = 'List all servers you have in your Ploi account.';

    public function handle(PloiRepository $repository): int
    {
        try {
            $servers = $repository->servers()->get();
        } catch (Throwable $exception) {
            $this->components->error(
                string: $exception->getMessage(),
            );

            return SymfonyCommand::FAILURE;
        }

        if (empty($servers->getJson()->data)) {
            $this->components->info(
                string: 'You do not have any servers configured on Ploi right now.',
            );

            return SymfonyCommand::SUCCESS;
        }
    }
}
