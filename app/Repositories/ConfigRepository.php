<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

final readonly class ConfigRepository
{
    public function __construct(
        protected string $path,
    ) {}

    public function all(): array
    {
        if (! is_dir(dirname($this->path))) {
            if (!mkdir($concurrentDirectory = dirname($this->path), 0755, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        if (file_exists($this->path)) {
            return json_decode(file_get_contents($this->path), true, 512, JSON_THROW_ON_ERROR);
        }

        return [];
    }

    public function flush(): ConfigRepository
    {
        File::delete($this->path);

        return $this;
    }

    public function get($key, $default = null): array|int|string|null
    {
        return Arr::get($this->all(), $key, $default);
    }

    public function set(string $key, array|string|int $value): ConfigRepository
    {
        $config = $this->all();

        Arr::set($config, $key, $value);

        file_put_contents($this->path, json_encode($config, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));

        return $this;
    }
}
