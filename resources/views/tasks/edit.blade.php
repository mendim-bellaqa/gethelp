<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@1.2.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
</head>
<body>
<div class="w-full">
    <nav class="bg-yellow-300 w-full top-0 fixed shadow-lg" style="z-index: 9999;">
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
            <div class="flex flex-col md:flex-row md:block -mx-2">
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

                    <a href="/" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Shkycu</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="h-screen bg-yellow-600 flex items-center justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white border border-gray-300 rounded-md p-6">
                <h2 class="text-2xl text-gray-700 mb-6">{{ __('Ndrysho Detyrën') }}</h2>
                <!-- Shtoni div-in e fshehur për ridrejtim -->
                <div id="redirect-container" class="hidden">
                    <p>Detyra u përditësua me sukses!</p>
                </div>
                <form id="update-task-form" action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
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
                        @if (strlen($task->description) > 50)
                            <div>
                                <button id="show-description-btn-{{ $task->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mt-2 focus:outline-none" onclick="showFullDescription({{ $task->id }})" style="display: none;">
                                    Shfaq të plotë
                                </button>
                                <div id="description-{{ $task->id }}" class="description hidden">
                                    {{ $task->description }}
                                </div>
                            </div>
                        @endif
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
                    <div class="relative mt-5 mb-5 text-center">
                        <select id="status" name="status" class="border border-gray-400 rounded-md px-4 py-3 mt-2">
                            <option value="Kryer" @if($task->status == 'Kryer') selected @endif>Kryer</option>
                            <option value="Proces" @if($task->status == 'Proces') selected @endif>Proces</option>
                            <option value="Refuzuar" @if($task->status == 'Refuzuar') selected @endif>Refuzuar</option>
                        </select>
                    </div>
                    <div class="relative mt-5 mb-5 text-center">
                        <select id="category" name="category" class="border border-gray-400 rounded-md px-4 py-3 mt-2">
                            <option value="Ditore" @if($task->category == 'Ditore') selected @endif>Ditore</option>
                            <option value="Javore" @if($task->category == 'Javore') selected @endif>Javore</option>
                            <option value="Onetime" @if($task->category == 'Onetime') selected @endif>Onetime</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-center">

                        <button type="submit" onclick="event.preventDefault(); updateTask();" class="bg-yellow-200 px-12 py-4 text-2xl border-neutral-400 border-2 text-gray hover:text-black hover:shadow-[inset_13rem_0_0_0] hover:shadow-blue-400 duration-[400ms,700ms] transition-[color,box-shadow]">
                            Rifresko
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script>
function updateTask() {
    var form = document.getElementById("update-task-form");
    var taskId = form.action.split('/').pop();
    var formData = new FormData(form);

    fetch('/tasks/' + taskId, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.redirect) {
                document.getElementById("redirect-container").style.display = "block";
                setTimeout(function() {
                    window.location.href = data.redirect;
                }, 2000); // Ndryshoni kohën e pritjes për ridrejtim në mili-sekonda sipas nevojës tuaj
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Gabim:', error);
        });
}

</script>

</html>
