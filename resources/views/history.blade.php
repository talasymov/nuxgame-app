<x-layout>
    <x-slot:title>
        Game History
    </x-slot>

    <h1 class="text-2xl font-bold mb-6 text-center">Game History</h1>
    <div class="space-y-2">
        @forelse ($results as $result)
            <div class="p-2 bg-gray-700/40 rounded-xl flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <span class="text-sm opacity-50">Number</span>
                    <span>{{ $result->number }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm opacity-50">Result</span>
                    <span
                        @class([
                            'px-2 rounded-xl',
                            'bg-green-500' => $result->result === 'Win',
                            'bg-red-500' => $result->result === 'Lose',
                        ])
                    >{{ $result->result }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm opacity-50">Amount</span>
                    <span>{{ $result->amount }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm opacity-50">Time</span>
                    <span>{{ $result->createdAt }}</span>
                </div>
            </div>
        @empty
            <div class="p-2 bg-gray-700/40 rounded-xl">No game results yet.</div>
        @endforelse
    </div>
    <a href="{{ route('page_a', $uniqueId) }}"
       class="block w-full text-center bg-gray-700 text-white p-2 rounded-xl mt-4 hover:bg-gray-600">Back to Page A</a>
</x-layout>
