<?php

namespace App\Http\Controllers;

use App\Application\UseCases\GetGameHistoryUseCase;

class GameResultController extends Controller
{
    public function history(string $uniqueId, GetGameHistoryUseCase $useCase)
    {
        try {
            $results = $useCase->execute($uniqueId);
            return view('history', compact('results', 'uniqueId'));
        } catch (\Exception $e) {
            abort(403, $e->getMessage());
        }
    }
}
