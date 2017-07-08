<div class="ui eleven column left aligned very relaxed grid" style = "position: relative;">

  @if (isset($custom_heading_layout))
    {{ $custom_heading_layout }}
  @else
    <div class="nine wide column">
      <h1>{{ $heading }}</h1>
    </div>
  @endif

  <div class="four wide column" style="position: absolute; top: -2px; right: -15px;">
    <div class="ui compact small menu">
      <a class="item" href="{{ route('team-members.index') }}">
        <i class="teal users icon"></i> Команда
      </a>

      <a class="item" href="{{ route('team-members.create') }}">
        <i class="teal circle add icon"></i> Добавить
      </a>
    </div>
  </div>

</div>
<br><br>
