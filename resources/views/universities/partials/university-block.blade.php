<div class="item">
  <div class="ui tiny image">
    <img src="/images/wireframe/image.png">
  </div>
  <div class="content">
    <a href="{{ route('universities.show', ['id' => $university->id]) }}" class="header">{{ $university->title }}</a>
    <div class="meta">

      <span class="cinema">Union Square 14</span>

      <div class="ui right pointing right floated icon dropdown button">
        <i class="ellipsis vertical icon"></i>
        <div class="menu">
          <div class="header"><i class="tags icon"></i>  Опции </div>
          <div class="divider"></div>
          <a href="{{ route('universities.edit', ['id' => $university->id]) }}" class="item">
          <i class="blue edit icon"></i>  Редактировать </a>
          <a href="{{ route('universities.destroy', ['id' => $university->id]) }}" class="item"><i class="red delete icon"></i>  Удалить </a>
        </div>
      </div>

    </div>
    <div class="description">
      <p></p>
    </div>
    <div class="extra">
      <div class="ui label"><i class="marker icon"></i>{{ $university->city->title }}</div>
      @if (isset($university->type))
        <div class="ui label"><i class="protect icon"></i>{{ $university->type->title }}</div> 
      @endif
    </div>

  </div>
</div>