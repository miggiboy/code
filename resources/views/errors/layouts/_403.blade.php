<!doctype html>
<html>
    <head>
        <title>Edukey</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.css">

        <style>
             body {
              background-color: #DADADA;
            }
            body > .grid {
              height: 100%;
            }
            .image {
              margin-top: -100px;
            }
            .column {
              max-width: 450px;
            }
        </style>
    </head>
    <body>
        <div class="ui custom container">
            <div class="ui middle aligned center aligned grid" style="margin-top: 150px;">
              <div class="column">
                  <h2 class="ui teal image header">
                    <img src="/images/logo.png" class="image">
                    <div class="content">
                      Эта страница временно не доступна
                    </div>
                  </h2>
                  <a href="{{ URL::previous() }}" class="ui blue button">
                      Вернуться
                  </a>
              </div>
            </div>
        </div>
    </body>
</html>
