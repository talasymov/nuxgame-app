<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\GameResult;

interface GameResultRepositoryInterface
{
    public function create(int $linkId, int $number, string $result, float $amount): GameResult;
    public function getLastThreeByLinkId(int $linkId): array;
}
