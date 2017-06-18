<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">
  <div class="ten wide column">
    <h1>{{ $pageTitle }}</h1>
  </div>

  <div class="five wide column" style="position: absolute; top: -2px; right: -95px;">
    <div class="ui compact small menu">
      <a href="{{ route('professions.index') }}" class="item">
        <i class="teal travel icon"></i> Профессии
      </a>

      <a href="{{ route('professions.create') }}" class="item">
        <i class="teal circle add icon"></i> Добавить
      </a>

    </div>
  </div>

</div>
<br>
