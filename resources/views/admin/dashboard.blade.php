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

                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Shkyçu</a>
                    @endif
                </div>

            </div>
        </div>
    </nav>
    
    <div class="relative ">
        <div id="user-widget" class=" hidden  inset-x-0 bottom-0 flex flex-col items-center justify-center  text-black">
            <div class="top-5 ">
                <!-- component -->
                    <div class="p-5 widget-container  w-48 h-48" id="user-widget ">
                        <div class="flex h-64 justify-center">
                            <div class="relative ">
                            
                                <div class="relatve   rounded-b border-t-0 z-10">
                                    <div class="shadow-xl w-64">
                                        <div class="p-2 flex bg-white hover:bg-gray-100 cursor-pointer border-b border-gray-100" style="">
                                            <div class="p-2 w-12"><img src="https://dummyimage.com/50x50/bababa/0011ff&amp;text=50x50" alt="img product"></div>
                                            <div class="flex-auto text-sm w-32">
                                                <div class="font-bold">Përdoruesit: </div>
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
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="p-4 justify-center flex">
                                            <a href="/profile/edit" >
                                                <button class="text-base  undefined  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer 
                                                    hover:bg-teal-700 hover:text-teal-100 
                                                    bg-teal-100 
                                                    text-teal-700 
                                                    border duration-200 ease-in-out 
                                                    border-teal-600 transition">Edito profilin
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-32">
            <div class=" text-black relative ">
            <div class="top-0 flex flex-col justify-center text-black">
    <div class="items-center mb-64 h-56">
        <div class="mt-5">
            <h1 class="text-center font-bold">Te gjithë përdoruesit</h1>
            <div class="flex items-center justify-center mt-8">
                <div class="w-3/4 mx-auto">
                    <table class="w-full text-center bg-white rounded-lg shadow-lg">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 bg-gray-200">ID</th>
                                <th class="px-4 py-2 bg-gray-200">Emri</th>
                                <th class="px-4 py-2 bg-gray-200">Email</th>
                                <th class="px-4 py-2 bg-gray-200">Roli</th>
                            </tr>
                        </thead>
                        <tbody class="m-16 text-center align-bottom justify-center">
                            @foreach ($users as $user)
                            <tr>
                                <td class="px-8 py-8">{{ $user->id }}</td>
                                <td class="px-8 py-8">{{ $user->name }}</td>
                                <td class="px-8 py-8">{{ $user->email }}</td>
                                <td class="px-8 py-8">
                                    @if($user->role == 0)
                                        Përdorues i thjeshtë
                                    @elseif($user->role == 1)
                                        Administrator
                                    @endif
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


                <div class="grid grid-row-4 gap-4 mt-64 p-8">
                    
                <h1 class="text-center font-mono" >Te gjitha detyrat</h1>
                    @foreach($tasks as $task)
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="text-lg font-bold">{{ $task->title }}</div>
                            <div class="text-gray-500">{{ $task->description }}</div>
                            <div class="text-gray-500">{{ $task->created_at->format('d/m/Y H:i:s') }}</div>
                            <div class="flex justify-end mt-4 justify-items-center   ">
                                <a href="{{ route('tasks.edit', $task->id) }}">
                                    <button class="uppercase mx-auto shadow bg-gray-800 hover:bg-indigo-700 mr-5 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Edito</button>
                                </a>
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" button class="uppercase mx-auto shadow bg-gray-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">{{ __('Fshij') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="top-0  flex flex-col  justify-center text-black">
                    <div class="items-center mb-64  h-56">
                        <div class="mt-5">
                            <h1 class="text-center font-bold">Te gjitha artikujt e ditareve</h1>
                            <div class="flex items-center justify-center mt-8">
                                <div class="w-3/4 mx-auto">
                                    <table class="w-full text-center bg-white rounded-lg shadow-lg">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 bg-gray-200">ID</th>
                                                <th class="px-4 py-2 bg-gray-200">Emri</th>
                                                <th class="px-4 py-2 bg-gray-200">Data</th>
                                            </tr>
                                        </thead>
                                        <tbody class="m-16 text-center align-bottom justify-center" >
                                            @foreach ($notes as $note)
                                            <tr>
                                                <td class="px-8 py-8">{{ $note->title }}</td>
                                                <td class="px-8 py-8">{{ $note->description }}</td>
                                                <td class="px-8 py-8">{{ $note->created_at->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('user-link').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('user-widget').classList.toggle('hidden');
});

</script>
</body>
</html>