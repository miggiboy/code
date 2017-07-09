@extends ('layouts.app')

@section ('title', 'Статьи')

@section ('subnavigation')
    @include ('articles/partials/_navigation', ['heading' => $article->title])
@endsection

@section ('head')
    <style>
        .overlay {
            position: fixed;
            bottom: 50px;
            right: 50px;
            z-index: 10;
        }
    </style>
@endsection

@section ('content')
    <div class="ui article container">

      <br>
      @include ('articles/partials/show/_labels')
      <br><br>
      <span>Категории: </span>
      @foreach ($article->categories as $category)
        <a href="{{ route('articles.index', ['category' => $category->id]) }}">
          {{ $category->title . ($loop->last ? '' : ',') }}
        </a>
      @endforeach

      <br>
      <br>

      <p>{{ $article->short_description }}</p>
      <p>{!! $article->full_description !!}</p>

    </div>

    <div class="overlay">
      @include ('articles/partials/_options')
    </div>
@endsection
