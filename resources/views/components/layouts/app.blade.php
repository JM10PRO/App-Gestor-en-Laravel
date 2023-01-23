<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="@yield('meta-description', '')">
    <meta name="description" content="{{ $metaDescription ?? 'Default meta description' }}">
    <title>Bunglebuild - {{ $title ?? '' }}</title>
</head>
<body>
    {{-- @include('partials.navigation') --}}
    <x-layouts.navigation/>
    {{ $slot }}
</body>
</html>