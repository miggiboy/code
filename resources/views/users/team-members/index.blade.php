@extends ('layouts.app')

@section ('title', 'Команда сайта')

@section ('subnavigation')
    @include ('users/team-members/partials/_navigation', ['heading' => 'Команда сайта'])
@endsection

@section ('content')
  @include ('users/team-members/partials/_users-table', [
      'table_heading' => 'Члены команды',
      'users' => $team,
  ])
  <br>
  <br>
@endsection
