<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@1.2.0/dist/tailwind.min.css" rel="stylesheet">
    
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card:hover .description {
            max-height: none;
            opacity: 1;
        }

        .description {
            max-height: 0;
            opacity: 0;
            transition: max-height 0.3s, opacity 0.3s;
        }


        .popup {
            display: none;
            position: relative;
            
            width: 80%;
            left: 50%;
            transform: translateX(-50%);
            height: 180px;
            top: 50%;
            transform: translateY(-50%);
            background: #FFF;
            border: 3px solid #F04A49;
            z-index: 20;
        }

#popup:after {
  position: fixed;
  content: "";
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: rgba(0,0,0,0.5);
  z-index: -2;
}

#popup:before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: #FFF;
  z-index: -1;
}

.task {
  margin-bottom: 10px;
}

.task {
  margin-bottom: 10px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  padding: 5px 10px;
  background-color: #f1f1f1;
  border: none;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  min-width: 160px;
  z-index: 1;
}

.dropdown-content a {
  display: block;
  padding: 5px 10px;
  text-decoration: none;
  color: #333;
}

.dropdown-content a:hover {
  background-color: #f9f9f9;
}

.show {
  display: block;
}

.popupk {
  display: none;
  position: fixed;
  padding: 10px;
  width: 280px;
  left: 50%;
  margin-left: -150px;
  height: 180px;
  top: 50%;
  margin-top: -100px;
  background: #FFF;
  border: 3px solid #F04A49;
  z-index: 20;
}

#popupk:after {
  position: fixed;
  content: "";
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: rgba(0,0,0,0.5);
  z-index: -2;
}

#popupk:before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: #FFF;
  z-index: -1;
}

        
    </style>
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
        </nav>

        <div class="relative">

        <div id="user-widget" class=" hidden inset-x-0 bottom-0 flex flex-col items-center justify-center bg-yellow-400 text-black">
            <div class="top-5">
                <!-- component -->
                    <div class="p-5 widget-container  w-48 h-48" id="user-widget ">
                        <div class="flex h-64 justify-center">
                        <div id="redirect-container" style="display: none;">
                            Detyra u përditësua me sukses. Po ju ridrejtojmë...
                        </div>

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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 ">
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

            <div style="width: 100%; position: absolute;" class="bg-cover bg-center bg-yellow-600 items-center justify-around content-start min-h-screen">
              <!-- tasks -->
              <!-- Hero section -->
              @if(auth()->check())
              <div class="flex items-center justify-center flex-col bg-[#E5E5E5] ">
                <a href="{{ route('tasks.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-8">
                  Krijo Detyrë
                </a>
              </div>
              @endif


              @if(session()->has('message'))
              <div class="max-w-lg hidden mx-auto mt-5" id="success-message">
                <div class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Statusi u ndryshua</span>  {{ session()->get('message') }}
                    </div>
                </div>
            </div>

            @endif

                <div id="task-container" class="grid grid-cols-3 gap-4 flex items-center justify-center mt-8 mb-16 ml-5 mr-5">
                  @forelse ($tasks as $task)
                  @if(auth()->user()->role == 1 || ($task->user_id == auth()->user()->id && auth()->user()->role == 0))
                  <div class="card rounded-lg bg-orange-200 p-4 w-full mx-auto mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/351/351501.png?w=740&t=st=1684714193~exp=1684714793~hmac=11791ab8c8f7af7f9a0aa076fa6013c8da75ff97d18a7b67c1dbf3153a492915" class="w-12">
                    <div class="mt-3 text-gray-800 font-semibold text-lg">{{ $task->title }}</div>
                    <div class="text-sm text-gray-800 font-light">
                      @if (strlen($task->description) > 50)
                      <div>
                        <p>{{ substr($task->description, 0, 50) }}</p>
                        <div class="relative">
                        <div id="description-{{ $task->id }}" class="description" style="max-height: 0; opacity: 0;">
                            <p>{{ $task->description }}</p>
                          </div>

                          <button id="show-description-btn-{{ $task->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mt-2 focus:outline-none" onclick="showFullDescription({{ $task->id }})" style="display: none;">
                            Shfaq të plotë
                          </button>

                          <button id="status-button-{{ $task->id }}" class="bg-gray-800 text-white hover:bg-green-700 font-bold py-2 px-3 rounded mt-2 absolute right-0 top-0">{{ $task->status }}</button>
                        </div>
                        <div id="description-{{ $task->id }}" class="description hidden">
                          {{ $task->description }}
                        </div>
                      </div>
                      @else
                      {{ $task->description }}
                      @endif
                    </div>
                    <p>{{ $task->user->name }}</p>
                    <div class="my-4">
                      <p class="due-time font-bold text-gray-800 text-base">Koha fundit: {{ $task->due_date }}</p>
                      <p class="due-time font-bold text-gray-800 text-base">Kan mbetur: {{ \Carbon\Carbon::parse($task->due_date . ' ' . $task->due_time)->diffForHumans() }}</p>
                      <span class="font-light text-gray-800 text-sm">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary text-green-600 bold">{{ __('Ndrysho') }}</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display: inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger text-red-600">{{ __('Fshij') }}</button>
                        </form>
                      </span>
                    </div>
           
                    
                  </div>
                  

                  @endif
                  @empty
                  <div class="bg-[#F9ECFF] rounded-xl">
                    <p class="text-gray-600">Nuk ka detyra në dispozicion.</p>
                  </div>
                  @endforelse
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
          
  
  <script>
  // Thirr funksionet për çdo detyrë në faqe
  @foreach ($tasks as $task)
    checkDescriptionLength({{ $task->id }});
  @endforeach
</script>

<script>
  // Kontrollo gjatësinë e pershkrimit dhe shfaq apo fsheh butonin "Shfaq të plotë"
  function checkDescriptionLength(taskId) {
    var descriptionDiv = document.getElementById('description-' + taskId);
    var showButton = document.getElementById('show-description-btn-' + taskId);

    if (descriptionDiv.textContent.length > 250) {
      showButton.style.display = 'inline-block';
    } else {
      showButton.style.display = 'none';
    }
  }

  // Shfaq pershkrimin e plote kur klikohet butoni "Shfaq të plotë"
  function showFullDescription(taskId) {
    var descriptionDiv = document.getElementById('description-' + taskId);
    var showButton = document.getElementById('show-description-btn-' + taskId);

    descriptionDiv.style.maxHeight = 'none';
    descriptionDiv.style.opacity = '1';
    showButton.style.display = 'none';
  }
</script>

</body>

</html>