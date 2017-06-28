@extends ('layouts.app')

@section ('title', 'Статьи')

@section ('subnavigation')
    @include ('articles/partials/_navigation', ['heading' => $article->title])
@endsection

@section ('head')
    <style>
        .overlay .menu {
            position: fixed; bottom: 60px; right: 30px; z-index: 10;
        }
    </style>
@endsection

@section ('content')
    <div class="ui article container">
      <span>Категории: </span><br>
      @foreach ($article->categories as $category)
        {{ $category->title . $loop->last ? '' : ',' }}<br>
      @endforeach
      <p>{{ $article->short_description }}</p>
      <p>{!! $article->full_description !!}</p>

    </div>

    <div class="overlay">
      <div class="ui labeled icon tiny menu">
        <a href="{{ route('articles.edit', $article) }}" class="item">
          <i class="ui circular blue edit icon"></i> Редактировать
        </a>
      </div>
    </div>
@endsection
