<div class="item">
  <div class="content">
    <a href="{{ route('specialties.show', $specialty->id) }}" class="header">
        {{ $specialty->title }}
    </a>

    <div class="meta">
      <span class="cinema">Union Square 14</span>
      <div class="ui right pointing right floated icon dropdown button">
            <i class="ellipsis vertical icon"></i>
            <div class="menu">
                  <div class="header"><i class="tags icon"></i>  Опции </div>
                  <div class="divider"></div>
                  <a href="{{ route('specialties.edit', $specialty->id) }}" class="item"><i class="blue edit icon"></i>  Редактировать </a>
                  <a href="{{ route('specialties.destroy', $specialty->id) }}" class="item"><i class="red delete icon"></i>  Удалить </a>
            </div>
      </div>
    </div>

    <div class="description">
      <p></p>
    </div>
    <div class="extra">
      <div class="ui label">
            <i class="long arrow up icon"></i>{{ $specialty->direction->title }}
      </div>
      @foreach ($specialty->subjects as $subject)
            <div class="ui label"><i class="book icon"></i>{{ $subject->title }}</div>
      @endforeach
    </div>

  </div>
</div>
