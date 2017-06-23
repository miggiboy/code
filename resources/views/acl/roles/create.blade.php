@extends ('layouts.app')

@section ('title', 'Администрирование')

@section ('subnavigation')
    @include('acl.roles.partials.navigation', ['pageTitle' => 'Создание роли'])
@endsection

@section ('content')
    <form action="{{ route('roles.store') }}" method="POST" class="ui form">
      {{ csrf_field() }}
      <div class="three fields">
        <div class="required field">
          <label>Роль</label>
          <input type="text" name="name" placeholder="Роль">
        </div>
        <div class="required field">
          <label>Название для показа</label>
          <input type="text" name="display_name" placeholder="Название для показа">
        </div>
        <div class="eight wide field">
          <label>Описание роли</label>
          <input type="text" name="description" placeholder="Описание">
        </div>
      </div>
      <div class="ui segment">
            @foreach ($permissions as $permission)
                <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" name="permissions[]" tabindex="0" class="hidden" value="{{ $permission->id }}">
                      <label>{{ $permission->display_name }}</label>
                    </div>
                  </div>
            @endforeach
        </div>
        <button class="ui button" type="submit">Сохранить</button>
    </form>
@endsection
