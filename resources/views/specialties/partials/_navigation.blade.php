<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">

  @if (isset($custom_heading_layout))
    {{ $custom_heading_layout }}
  @else
    <div class="nine wide column">
      <h1>{{ $heading }}</h1>
    </div>
  @endif

  <div class="five wide column" style="position: absolute; top: -2px; right: -75px;">
    <div class="ui compact small menu">

      <a href="{{ route('specialties.index', $institutionType) }}" class="item">
        <i class="teal student icon"></i> Специальности
      </a>

      <a href="{{ route('specialties.create', $institutionType) }}" class="item">
        <i class="teal circle add icon"></i> Добавить
      </a>

    </div>
  </div>

</div>
<br><br>
