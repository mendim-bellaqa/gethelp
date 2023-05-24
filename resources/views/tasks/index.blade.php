@extends('layouts.app')

@section('content')
<!-- Resti i kodit tuaj -->
<!-- main card -->
<div class="bg-cover bg-center bg-indigo-600 flex items-center justify-around content-start flex-no-wrap flex-row" >

    <div class="flex flex-col justify-center items-left text-center">
        <div class="max-w-sm text-white text-center font-bold font-sans">
            Lista e devyrave tuaja
        </div>
        <div class="font-light text-white text-center max-w-lg mt-5 text-sm">
            Lista e detyrave, qellimeve ditore, planifikimi, permbushja e projektit...
        </div>
    </div>
    

    <!-- tasks -->
    <div id="task-container" class="flex my-8 bg-gray-900   flex-col space-y-100 justify-center items-center mt-15">
        @forelse ($tasks as $task)
            <div class=" rounded-xl">
                <div class="flex flex-col p-8 rounded-xl  shadow-xl translate-x-4 translate-y-4 w-96 md:w-auto">
                    <img src="https://cdn-icons-png.flaticon.com/512/351/351501.png?w=740&t=st=1684714193~exp=1684714793~hmac=11791ab8c8f7af7f9a0aa076fa6013c8da75ff97d18a7b67c1dbf3153a492915" class="w-12">
                    <div class="mt-3 text-white font-semibold text-lg">{{ $task->title }}</div>
                    <div class="text-sm text-white font-light w-60 md:w-auto">{{ $task->description }}</div>
                    <div class="my-4">
                        <span class="font-bold text-white text-base">{{ $task->due_date }}-</span>
                        <span class="font-light  text-white text-sm">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary text-green-600 bold">{{ __('Ndrysho') }}</a>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-red-600 ">{{ __('Fshij') }}</button>
                            </form>
                        </span>
                    </div>
                    <div class="flex row-cols-3">
                    <a href="/">
                        <button class="bg-[#F4F5FA] px-4 py-3 text-white  rounded-full border border-[#F0F0F6] shadow-xl mt-4">
                            Ndrysho detyren
                        </button>
                        <a href="/">
                        <button class="bg-[#F4F5FA] px-4 py-3 text-white  rounded-full border border-[#F0F0F6] shadow-xl mt-4">
                            Kryer
                        </button>
                    </a>
                    <a href="/">
                        <button class="bg-[#FF0000] px-4 py-3 text-white  rounded-full border border-[#FF0000] shadow-xl mt-4">
                            Refuzim
                        </button>
                    </a>
                    </a>
                    </div>
                  
                </div>
            </div>
        @empty
            <div class="bg-[#F9ECFF] rounded-xl">
                <p class="text-gray-600">Nuk ka detyra në dispozicion.</p>
            </div>
        @endforelse
    </div>

    <!-- Hero section -->
    <div class="flex items-center justify-center flex-col bg-[#E5E5E5] min-h-screen">

            <div class="max-w-3xl mx-auto px-4  text-white sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-white text-center mb-6">
                    Shto një detyrë
                </h2>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label for="title" class="block  text-white font-semibold mb-2">
                                Titulli i detyrës
                            </label>
                            <input type="text" name="title" id="title" class="w-full  text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex-1">
                            <label for="description" class="block  text-white font-semibold mb-2">
                                Përshkrimi i detyrës
                            </label>
                            <input type="text" name="description" id="description" class="w-full  text-black rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 mt-4">
                        <div class="flex-1">
                            <label for="due_date" class="block  text-white font-semibold mb-2">
                                Data e duhur
                            </label>
                            <input type="date" name="due_date" id="due_date" class="w-full  text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="py-2 px-4 bg-gray-800 hover:bg-gray-900     text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Shto detyrën
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

</div>
</div>
</div>
@endsection
