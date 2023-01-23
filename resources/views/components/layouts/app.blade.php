<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="@yield('meta-description', '')">
    <meta name="description" content="{{ $metaDescription ?? 'Default meta description' }}">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <title>Nosecaen S.L. - {{ $title ?? '' }}</title>
</head>
<body>
    <header>

        <x-layouts.navigation/>
    
    </header>

    {{ $slot }}
</body> 
</html>