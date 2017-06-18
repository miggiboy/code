<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">

  <div class="twelve wide column">
    <h1>{{ $pageTitle }}</h1>
  </div>

  <div class="four wide column" style="position: absolute; top: -2px; right: -50px;">
    <div class="ui compact small menu">
      <a href="{{ route('articles.index') }}" class="item">
        <i class="teal newspaper icon"></i> Статьи
      </a>

      <a href="{{ route('articles.create') }}" class="item">
        <i class="teal circle add icon"></i> Добавить
      </a>

    </div>
  </div>

</div>
<br>
