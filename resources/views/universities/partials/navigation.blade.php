<div class="ui twelve column left aligned very relaxed grid" style = "position: relative;">
  @if (isset($view))
      @include ('universities.partials.page-titles.' . $view)
  @else
    <div class="nine wide column">
      <h1>{!! $pageTitle !!}</h1>
    </div>
  @endif
  <div class="four wide column" style="position: absolute; top: -2px; right: -10px;">
    <div class="ui compact small menu">
      <a class="item" href="{{ route('universities') }}">
        <i class="teal university icon"></i> Университеты
      </a>

      <a class="item" href="{{ route('universities.create') }}">
        <i class="teal circle add icon"></i> Добавить
      </a>
    </div>
  </div>

</div>
<br><br>
