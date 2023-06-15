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
                    <a href="/login"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Lidhu</a>
                    <a href="/register"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Regjistrohu</a>
                    @else
                    <a href="#"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">{{ auth()->user()->name }}</a>

                    @if(auth()->user()->role == 1)
                    <a href="/admin/dashboard"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Admin Panel</a>
                    @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        <button type="submit">Shkycu</button>
                    </form>

                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Shkycu</a>
                    @endif
                </div>
            </div>
        </nav>

        <div class="relative">

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
                    <button id="show-description-btn-{{ $task->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mt-2 focus:outline-none">
                      Shfaq të plotë
                    </button>
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
                      <button type="submit" class="btn btn-danger text-red-600 ">{{ __('Fshij') }}</button>
                    </form>
                  </span>
                  <!-- Butoni "Shiko" -->
                  <select id="status-dropdown-{{ $task->id }}">
                    <!-- Vendosni opsionet e dropdown-it këtu -->
                    <option value="completed">Completed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="pending">Pending</option>
                  </select>
                  <button onclick="onStatusChange({{ $task->id }})">Save</button>
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

    </div>


    <script>
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

var xhr = new XMLHttpRequest();
xhr.open("POST", "/tasks/" + taskId + "/update-status", true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken); // Shtoni këtë linjë për të shtuar tokenin CSRF në kërkesë
xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        console.log(xhr.responseText); // Response message from the controller
      } else {
        console.error("Error while saving the status to the database.");
      }
    }
  };

  var data = JSON.stringify({ newStatus: newStatus });
  xhr.send(data);
}

// Complete the onStatusChange function with code that displays the dropdown and updates the task status in the database
function onStatusChange(taskId) {
  var dropdown = document.getElementById("status-dropdown-" + taskId);
  var selectedStatus = dropdown.value;

  // Update the status in the database
  saveStatusToDatabase(taskId, selectedStatus);
}

      </script>
</body>

</html>