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
              </div>
          </nav>
          
            <div class="sticky top-0 h-screen flex flex-col items-center justify-center bg-yellow-400 text-white">
              <div class="bg-yellow-400  overflow-hidden relative items-center justify-center">
                <div class="top-5 pt-5 shadow-3xl">
                  <div class="h-full w-full p-8 bg-black lg:ml-4 shadow-md">
                    <div class="rounded shadow p-6">
                      <div class="pb-6">
                        <label for="name" class="font-semibold text-white block pb-1">Name</label>
                        <div class="flex">
                          <input disabled id="username" class="border-1 rounded-r px-4 py-2 w-full" type="text" value="Jane Name" />

                        </div>
                      </div>
                      <div class="pb-4">
                        <label for="about" class="font-semibold text-white block pb-1">Email</label>
                        <input disabled id="email" class="border-1 rounded-r px-4 py-2 w-full" type="email" value="example@example.com" />
                        <a href="/" class="text-b;ack">
                          <div class="p-4 justify-center flex">
                              <button class="text-base  undefined  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer 
                                  hover:bg-teal-700 hover:text-teal-100 
                                  bg-teal-100 
                                  text-teal-700 
                                  border duration-200 ease-in-out 
                                  border-teal-600 transition">Ruaj
                                </button>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="/register">
                  <button class="bg-black pt-5 mt-5 font-medium p-2 md:p-4 text-white uppercase w-full">Nuk kam llogari</button>
                </a>
              </div>
            </div>
         </div>
      </div>  
  </div>
</body>
</html>


