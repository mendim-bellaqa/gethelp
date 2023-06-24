<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body class="bg-yellow-300">
    <nav class="bg-yellow-400 sticky top-0 z-50">
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
                    @if(auth()->check())
                        <a href="#" id="user-link" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">{{ auth()->user()->name }}</a>
                    @endif
                    @if(auth()->user()->role == 1)
                        <a href="/admin/dashboard" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Admin Panel</a>
                    @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        <button type="submit">Shkyçu</button>
                    </form>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Shkyçu</a>
                
                    @endif
            </div>
        </div>
    </nav>

    <div class="relative">
        <div id="user-widget" class="hidden absolute inset-x-0 bottom-0 flex flex-col items-center justify-center text-black">
            <div class="p-5 widget-container w-48 h-48">
                <div class="flex h-64 justify-center">
                    <div class="relative">
                        <div class="relative rounded-b border-t-0 z-10 bg-white shadow-xl w-64">
                            <div class="p-2 flex border-b border-gray-100 bg-white hover:bg-gray-100 cursor-pointer">
                                <div class="p-2 w-12">
                                    <img src="https://dummyimage.com/50x50/bababa/0011ff&amp;text=50x50" alt="img product">
                                </div>
                                <div class="flex-auto text-sm w-32">
                                    <div class="font-bold">Përdoruesit:</div>
                                    <div class="truncate text-black-400">
                                        @auth
                                            {{ auth()->user()->name }}
                                        @endauth
                                    </div>
                                    <div class="truncate text-black-400">
                                        @auth
                                             {{ auth()->user()->email }}
                                        @endauth
                                    </div>
                                </div>
                                <div class="flex flex-col w-18 font-medium items-end">
                                    <div class="w-4 h-4 mb-6 hover:bg-red-200 rounded-full cursor-pointer text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 justify-center flex">
                                <a href="/profile/edit">
                                    <button class="text-base undefined hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-700 hover:text-teal-100 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition">Edito profilin</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative  w-full min-h-screen">
            <div class="mt-5">
                <a href="/notes/create" class="relative mt-2">
                    <button class="block uppercase mt-5 mx-auto shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Krojo të re</button>
                </a>

                <div class="grid grid-cols-3 gap-4 m-auto p-8">
                    @foreach($notes as $note)
                        <div class="bg-gray-100 p-16 mb-4 rounded-lg shadow-lg">
                            <!-- <img src="{{ asset('storage/' . $note->photo) }}" alt="Fotoja" class="w-32 h-32 mt-3 rounded"> -->
                            <div class="text-center">
                                <h2 class="text-xl text-black font-medium">{{ $note->title }}</h2>
                                <p class="text-black">{{ $note->description }}</p>
                            </div>
                            <div class="flex col mt-5 space-x-4 align-center justify-center">
                            <a href="{{ route('notes.edit', $note->id) }}">
                                <button class="block uppercase mx-auto shadow bg-gray-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Edito</button>
                            </a>


                            
                            <form method="POST" action="{{ route('notes.destroy', $note->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  button class="block uppercase mx-auto shadow bg-gray-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">{{ __('Fshij') }}</button>
                            </form>

                            </div>
                     
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            document.getElementById('user-link').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('user-widget').classList.toggle('hidden');
            });
        </script>
    </div>
</body>
</html>