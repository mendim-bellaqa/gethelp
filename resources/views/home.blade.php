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
                <a href="/login" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Login</a>
                <a href="/register" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Register</a>
            @else
                <a href="#" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">{{ auth()->user()->name }}</a>

                @if(auth()->user()->role == 1)
                    <a href="/admin/dashboard" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Admin Dashboard</a>
                @endif

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            @endif


            </div>
        </div>
    </nav>
    
    <div class="relative">
        <!-- <div class="sticky top-0 h-screen flex flex-col items-center justify-center bg-green-400">
            <h1 class="text-4xl">Ditari</h1>
            <a href="/notes">      
            <p>Vazhdo</p>
            </a>
        </div> -->
        <div class="sticky top-0 h-screen flex flex-col items-center justify-center bg-yellow-400 text-white">
            <h1 class="text-4xl text-black bold font-extralight">Aktivitetet</h1>
            <a href="/aktivitetet">      
            <p class="text-black">Vazhdo</p>
            </a>
        </div>
    </div>
</div>
</body>
</html>
