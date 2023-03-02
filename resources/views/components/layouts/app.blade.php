<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="@yield('meta-description', '')">
    <meta name="description" content="{{ $metaDescription ?? 'Default meta description' }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo-nosecaen.png') }}">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <title>Nosecaen S.L. - {{ $title ?? '' }}</title>
</head>

<body>
    <header>

        <x-layouts.navigation />

    </header>

    <section>
        @if (session('status'))
        <div class="status">
            {{ session('status') }}
        </div>
        @endif
    </section>

    {{ $slot }}
</body>

</html>