<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>
<body>
    <main>
        @include('partials.header')
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>