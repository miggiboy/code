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
            @include ('includes/_flash')

            <div class="ui middle aligned center aligned grid" style="margin-top: 150px;">
              <div class="column">
                <h2 class="ui teal image header">
                  <img src="/images/logo.png" class="image">
                  <div class="content">
                    Регистрация
                  </div>
                </h2>
                @include ('includes/_form-errors')
                <form action ="{{ route('registration.store') }}" method ="post" class="ui large form">
                  {{ csrf_field() }}
                  <div class="ui stacked segment">
                    <div class="field">
                      <div class="ui left icon input">
                        <i class="mail icon"></i>
                        <input type="email"
                               name="email"
                               value="{{ old('email', '') }}"
                               placeholder="E-mail"
                               required
                               autocomplete="off"
                               autofocus>
                      </div>
                    </div>

                    <div class="field">
                      <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text"
                               name="username"
                               value="{{ old('username', '') }}"
                               placeholder="Логин"
                               required
                               autocomplete="off">
                      </div>
                    </div>

                    <div class="field">
                      <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Пароль" required autocomplete="off">
                      </div>
                    </div>

                    <div class="field">
                      <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password"
                               name="password_confirmation"
                               placeholder="Повторите пароль"
                               required autocomplete="off">
                      </div>
                    </div>

                    <button type="submit" class="ui fluid large teal submit button">
                        Зарегистрироваться
                    </button>
                  </div>

                  <div class="ui error message"></div>

                </form>

                <div class="ui message">
                  Уже зарегистрировались? <a href="{{ route('login') }}">Войти</a>
                </div>
              </div>
            </div>
        </div>
    </body>
</html>
