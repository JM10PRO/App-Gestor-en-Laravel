<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="@yield('meta-description', '')">
    <meta name="description" content="{{ $metaDescription ?? 'Default meta description' }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo-nosecaen.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <title>Nosecaen S.L. - {{ $title ?? '' }}</title>
</head>

<body>
    <header>

        <x-layouts.navigation />

    </header>

    <section>
        @if (session('status'))
        <div class="status alert alert-info">
            {{ session('status') }}
        </div>
        @endif
    </section>

    {{ $slot }}

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>