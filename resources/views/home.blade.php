
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
<div class="relative">
    <div class="sticky top-0 h-screen flex flex-col items-center justify-center bg-green-400">
        <h1 class="text-4xl">Ditari</h1>
        <a href = "/notes">      
        <p>Vazhdo</p>
        </a>
    </div>
    <div class="sticky top-0 h-screen flex flex-col items-center justify-center bg-indigo-600 text-white">

        <h1 class="text-4xl">Aktivitetet</h1>
        <a href = "/aktivitetet">      
        <p>Vazhdo</p>
        </a>
    </div>
    <!-- <div class="sticky top-0 h-screen flex flex-col items-center justify-center bg-purple-600 text-white">
        <h2 class="text-4xl">The Third Title</h2>
        <p>Scroll Down</p>
    </div> -->
   
</div>

</body>
</html>
