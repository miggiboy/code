@extends('layouts.app')

@section('title', auth()->user()->getNameOrUsername())

@section('content')
    <div class="ui grid">
        <div class="five wide column">

            <div class="ui link cards">
              <div class="card">
                <div class="image">
                  <img class="ui wireframe image" src="/images/wireframe/image.png">
                </div>

                <div class="content">
                  <div class="header">{{ auth()->user()->getNameOrUsername() }}</div>
                  <div class="meta">
                    @foreach (auth()->user()->roles as $role)
                      <p>{{ $role->display_name }}</p>
                    @endforeach
                  </div>
                  <div class="description">
                     {{ $role->description }}
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="eight wide column">

            @include ('includes/_form-errors')
            <form action="{{ route('profile.update') }}" method = "post" class="ui form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="two fields">
                    <div class="eight wide field">
                        <label for="username">Логин</label>
                        <input type="text"
                               name="username"
                               id="username"
                               value="{{ old('username') ?: auth()->user()->username }}"
                               required
                        >
                    </div>
                    <div class="eight wide field">
                        <label for="email">E-mail</label>
                        <input type="text"
                               name="email"
                               id="email"
                               value="{{ old('email') ?: auth()->user()->email }}"
                               required>
                    </div>
                </div>
                <div class="two fields">
                    <div class="eight wide field">
                        <label for="first_name">Имя</label>
                        <input type="text"
                               name="first_name"
                               id="first_name"
                               value="{{ old('first_name') ?: auth()->user()->first_name }}">
                    </div>
                    <div class="eight wide field">
                        <label for="last_name">Фамилия</label>
                        <input type="text"
                               name="last_name"
                               id="last_name"
                               value="{{ old('last_name') ?: auth()->user()->last_name }}">
                    </div>
                </div><br>
                <button class="ui teal small button">Сохранить</button>
            </form>

            @if (! auth()->user()->first_name)
              <br>
              <div class="ui info message">
                <div class="header">
                  Уважаемый пользователь!
                </div>
                <p>
                  Желательно заполнить поле "имя" (на русском). Это необходимо для лучшего отображения информации о Вас.
                </p>
              </div><br>
            @endif

        </div>
    </div>
@endsection
