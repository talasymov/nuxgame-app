<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\GameResultRepositoryInterface;
use App\Domain\Repositories\LinkRepositoryInterface;
use Illuminate\Support\Carbon;

class GetGameHistoryUseCase
{
    public function __construct(
        readonly private LinkRepositoryInterface $linkRepository,
        readonly private GameResultRepositoryInterface $gameResultRepository
    ) {
    }

    /**
     * @throws \Exception
     */
    public function execute(string $uniqueId): array
    {
        $link = $this->linkRepository->findByUniqueId($uniqueId);
        if (!$link || !$link->isActive || Carbon::now()->gt($link->createdAt->addDays(7))) {
            throw new \Exception('Link is inactive or expired.');
        }

        return $this->gameResultRepository->getLastThreeByLinkId($link->id);
    }
}
