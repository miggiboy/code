<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.css">

        <link rel="stylesheet" href="/css/app.css">

        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
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
        <div id="app">
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
    <script src="//js.pusher.com/4.0/pusher.min.js"></script>
    <script src="/js/vendor/readmore/readmore.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>

    @include ('includes.flash')

    @include ('includes/_pusher-scripts')

    @yield ('script')
</html>
