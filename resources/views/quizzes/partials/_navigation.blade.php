<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">

  <div class="eleven wide column">
    <h1>{{ $heading }}</h1>
  </div>

  <div class="five wide column">
    <div class="ui compact small menu" style="position: absolute; top: 20px; right: 20px;">
      <a href="{{ route('quizzes.index') }}" class="item">
        <i class="teal student icon"></i> Тесты
      </a>
      <a href="{{ route('quizzes.create') }}" class="item">
        <i class="teal circle add icon"></i> Добавить
      </a>
    </div>
  </div>

</div>
<br>
