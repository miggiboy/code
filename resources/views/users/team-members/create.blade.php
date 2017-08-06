@extends ('layouts.app')

@section ('title', 'Новые пользователи')

@section ('subnavigation')
    @include ('users/team-members/partials/_navigation', ['heading' => 'Новые пользователи'])
@endsection

@section ('content')
  @if ($newComers->count())
    @include ('users/team-members/partials/_users-table', [
          'table_heading' => 'Пользователи без ролей',
          'users' => $newComers,
      ])
  @else
    Новых зарегистрированных пользователей нет!
  @endif
  <br>
  <br>
@endsection
