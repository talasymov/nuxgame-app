<?php

namespace App\Domain\Entities;

use Illuminate\Support\Carbon;

class GameResult
{
    public int $id;
    public int $linkId;
    public int $number;
    public string $result;
    public float $amount;
    public Carbon $createdAt;
}
