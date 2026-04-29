<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title', 'HELLOOOO')</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @section('main')
        <div class="text-center">A default division</div>
        <hr>
        @show
    </body>
</html>
