<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@1.2.0/dist/tailwind.min.css" rel="stylesheet">
    <title>@yield('title')</title>

</head>
<body>
    <header>
        <!-- Header content here -->
    </header>

    <nav>
        <!-- Navigation menu here -->
    </nav>

    <main>
        <div>
            @yield('content')
        </div>
    </main>

    <footer>
        <!-- Footer content here -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
