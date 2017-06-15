<div class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>

    <a href="{{ route('colleges.edit', $college->id) }}" class="item" target="_blank">
      <i class="blue edit icon"></i>  Редактировать
    </a>

    <a href="{{ "https://www.google.kz/maps/search/{$college->title}/@43.2351503,76.9075561,17z" }}" class="item" target="_blank">
      <i class="blue location arrow icon"></i> Google карты
    </a>

    <a href="{{ url($university->google()) }}" class="item" target="_blank">
      <i class="green google icon"></i> Найти в Google
    </a>

    <a href="{{ route('vipusknik.college', $college) }}" class="item" target="_blank">
      <i class="orange checkmark box icon"></i> Выпускник.Kz
    </a>

    {{-- Deleting --}}
    <div class="divider"></div>

    <a href="#" class="item"
        onclick="event.preventDefault();
          document.getElementById('toggle-model-{{ $college->id }}-status').submit();">
        <i class="yellow star icon"></i>  Сделать {{ $college->is_paid ? 'не ' : '' }}платником
    </a>

    <form action="{{ route('college.status.toggle', $college) }}" method="post" id="toggle-model-{{ $college->id }}-status">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
    </form>

    <a href="#" class="item" onclick="event.preventDefault();
          document.getElementById('delete-college-{{ $college->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('colleges.destroy', $college) }}" method="post"
        id="delete-college-{{ $college->id }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
