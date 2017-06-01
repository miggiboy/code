@extends ('layouts.master')

@section ('title', 'Статьи')

@section ('subnavigation')
    @include ('articles.partials.navigation', ['pageTitle' => 'Статьи'])
@endsection

@section ('content')
<br><br>
<div class="ui grid">

  <div class="thirteen wide column">
    <div class="ui very padded segment">
      <form class="ui small form" action="" method="get">
          <div class="two fields">
            <div class="eight wide field">
              <div class="ui fluid search universities">
                <div class="ui right icon input">
                  <input type="text" name = "query" class="prompt" placeholder="Начните вводить название статьи ...">
                  <i class="search icon"></i>
                </div>
              </div>
            </div>
            <div class="three wide field">
                  <select class="ui selection search dropdown" name="city">
                    <option value="">Категория</option>
                     @foreach ($categories as $category)
                       <option value="{{ $category->id }}">
                         {{ $category->title }}
                       </option>
                     @endforeach
                  </select>
              </div>
          </div>

          <button type="submit" class="ui small basic button">Поиск</button>
      </form>

      <br>
      @if (count($articles))
          <div class="ui large celled very relaxed selection list">
          @foreach ($articles as $article)
                <div class="university item" style="cursor: default;">
                  <div class="ui right pointing right floated icon dropdown basic button content">
                    <i class="ellipsis vertical icon"></i>
                    <div class="menu">

                      <div class="header"><i class="tags icon"></i>  Опции </div>
                      <div class="divider"></div>

                      {{-- Editing --}}
                      <a href="{{ route('article.edit', $article) }}" class="item" target="_blank">
                        <i class="blue edit icon"></i> Редактировать
                      </a>
                      {{-- Editing end --}}

                      <a href="{{ route('vipusknik.article', $article) }}" class="item" target="_blank">
                        <i class="orange checkmark box icon"></i> Выпускник.Kz
                      </a>

                      <div class="divider"></div>

                      {{-- Deleting --}}
                      <a href="#" class="item"
                        onclick="event.preventDefault();
                          document.getElementById('delete-article-{{ $article->id }}').submit();">
                        <i class="red delete icon"></i>  Удалить
                      </a>
                      <form action="{{ route('article.destroy', $article) }}" method="post"
                        id="delete-article-{{ $article->id }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      </form>
                      {{-- Deleting end --}}
                    </div>
                  </div>

                  <i class="teal travel icon"></i>
                  <div class="content">
                    <a class="header" href="{{ route('article.show', $article) }}">
                      {{ $article->title }}
                    </a><br>
                    {{ $article->short_description }}
                  </div>
                </div>
          @endforeach
          </div>
      @endif
      <br>
      </div>
  </div>

  <div class="three wide column">
        <div class="ui vertical teal menu">
        <div class="item">
          <div class="header">Категории</div>
          <div class="menu">
            @foreach ($categories as $category)
              <a href="#" class="item">
                {{ $category->title }}
              </a>
            @endforeach
          </div>
        </div>
      </div>
  </div>

</div>
{{ $articles->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>

@endsection
