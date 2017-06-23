@extends ('layouts.app')

@section ('title', 'Статьи')

@section ('subnavigation')
    @include ('articles.partials.navigation', ['pageTitle' => $article->title])
@endsection

@section ('head')
    <style>
        .ui.container.custom {
            margin-top: 25px;
            margin-bottom: 30px;
            font-family: Verdana, sans-serif;
            font-size: 17px;
            margin-top: 10px;
            margin-bottom: 40px;
            padding: 0 330px 0 0;
        }
        .overlay .menu {
            position: fixed; bottom: 60px; right: 30px; z-index: 10;
        }
    </style>
@endsection

@section ('content')
    <div class="ui container custom">
      {{-- <span>Кат.: {{ $article->profDirection->title }}</span><br> --}}
      <p>{{ $article->short_description }}</p>
      <p id="edit-area">{!! $article->full_description !!}</p>

    </div>

    <div class="overlay">
      <div class="ui labeled icon tiny menu">
        <a href="{{ route('articles.edit', $article) }}" class="item">
          <i class="ui circular blue edit icon"></i> Редактировать
        </a>
      </div>
    </div>
@endsection
