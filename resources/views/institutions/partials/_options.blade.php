<div class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">

    {{-- Editing --}}
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>
    <a href="{{ route('institutions.edit', [request()->route('institutionType'), $institution]) }}"
       class="item"
       target="_blank">

      <i class="blue edit icon"></i>  Редактировать
    </a>

    <a href="{{ "https://www.google.kz/maps/search/{$institution->title}/@43.2351503,76.9075561,17z" }}" class="item" target="_blank">
      <i class="blue location arrow icon"></i> Google карты
    </a>

    {{-- Editing end --}}

    <a href="{{ url($institution->googleSearchURl()) }}" class="item" target="_blank">
      <i class="green google icon"></i> Найти в Google
    </a>

    <a href="{{ url($institution->urlAtPrimaryApp()) }}" class="item" target="_blank">
      <i class="orange checkmark box icon"></i> Выпускник.Kz
    </a>

    <div class="divider"></div>

    <a href="#" class="item"
       onclick="event.preventDefault();
       document.getElementById('toggle-model-{{ $institution->id }}-status').submit();">
      <i class="yellow star icon"></i>  Сделать {{ $institution->is_paid ? 'не ' : '' }}платником
    </a>

    <form action="{{ route('university.status.toggle', [request()->route('institutionType'), $institution]) }}"
          method="post"
          id="toggle-model-{{ $institution->id }}-status">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
    </form>

    {{-- @if (! $institution->pin)
      <a href="#" class="item"
        onclick="event.preventDefault();
          document.getElementById('generate-institution-{{ $institution->id }}-pin-form').submit();">
        <i class="grey privacy icon"></i>  Сгенерировать пин
      </a>

      <form action="{{ route('institutions.pins.store', $institution) }}" method="post"
        id="generate-institution-{{ $institution->id }}-pin-form">
        {{ csrf_field() }}
      </form>

    @else
      <a href="#" class="item"
        onclick="event.preventDefault();
          document.getElementById('delete-institution-{{ $institution->id }}-pin-form').submit();">
        <i class="brown privacy icon"></i>  Удалить пин
      </a>

      <form action="{{ route('institutions.pins.destroy', $institution) }}"
            method="post"
            id="delete-institution-{{ $institution->id }}-pin-form">

        {{ csrf_field() }}
        {{ method_field('DELETE') }}
      </form>

    @endif --}}


    {{-- Deleting --}}
    <a href="#" class="item"
      onclick="event.preventDefault();
        document.getElementById('delete-university-{{ $institution->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('institutions.destroy', [request()->route('institutionType'), $institution]) }}" method="post"
      id="delete-university-{{ $institution->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
