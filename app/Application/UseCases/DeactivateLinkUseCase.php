<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\LinkRepositoryInterface;
use Illuminate\Support\Carbon;

class DeactivateLinkUseCase
{
    public function __construct(
        readonly private LinkRepositoryInterface $linkRepository
    ) {
    }

    /**
     * @throws \Exception
     */
    public function execute(string $uniqueId): void
    {
        $link = $this->linkRepository->findByUniqueId($uniqueId);
        if (!$link || !$link->isActive || Carbon::now()->gt($link->createdAt->addDays(7))) {
            throw new \Exception('Link is inactive or expired.');
        }

        $this->linkRepository->deactivate($uniqueId);
    }
}
