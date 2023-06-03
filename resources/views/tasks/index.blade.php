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
                        <a href="#">notes</a>
                    </div>
                    <div class="md:hidden">
                        <button type="button"
                            class="block text-gray-800 hover:text-gray-700 focus:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                <path class="hidden"
                                    d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z" />
                                <path
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row hidden md:block -mx-2">
                    @guest
                    <a href="/login"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Login</a>
                    <a href="/register"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Register</a>
                    @else
                    <a href="#"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">{{ auth()->user()->name }}</a>

                    @if(auth()->user()->role == 1)
                    <a href="/admin/dashboard"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Admin
                        Dashboard</a>
                    @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>

                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    @endif
                </div>
            </div>
        </nav>

        <div class="relative">

            <div class="bg-cover bg-center bg-yellow-600 flex items-center justify-around content-start flex-no-wrap flex-row">
                <!-- tasks -->
                <div id="task-container"
                    class="flex my-8 bg-yellow-900   flex-col space-y-100 justify-center items-center mt-15">
                    @forelse ($tasks as $task)
                    @if(auth()->user()->role == 1 || ($task->addedBy == auth()->user()->id && auth()->user()->role == 0))

                    <div class=" rounded-xl">
                        <div class="flex flex-col p-8 rounded-xl  shadow-xl translate-x-4 translate-y-4 w-96 md:w-auto">
                            <img
                                src="https://cdn-icons-png.flaticon.com/512/351/351501.png?w=740&t=st=1684714193~exp=1684714793~hmac=11791ab8c8f7af7f9a0aa076fa6013c8da75ff97d18a7b67c1dbf3153a492915"
                                class="w-12">
                            <div class="mt-3 text-white font-semibold text-lg">{{ $task->title }}</div>
                            <div
                                class="text-sm text-white font-light w-60 md:w-auto">{{ $task->description }}</div>
                            <div class="my-4">
                                <span class="font-bold text-white text-base">{{ $task->due_date }}-</span>
                                <span class="font-light  text-white text-sm">
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                        class="btn btn-primary text-green-600 bold">{{ __('Ndrysho') }}</a>
                                    <form method="POST"
                                        action="{{ route('tasks.destroy', $task->id) }}"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger text-red-600 ">{{ __('Fshij') }}</button>
                                    </form>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @empty
                    <div class="bg-[#F9ECFF] rounded-xl">
                        <p class="text-gray-600">Nuk ka detyra në dispozicion.</p>
                    </div>
                    @endforelse
                </div>
                <!-- Hero section -->
                <div
                    class="flex items-center justify-center flex-col bg-[#E5E5E5] min-h-screen">

                    <div class="max-w-3xl mx-auto px-4  text-white sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-bold text-white text-center mb-6">
                            Shto një detyrë
                        </h2>
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="flex-1">
                                    <label for="title"
                                        class="block  text-white font-semibold mb-2">
                                        Titulli i detyrës
                                    </label>
                                    <input type="text" name="title" id="title"
                                        class="w-full  text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="flex-1">
                                    <label for="description"
                                        class="block  text-white font-semibold mb-2">
                                        Përshkrimi i detyrës
                                    </label>
                                    <input type="text" name="description"
                                        id="description"
                                        class="w-full  text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="flex-1">
                                    <label for="due_date"
                                        class="block  text-white font-semibold mb-2">
                                        Data e duhur
                                    </label>
                                    <input type="date" name="due_date"
                                        id="due_date"
                                        class="w-full  text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                            <div class="flex justify-center mt-6">
                                <button type="submit"
                                    class="py-2 px-4 bg-gray-800 hover:bg-gray-900     text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Shto detyrën
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
