<div class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">

    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>

    {{-- Editing --}}
    <a href="{{ route('articles.edit', $article) }}"
       class="item"
       @isset ($edit_target_blank) target="_blank" @endisset>
      <i class="blue edit icon"></i> Редактировать
    </a>
    {{-- Editing end --}}

    <a href="{{ url($article->urlAtPrimaryApp()) }}" class="item" target="_blank">
      <i class="orange checkmark box icon"></i> Выпускник.Kz
    </a>

    <div class="divider"></div>

    {{-- Deleting --}}
    <a href="#" class="item"
      onclick="event.preventDefault();
        document.getElementById('delete-article-{{ $article->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('articles.destroy', $article) }}" method="post"
      id="delete-article-{{ $article->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
