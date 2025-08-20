<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\LinkRepositoryInterface;
use Exception;
use Illuminate\Support\Carbon;

class GenerateLinkUseCase
{
    public function __construct(
        readonly private LinkRepositoryInterface $linkRepository
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(string $uniqueId): string
    {
        $currentLink = $this->linkRepository->findByUniqueId($uniqueId);
        if (!$currentLink || !$currentLink->isActive || Carbon::now()->gt($currentLink->createdAt->addDays(7))) {
            throw new Exception('Link is inactive or expired.');
        }

        $newLink = $this->linkRepository->create($currentLink->userId);
        return route('page_a', $newLink->uniqueId);
    }
}
