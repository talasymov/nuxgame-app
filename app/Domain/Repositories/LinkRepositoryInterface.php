<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Link;

interface LinkRepositoryInterface
{
    public function create(int $userId): Link;
    public function findByUniqueId(string $uniqueId): ?Link;
    public function deactivate(string $uniqueId): void;
}
