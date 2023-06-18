<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@1.2.0/dist/tailwind.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
<!-- component -->
<div class="w-full">
<nav class="bg-yellow-300 w-full sticky top-0 fixed shadow-lg" style="z-index: 9999;">
        <div class="md:flex items-center justify-between py-2 px-8 md:px-12">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800 md:text-3xl">
                    <a href="/">notes</a>
                </div>
                <div class="md:hidden">
                    <button type="button" class="block text-gray-800 hover:text-gray-700 focus:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path class="hidden" d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
                            <path d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row hidden md:block -mx-2">
            @guest
            <a href="/login" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Lidhu</a>
                <a href="/register" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Regjistrohu</a>
            @else
                <a href="#" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">{{ auth()->user()->name }}</a>

                @if(auth()->user()->role == 1)
                    <a href="/admin/dashboard" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Admin Panel</a>
                @endif

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Shkycu</a>
            @endif


            </div>
        </div>
    </nav>
    
    <div class="h-screen bg-yellow-600 flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white border border-gray-300 rounded-md p-6">
            <h2 class="text-2xl text-gray-700 mb-6">{{ __('Ndrysho Detyrën') }}</h2>

            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-medium mb-1">{{ __('Titulli') }}</label>
                    <input id="title" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600" name="title" value="{{ old('title', $task->title) }}" required autofocus>
                    @error('title')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-medium mb-1">{{ __('Përshkrimi') }}</label>
                    <textarea id="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600" name="description" required>{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                @php
                    $dueDate = \Carbon\Carbon::parse($task->due_date)->format('Y-m-d');
                    $dueTime = \Carbon\Carbon::parse($task->due_time)->format('H:i');
                @endphp

                <div class="mb-6">
                    <label for="due_date" class="block text-gray-700 font-medium mb-1">{{ __('Data e skadencës') }}</label>
                    <input id="due_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600" name="due_date" value="{{ old('due_date', $dueDate) }}" required>
                    @error('due_date')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="due_time" class="block text-gray-700 font-medium mb-1">{{ __('Ora e skadencës') }}</label>
                    <input id="due_time" type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600" name="due_time" value="{{ old('due_time', $dueTime) }}" required>
                    @error('due_time')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-md">{{ __('Ruaj ndryshimet') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


    
    </div>
    </div>
</div>

</div>
</body>
</html>


