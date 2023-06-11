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
    
    <div class="h-screen bg-yellow-600 flex justify-center items-center">
    <div class="max-w-3xl mx-auto px-4 text-black">
        <h2 class="text-3xl font-bold text-white text-center mb-5">Shto një detyrë</h2>
        <form action="{{ route('tasks.store') }}" class="md:p-8" method="POST">
            @csrf
            <div class="md:p-8">
                <div class="flex-1 w-64 mb-4">
                    <label for="title" class="block text-black font-semibold mb-2">Titulli i detyrës</label>
                    <input type="text" name="title" id="title" class="w-full text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            <div class="flex-1 mb-4">
                <label for="description" class="block text-black font-semibold mb-2">Përshkrimi i detyrës</label>
                <input type="text" name="description" id="description" class="w-full text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="flex flex-col md:flex-row gap-4 mt-4">
                <div class="flex-1">
                    <label for="due_date" class="block text-black font-semibold mb-2">Data e duhur</label>
                    <input type="date" name="due_date" id="due_date" class="w-full text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="flex-1">
                    <label for="due_time" class="block text-black font-semibold mb-2">Ora e skadencës</label>
                    <input id="due_time" type="time" class="w-full text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('due_time') is-invalid @enderror" name="due_time" value="{{ old('due_time') }}" required>
                    @error('due_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-center mt-6">
                <button type="submit" class="py-2 px-4 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Shto detyrën
                </button>
            </div>
        </form>
    </div>
</div>


</div>
</body>
</html>
