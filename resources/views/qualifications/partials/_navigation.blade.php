<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">

  @if (isset($custom_heading_layout))
    {{ $custom_heading_layout }}
  @else
    <div class="nine wide column">
      <h1>{{ $heading }}</h1>
    </div>
  @endif

  <div class="five wide column" style="position: absolute; top: -2px; right: -62px;">
    <div class="ui compact small menu">

      <a href="{{ route('qualifications.index') }}" class="item">
        <i class="teal student icon"></i> Квалификации
      </a>

      <a href="{{ route('qualifications.create') }}" class="item">
        <i class="teal circle add icon"></i> Добавить
      </a>

    </div>
  </div>

</div>
<br><br>
