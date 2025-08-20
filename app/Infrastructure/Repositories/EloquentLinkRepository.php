<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\LinkRepositoryInterface;
use App\Models\Link as EloquentLink;
use App\Domain\Entities\Link;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class EloquentLinkRepository implements LinkRepositoryInterface
{

    public function create(int $userId): Link
    {
        $eloquentLink = EloquentLink::create([
            'unique_id' => Str::uuid(),
            'user_id' => $userId,
            'is_active' => true,
        ]);

        $link = new Link();

        $link->id = $eloquentLink->id;
        $link->uniqueId = $eloquentLink->unique_id;
        $link->userId = $eloquentLink->user_id;
        $link->isActive = $eloquentLink->is_active;
        $link->createdAt = Carbon::parse($eloquentLink->created_at);

        return $link;
    }

    public function findByUniqueId(string $uniqueId): ?Link
    {
        $eloquentLink = EloquentLink::where('unique_id', $uniqueId)->first();

        if (!$eloquentLink) {
            return null;
        }

        $link = new Link();

        $link->id = $eloquentLink->id;
        $link->uniqueId = $eloquentLink->unique_id;
        $link->userId = $eloquentLink->user_id;
        $link->isActive = $eloquentLink->is_active;
        $link->createdAt = Carbon::parse($eloquentLink->created_at);

        return $link;
    }

    public function deactivate(string $uniqueId): void
    {
        EloquentLink::where('unique_id', $uniqueId)->update(['is_active' => false]);
    }
}
