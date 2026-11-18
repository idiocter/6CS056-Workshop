<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Training Institute Management System">
    <title>@yield('title', 'Home') | Training Institute</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('partials.navbar')

    <main class="container">
        <x-alert />
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
