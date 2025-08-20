<x-layout>
    <x-slot:title>
        Welcome to Page A
    </x-slot>

    <h1 class="text-2xl font-bold mb-6 text-center">Welcome to Page A</h1>
    @if (session('link'))
        <div class="mb-4 p-4 bg-lime-700/80 rounded-xl">
            New unique link: <a href="{{ session('link') }}" class="underline">{{ session('link') }}</a>
        </div>
    @endif
    @if (session('message'))
        <div class="mb-4 p-4 bg-lime-700/80 rounded-xl">
            {{ session('message') }}
        </div>
    @endif
    @if (session('game_result'))
        <div class="mb-4 grid grid-cols-3 gap-2">
            @if(!empty(session('game_result')))
                <div class="p-2 bg-gray-700 rounded-2xl flex flex-col items-center gap-1">
                    <span class="text-2xl">{{ session('game_result')['number'] }}</span>
                    <span class="text-xs opacity-50">Number</span>
                </div>
                <div @class([
                    'p-2 rounded-2xl flex flex-col items-center gap-1',
                    'bg-green-500' => session('game_result')['result'] === 'Win',
                    'bg-red-500' => session('game_result')['result'] === 'Lose',
                ])>
                    <span class="text-2xl">{{ session('game_result')['result'] }}</span>
                    <span class="text-xs opacity-50">Result</span>
                </div>
                <div class="p-2 bg-gray-700 rounded-2xl flex flex-col items-center gap-1">
                    <span class="text-2xl">{{ session('game_result')['amount'] }}</span>
                    <span class="text-xs opacity-50">Amount</span>
                </div>
            @endif
        </div>
    @endif
    <form action="{{ route('handle_action', $link->uniqueId) }}" method="POST" class="gap-2 grid grid-cols-2">
        @csrf
        <button type="submit" name="action" value="imfeelinglucky"
                class="w-full bg-yellow-300 text-yellow-800 p-2 rounded-2xl hover:bg-yellow-400 cursor-pointer col-span-2 py-3">
            🎰 I'm Feeling Lucky
        </button>
        <button type="submit" name="action" value="generate"
                class="w-full bg-violet-300 text-violet-800 p-2 transition-all rounded-xl hover:bg-violet-400 cursor-pointer">
            Generate New Link
        </button>
        <button type="submit" name="action" value="deactivate"
                class="w-full bg-red-300 text-red-800 p-2 rounded-xl hover:bg-red-400 cursor-pointer">Deactivate Link
        </button>
        <a href="{{ route('history', $link->uniqueId) }}"
           class="block w-full text-center bg-gray-500 text-white p-2 rounded-xl hover:bg-gray-600 cursor-pointer col-span-2">History</a>
    </form>
</x-layout>
