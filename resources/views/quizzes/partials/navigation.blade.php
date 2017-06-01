<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">

  <div class="eleven wide column">
    <h1>{{ $pageTitle }}</h1>
  </div>

  <div class="five wide column">
    <div class="ui compact small menu" style="position: absolute; top: 20px; right: 20px;">
      <a href="{{ route('quizzes') }}" class="item"><i class="teal student icon"></i> Тесты </a>
      <a href="{{ route('quizzes.create') }}" class="item"><i class="teal circle add icon"></i> Добавить </a>
      {{-- <div class="ui dropdown item">
        <i class="teal circle add icon"></i> Добавить <i class="dropdown icon"></i>
        <div class="menu">
          <div class="header"><i class="teal tags icon"></i> Интерактивные </div>
          <a href="{{ route('quizzes.create') }}" class="item">Автозагрузка из текста</a>
          <a class="item">Составить вручную</a>
          <div class="divider"></div>
          <div class="header"><i class="teal tags icon"></i> Не интерактивные </div>
          <a class="item">Текстовый тест</a>
        </div>
      </div> --}}
    </div>
  </div>

</div>
<br>
