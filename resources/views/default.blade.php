<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset('js/script.js')?>"></script>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>

    <div class="container">
        @yield('content')
    </div>

    </body>
</html>