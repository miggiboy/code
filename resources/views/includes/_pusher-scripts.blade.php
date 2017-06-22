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
