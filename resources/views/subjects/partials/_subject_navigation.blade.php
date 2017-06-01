<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">

  <div class="ten wide column">
    <h1><a href="{{ route('subject.show', $subject) }}" style="color: #ccc">{{ $subject->title }}</a></h1>
  </div>

  <div class="four wide column" style="position: absolute; top: -2px; right: -30px;">
    <div class="ui compact small menu">
      <a href="{{ route('subjects') }}" class="item">
        <i class="teal book icon"></i> Предметы 
      </a>

      <a href="{{ route('subject.create') }}" class="item" title="Добавить предмет">
        <i class="teal circle add icon"></i> Добавить 
      </a>

    </div>
  </div>

</div>
<br>