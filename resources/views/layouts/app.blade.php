<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>image stacking</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="pt-5">
<main id="app" class="container">
    <nav class="navbar fixed-top navbar-light bg-light">
        <a class="navbar-brand" href="#">Variations</a>
    </nav>
    <div class="row pt-5">
        @yield('content')
    </div>
</main>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
