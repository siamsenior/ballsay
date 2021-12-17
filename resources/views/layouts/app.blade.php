<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="Description" content="@yield('description')">
    <meta name="KeyWords" content="@yield('keywords')">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css?tme='.time()) }}">
    <link rel="stylesheet" href="{{ asset('css/'.theme().'.css?tme='.time()) }}">
    @stack('css')
    @livewireStyles
</head>
<body>
    {{$slot}}
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
    @livewireScripts
</body>

</html>