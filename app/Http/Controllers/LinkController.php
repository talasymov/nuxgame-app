<?php

namespace App\Http\Controllers;

use App\Application\UseCases\DeactivateLinkUseCase;
use App\Application\UseCases\GenerateLinkUseCase;
use App\Application\UseCases\PlayGameUseCase;
use App\Application\UseCases\RegisterUserUseCase;
use App\Domain\Repositories\LinkRepositoryInterface;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class LinkController extends Controller
{
    public function register(RegisterRequest $request, RegisterUserUseCase $useCase)
    {
        $linkUrl = $useCase->execute($request->username, $request->phone_number);

        session()->flash('link', $linkUrl);

        return redirect()->route('home');
    }

    public function pageA(string $uniqueId, LinkRepositoryInterface $linkRepository)
    {
        $link = $linkRepository->findByUniqueId($uniqueId);

        if (!$link) {
            abort(404, 'Link not found.');
        }

        return view('page_a', compact('link'));
    }

    public function handleAction(
        Request $request,
        string $uniqueId,
        GenerateLinkUseCase $generateLinkUseCase,
        DeactivateLinkUseCase $deactivateLinkUseCase,
        PlayGameUseCase $playGameUseCase
    ) {
        $action = $request->input('action');

        try {
            if ($action === 'generate') {
                $newLinkUrl = $generateLinkUseCase->execute($uniqueId);
                session()->flash('link', $newLinkUrl);
            } elseif ($action === 'deactivate') {
                $deactivateLinkUseCase->execute($uniqueId);
                session()->flash('message', 'Link deactivated.');
                return redirect()->route('home');
            } elseif ($action === 'imfeelinglucky') {
                $result = $playGameUseCase->execute($uniqueId);
                session()->flash('game_result', $result);
            }
        } catch (Throwable $e){
            Log::error($e->getMessage());
            abort(403, $e->getMessage());
        }

        return redirect()->route('page_a', $uniqueId);
    }
}
