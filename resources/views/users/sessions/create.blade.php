<!DOCTYPE html>
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
                    Вход на сайт
                  </div>
                </h2>
                @include ('includes.form-errors')

                @if (session()->has('message'))
                  <div class="ui negative message">
                    <p>{{ session('message') }}</p>
                  </div>
                @endif

                <form action ="{{ route('login') }}" method ="post" class="ui large form">
                  {{ csrf_field() }}
                  <div class="ui stacked segment">
                    <div class="field">
                      <div class="ui left icon input">
                        <i class="mail icon"></i>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="E-mail"
                               required
                               autofocus>
                      </div>
                    </div>

                    <div class="field">
                      <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Пароль" required>
                      </div>
                    </div>

                    <div class="inline field">
                      <div class="ui checkbox">
                        <input type="checkbox" name="remember" id="remember_me">
                        <label for="remember_me" style="cursor: pointer;">Запомнить меня</label>
                      </div>
                    </div>

                    <button type="submit" class="ui fluid large teal submit button">
                        Войти
                    </button>
                  </div>

                  <div class="ui error message"></div>

                </form>

                <div class="ui message">
                   <a href="{{ route('register') }}">Регистрация</a>
                </div>
              </div>
            </div>
        </div>
    </body>
</html>
