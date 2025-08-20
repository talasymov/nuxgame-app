<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\LinkRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;

readonly class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private LinkRepositoryInterface $linkRepository
    ) {
    }

    public function execute(string $username, string $phoneNumber): string
    {
        $user = $this->userRepository->create($username, $phoneNumber);
        $link = $this->linkRepository->create($user->id);

        return route('page_a', $link->uniqueId);
    }
}
