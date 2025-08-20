<?php

namespace App\Domain\Entities;

use Illuminate\Support\Carbon;

class Link
{
    public int $id;
    public string $uniqueId;
    public int $userId;
    public bool $isActive;
    public Carbon $createdAt;
}
