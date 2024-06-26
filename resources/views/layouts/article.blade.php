<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>side_project_laravel</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <main class="m-4">
        @if (session('success'))
            <div class="alert alert-success bg-emerald-300 py-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error bg-rose-300 py-2 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif
        @yield('main')
    </main>
</body>

</html>
