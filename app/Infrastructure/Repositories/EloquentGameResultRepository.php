<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\GameResultRepositoryInterface;
use App\Domain\Entities\GameResult;
use App\Models\GameResult as EloquentGameResult;
use Illuminate\Support\Carbon;

class EloquentGameResultRepository implements GameResultRepositoryInterface
{
    public function create(int $linkId, int $number, string $result, float $amount): GameResult
    {
        $eloquentResult = EloquentGameResult::create([
            'link_id' => $linkId,
            'number' => $number,
            'result' => $result,
            'amount' => $amount,
        ]);

        return $this->getGameResult($eloquentResult);
    }

    public function getLastThreeByLinkId(int $linkId): array
    {
        $eloquentResults = EloquentGameResult::where('link_id', $linkId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $results = [];

        foreach ($eloquentResults as $eloquentResult) {
            $gameResult = $this->getGameResult($eloquentResult);

            $results[] = $gameResult;
        }

        return $results;
    }

    /**
     * @param  EloquentGameResult  $eloquentResult
     * @return GameResult
     */
    public function getGameResult(EloquentGameResult $eloquentResult): GameResult
    {
        $gameResult = new GameResult();

        $gameResult->id = $eloquentResult->id;
        $gameResult->linkId = $eloquentResult->link_id;
        $gameResult->number = $eloquentResult->number;
        $gameResult->result = $eloquentResult->result;
        $gameResult->amount = $eloquentResult->amount;
        $gameResult->createdAt = Carbon::parse($eloquentResult->created_at);

        return $gameResult;
    }
}
