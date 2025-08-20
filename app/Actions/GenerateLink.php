<?php

namespace App\Actions;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GenerateLink
{
    public function execute(string $unique_id): string
    {
        $currentLink = Link::where('unique_id', $unique_id)->firstOrFail();
        if (!$currentLink || !$currentLink->is_active || Carbon::now()->gt($currentLink->created_at->addDays(7))) {
            abort(403, 'Link is inactive or expired.');
        }

        $newLink = Link::create([
            'unique_id' => Str::uuid(),
            'user_id' => $currentLink->user_id,
        ]);
    }
}
