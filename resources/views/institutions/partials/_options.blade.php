<div class="ui right pointing right floated icon dropdown basic borderless button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">

    {{-- Editing --}}
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>
    <a href="{{ route('institutions.edit', [$institutionType, $institution]) }}"
       class="item"
       @isset ($edit_target_blank) target="_blank" @endisset>
      <i class="blue edit icon"></i>  Редактировать
    </a>

    <a href="{{ url($institution->urlAtPrimaryApp()) }}" class="item" target="_blank">
      <i class="orange checkmark box icon"></i> Выпускник.Kz
    </a>

    <div class="item">
      <i class="left teal dropdown icon"></i>
      <span class="text">Ваша отметка</span>
      <div class="left menu">
        @foreach ($markerColors as $color)
          @if ($institution->isMarkedByCurrentUserWith($color))
            <a href="#"
               onclick="event.preventDefault();
               document.getElementById('unmark-institution-{{ $institution->id }}-{{ $color }}').submit();"
               class="item"
               target="_blank">
              <i class="{{ $color }} circle icon"></i> Снять
            </a>

            <form action="{{ route('markers.destroy', ['institution', $institution->id]) }}"
                  method="post"
                  id="unmark-institution-{{ $institution->id }}-{{ $color }}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="hidden" name="color" value="{{ $color }}">
            </form>
          @else
            <a href="#"
               onclick="event.preventDefault();
               document.getElementById('mark-institution-{{ $institution->id }}-{{ $color }}').submit();"
               class="item"
               target="_blank">
              <i class="{{ $color }} circle icon"></i> Поставить
            </a>

            <form action="{{ route('markers.store', ['institution', $institution->id]) }}"
                  method="post"
                  id="mark-institution-{{ $institution->id }}-{{ $color }}">
              {{ csrf_field() }}
              <input type="hidden" name="color" value="{{ $color }}">
            </form>
          @endif

        @endforeach
      </div>
    </div>

    {{-- Editing end --}}

    <a href="{{ url($institution->googleSearchURl()) }}" class="item" target="_blank">
      <i class="green google icon"></i> Найти в Google
    </a>

    <a href="{{ "https://www.google.kz/maps/search/{$institution->title}/@43.2351503,76.9075561,17z" }}"
       class="item"
       target="_blank">
      <i class="blue location arrow icon"></i> Google карты
    </a>

    <div class="divider"></div>

    <a href="#" class="item"
       onclick="event.preventDefault();
       document.getElementById('toggle-model-{{ $institution->id }}-status').submit();">
      <i class="yellow star icon"></i>  Сделать {{ $institution->is_paid ? 'не' : '' }}платником
    </a>

    <form action="{{ route('institutions.status.update', [$institutionType, $institution]) }}"
          method="post"
          id="toggle-model-{{ $institution->id }}-status">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
    </form>


    {{-- Deleting --}}
    <a href="#" class="item"
       onclick="event.preventDefault();
       document.getElementById('delete-institution-{{ $institution->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('institutions.destroy', [$institutionType, $institution]) }}" method="post"
      id="delete-institution-{{ $institution->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
