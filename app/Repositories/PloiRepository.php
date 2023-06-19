<?php

declare(strict_types=1);

namespace App\Repositories;

use Ploi\Ploi;
use Ploi\Resources\Server;

final readonly class PloiRepository
{
    public function __construct(
        protected ConfigRepository $config,
        protected Ploi $ploi,
    ) {}

    public function servers(): Server
    {
        return $this->ploi->servers();
    }
}
