<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.css">

        <link rel="stylesheet" href="/css/app.css">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="shortcut icon" href="/images/logo.png">

        <title>
            @yield('title')
        </title>

        @yield ('head')
    </head>

    <body>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <div>
            @include ('layouts.navigation')
            <br>
            <div class="ui main container">
                @yield ('subnavigation')
                @yield ('content')
            </div>
        </div>
    </body>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include ('includes/_flash')

    @yield ('script')

    <script src="/js/app.js"></script>
</html>
