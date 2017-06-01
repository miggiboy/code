<div class="ui twelve column left aligned very relaxed grid" style = "position: relative;">
  @if (isset($view))
      @include ('colleges.partials.page-titles.' . $view)
  @else
    <div class="twelve wide column">
      <h1>{!! $pageTitle !!}</h1>
    </div>
  @endif
  <div class="four wide column" style="position: absolute; top: -2px; right: -35px;">
    <div class="ui compact small menu">
      <a class="item" href="{{ route('colleges') }}"><i class="teal university icon"></i> Колледжи </a>
      <a class="item" href="{{ route('colleges.create') }}"><i class="teal circle add icon"></i> Добавить </a>
    </div>
  </div>
</div>
<br><br>