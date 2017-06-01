<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.css">

        <link rel="stylesheet" href="/css/app.css">

        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="/images/logo.png">

        <script src="https://js.pusher.com/4.0/pusher.min.js"></script>

        <title>
            @yield('title')
        </title>
        @yield ('styles')
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

   {{--  <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous">
    </script> --}}

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>
    <script src="/js/vendor/readmore/readmore.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    @include ('layouts.flash')

    @if (Auth::check())
        <script>

          function showNotification (data) {
              toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-bottom-full-width",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                  "onclick": function() {
                      window.location = "/"
                  }
            }

            toastr["info"](data.message.body, data.user.nameOrUsername + " написал(-а) в чате:")

          }

           function appendMessage (nameOrUsername, identicon, message) {
              $('#feed').prepend(`
                <div class="event" style="margin-bottom: 15px;">
                  <div class="label">
                    <img src=` + identicon + ` alt="identicon">
                  </div>
                  <div class="content">
                    <div class="summary">
                      <a>` + nameOrUsername + `</a>
                      <div class="date">
                        Time
                      </div>
                    </div>
                    <div class="extra text">`
                      + message +
                    `</div>
                  </div>
                </div>
            `)
          }

          function clearMessageInput () {
              $('#body').val('')
          }

          function sendMessage () {
            let message = $('#body').val().trim()

            $('#body').focus();

            if (message === '') {
              return;
            }

            clearMessageInput()

            appendMessage(
                '{{ auth()->user()->nameOrUsername }}',
                '{{ auth()->user()->identicon }}',
                message
            )

            axios.post('/feed', {
                body: message
            })
            .then(function (response) {
                console.log(response)
            })
            .catch(function (error) {
                console.log(error)
            })
          }


          var pusher = new Pusher('afecb36524a2cd80de3e', {
            cluster: 'ap2',
            encrypted: true
          });

          var channel = pusher.subscribe('global-channel');
              channel.bind('message-sent', function(data) {

                let currentUrl = window.location.href

                let chatUrl = 'http://selavu.mi:8000/'

                if (currentUrl == chatUrl) {
                    if (data.user.id !== {{ auth()->user()->id }}) {
                        appendMessage(
                            data.user.nameOrUsername,
                            data.user.identicon,
                            data.message.body
                        )
                    }
                } else {
                    showNotification(data)
                }

              });
      </script>
    @endif

    @yield ('script')
</html>
