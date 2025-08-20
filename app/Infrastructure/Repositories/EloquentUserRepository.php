<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Entities\User;
use App\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(string $username, string $phoneNumber): User
    {
        $eloquentUser = EloquentUser::create([
            'username' => $username,
            'phone_number' => $phoneNumber,
        ]);

        $user = new User();

        $user->id = $eloquentUser->id;
        $user->username = $eloquentUser->username;
        $user->phoneNumber = $eloquentUser->phone_number;

        return $user;
    }
}
