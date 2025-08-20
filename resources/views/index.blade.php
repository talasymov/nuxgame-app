<x-layout>
    <x-slot:title>
        Register - Lucky Link
    </x-slot>

    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
    @if (session('link'))
        <div class="mb-4 p-4 bg-lime-700/80 rounded-xl">
            Your unique link: <a href="{{ session('link') }}" class="underline">{{ session('link') }}</a>
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-4 flex flex-col gap-2">
            @foreach ($errors->all() as $error)
                <div class="bg-red-700/40 rounded-xl p-2 text-sm">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="username" class="block text-sm p-1 opacity-50">Username</label>
            <input type="text" name="username" id="username" required class="w-full p-2 outline-none rounded-xl bg-gray-700/40">
        </div>
        <div>
            <label for="phone_number" class="block text-sm p-1 opacity-50">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" required class="w-full p-2 outline-none rounded-xl bg-gray-700/40">
        </div>
        <button type="submit" class="w-full bg-violet-700 text-white p-2 rounded-2xl hover:bg-violet-600 cursor-pointer">Register</button>
    </form>
</x-layout>

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Register - Lucky Link</title>--}}
{{--    @vite(['resources/css/app.css'])--}}
{{--</head>--}}
{{--<body class="bg-gray-100 flex items-center justify-center min-h-screen">--}}
{{--<div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">--}}
{{--    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>--}}
{{--    @if (session('link'))--}}
{{--    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">--}}
{{--        Your unique link: <a href="{{ session('link') }}" class="underline">{{ session('link') }}</a>--}}
{{--    </div>--}}
{{--    @endif--}}
{{--    @if ($errors->any())--}}
{{--    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--            <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    @endif--}}
{{--    <form action="{{ route('register') }}" method="POST" class="space-y-4">--}}
{{--        @csrf--}}
{{--        <div>--}}
{{--            <label for="username" class="block text-sm font-medium">Username</label>--}}
{{--            <input type="text" name="username" id="username" required class="w-full p-2 border rounded">--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label for="phone_number" class="block text-sm font-medium">Phone Number</label>--}}
{{--            <input type="text" name="phone_number" id="phone_number" required class="w-full p-2 border rounded">--}}
{{--        </div>--}}
{{--        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Register</button>--}}
{{--    </form>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
