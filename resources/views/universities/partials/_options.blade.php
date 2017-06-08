<div class="ui right pointing right floated icon dropdown basic button content">
    <i class="ellipsis vertical icon"></i>
    <div class="menu">

      {{-- Editing --}}
      <div class="header"><i class="tags icon"></i>  Опции </div>
      <div class="divider"></div>
      <a href="{{ route('universities.edit', $university->id) }}" class="item" target="_blank">
        <i class="blue edit icon"></i>  Редактировать
      </a>

      <a href="{{ "https://www.google.kz/maps/search/{$university->title}/@43.2351503,76.9075561,17z" }}" class="item" target="_blank">
        <i class="blue location arrow icon"></i> Google карты
      </a>

      {{-- Editing end --}}

      <a href="{{ route('google.university', $university) }}" class="item" target="_blank">
        <i class="green google icon"></i> Найти в Google
      </a>

      <a href="{{ route('vipusknik.university', $university->slug) }}" class="item" target="_blank">
        <i class="orange checkmark box icon"></i> Выпускник.Kz
      </a>

      <div class="divider"></div>

      <a href="#" class="item"
        onclick="event.preventDefault();
          document.getElementById('toggle-model-{{ $university->id }}-status').submit();">
        <i class="yellow star icon"></i>  Сделать {{ $university->is_paid ? 'не ' : '' }}платником
      </a>

      <form action="{{ route('university.status.toggle', $university) }}" method="post" id="toggle-model-{{ $university->id }}-status">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
      </form>

      @if (! $university->pin)
        <a href="#" class="item"
          onclick="event.preventDefault();
            document.getElementById('generate-institution-{{ $university->id }}-pin-form').submit();">
          <i class="grey privacy icon"></i>  Сгенерировать пин
        </a>

        <form action="{{ route('universities.pins.store', $university) }}" method="post"
          id="generate-institution-{{ $university->id }}-pin-form">
          {{ csrf_field() }}
        </form>

      @else
        <a href="#" class="item"
          onclick="event.preventDefault();
            document.getElementById('delete-institution-{{ $university->id }}-pin-form').submit();">
          <i class="brown privacy icon"></i>  Удалить пин
        </a>

        <form action="{{ route('universities.pins.destroy', $university) }}"
              method="post"
              id="delete-institution-{{ $university->id }}-pin-form">

          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>

      @endif


      {{-- Deleting --}}
      <a href="#" class="item"
        onclick="event.preventDefault();
          document.getElementById('delete-university-{{ $university->id }}').submit();">
        <i class="red delete icon"></i>  Удалить
      </a>
      <form action="{{ route('universities.destroy', $university) }}" method="post"
        id="delete-university-{{ $university->id }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
      </form>
      {{-- Deleting end --}}
    </div>
  </div>
