<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\GameResultRepositoryInterface;
use App\Domain\Repositories\LinkRepositoryInterface;
use Illuminate\Support\Carbon;
use Random\RandomException;

class PlayGameUseCase
{
    public function __construct(
        readonly private LinkRepositoryInterface $linkRepository,
        readonly private GameResultRepositoryInterface $gameResultRepository
    ) {
    }

    /**
     * @throws RandomException
     * @throws \Exception
     */
    public function execute(string $uniqueId): array
    {
        $link = $this->linkRepository->findByUniqueId($uniqueId);
        if (!$link || !$link->isActive || Carbon::now()->gt($link->createdAt->addDays(7))) {
            throw new \Exception('Link is inactive or expired.');
        }

        $number = random_int(1, 1000);
        $result = $number % 2 === 0 ? 'Win' : 'Lose';
        $amount = $result === 'Win' ? $this->calculateWinAmount($number) : 0;

        $this->gameResultRepository->create($link->id, $number, $result, $amount);

        return [
            'number' => $number,
            'result' => $result,
            'amount' => $amount,
        ];
    }

    private function calculateWinAmount(int $number): float
    {
        if ($number > 900) return $number * 0.7;
        if ($number > 600) return $number * 0.5;
        if ($number > 300) return $number * 0.3;
        return $number * 0.1;
    }
}
