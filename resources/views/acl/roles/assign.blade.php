@extends ('layouts.master')

@section ('title', 'Администрирование')

@section ('subnavigation')
    @include ('acl.roles.partials.navigation', ['pageTitle' => 'Поиск пользователя'])
@endsection

@section ('content')
  <form action="{{ route('roles.assign') }}" method="POST" class="ui form">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="fields">
    <div class="six wide field">
      <label for="query">Пользователь</label>
      <div class="ui search">
        <div class="ui left icon input">
          <input class="prompt" type="text" name="login" placeholder="Начните вводить login пользователя" autocomplete="off">
          <i class="user icon"></i>
        </div>
      </div>
    </div>
    <div class="four wide field">
        <label for="role">Роль</label>
        <select name="role" id="role" class="ui search dropdown">
          <option value="">Роль</option>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
          @endforeach
        </select>
    </div>
  </div>
    <button type="submit" class="ui teal button">Дать роль</button>
  </form>
@endsection

@section ('script')
    <script>
      var path = "{{ route('users.autocomplete') }}";
      $('.ui.search').search({
        apiSettings: {
          url: path+"?query={query}"
        },
        fields: {
          results : 'users',
          title   : 'username'
        },
        minCharacters : 2
      });
    </script>
@endsection
