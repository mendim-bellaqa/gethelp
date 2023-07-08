<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@1.2.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <name>@yield('name')</name>
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
                <h2 class="text-2xl text-gray-700 mb-6">Ndrysho Profilin</h2>
                <!-- Shtoni div-in e fshehur për ridrejtim -->
                <div id="redirect-container" class="hidden">
                    <p>Detyra u përditësua me sukses!</p>
                </div>
                <form action="{{ route('profile.update', ['profile' => $user->id]) }}" method="POST">
                
                    @csrf
                    @method('PUT')


                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                        <input id="name" type="text" class="border-1 rounded-r px-4 py-2 w-full" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input id="email" type="email" class="border-1 rounded-r px-4 py-2 w-full" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="p-4 justify-center flex">
                        <button type="submit" class="text-base  undefined  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-700 hover:text-teal-100 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition">Ruaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script>
function updateprofile() {
    var form = document.getElementById("update-profile-form");
    var userId = form.action.split('/').pop();
    var formData = new FormData(form);

    fetch('/profile/edit/' + userId, {
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
