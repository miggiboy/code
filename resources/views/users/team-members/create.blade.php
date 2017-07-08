@extends ('layouts.app')

@section ('title', 'Новые пользователи')

@section ('subnavigation')
    @include ('users/team-members/partials/_navigation', ['heading' => 'Новые пользователи'])
@endsection

@section ('content')
  @include ('users/team-members/partials/_users-table', [
      'table_heading' => 'Пользователи без ролей',
      'users' => $newComers,
  ])
  <br>
  <br>
@endsection
