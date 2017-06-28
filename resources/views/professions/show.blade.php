@extends ('layouts.app')

@section ('title', 'Профессии')

@section ('subnavigation')
    @include('professions/partials/_navigation', ['heading' => $profession->title])
@endsection

@section ('head')
  <style>
      .ui.container.custom {
          margin-bottom: 30px;
          font-family: Verdana, sans-serif;
          font-size: 15px;
          margin-top: 10px;
          margin-bottom: 40px;
          padding: 0 350px 0 0;
      }
      .overlay {
          position: fixed; bottom: 30px; left: 22px; z-index: 10;
      }

      .ui.container.custom img {
        margin: 15px;
      }
  </style>
@endsection

@section ('content')
    <div class="ui container custom">
      @include ('professions/partials/show/_labels')
      @include ('professions/partials/show/_profession_information')
    </div>

    @include ('professions/partials/show/_related')

    <div class="overlay">
      @include ('professions/partials/_options', [
          'menu_direction' => 'left',
      ])
    </div>
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
