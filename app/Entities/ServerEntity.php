<?php

declare(strict_types=1);

namespace App\Entities;

use Carbon\CarbonInterface;

final class ServerEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $type,
        public readonly string $name,
        public readonly string $ip_address,
        public readonly float $php_version,
        public readonly float $mysql_version,
        public readonly int $sites_count,
        public readonly string $status,
        public readonly int $status_id,
        public readonly CarbonInterface $created_at,
    ) {}
}
