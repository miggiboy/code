<div
  class="ui {{ $menu_direction ?? 'right' }} pointing {{ $menu_direction ?? 'right' }} floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>

    <a href="{{ route('professions.edit', $profession) }}"
       class="item"
       @isset ($edit_target_blank) target="_blank" @endisset>
      <i class="blue edit icon"></i> Редактировать
    </a>

    <a href="{{ url($profession->urlAtPrimaryApp()) }}" class="item" target="_blank">
      <i class="orange checkmark box icon"></i> Выпускник.Kz
    </a>

    <a href="{{ url($profession->googleSearchUrl()) }}" class="item" target="_blank">
      <i class="green google icon"></i> Найти в Google
    </a>

    <div class="divider"></div>

    {{-- Deleting --}}
    <a href="#" class="item"
      onclick="event.preventDefault();
        document.getElementById('delete-profession-{{ $profession->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('professions.destroy', $profession) }}" method="post"
      id="delete-profession-{{ $profession->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
