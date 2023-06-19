<?php

declare(strict_types=1);

namespace App\Repositories;

use Ploi\Ploi;

final readonly class PloiRepository
{
    public function __construct(
        protected ConfigRepository $config,
        protected Ploi $ploi,
    ) {}
}
