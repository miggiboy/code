<div class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>
    <a href="{{ route('specialties.edit', [$specialty, 'inst' => request('inst')]) }}" class="item" target="_blank">
      <i class="blue edit icon"></i>  Редактировать
    </a>

    <a href="{{ url($specialty->googleSearchUrl()) }}" class="item" target="_blank">
      <i class="green google icon"></i> Найти в Google
    </a>

    <a href="{{ url($specialty->urlAtPrimaryApp()) }}" class="item" target="_blank">
      <i class="orange checkmark box icon"></i> Выпускник.Kz
    </a>


    <div class="divider"></div>

    {{-- Deleting --}}
    <a href="#" class="item"
      onclick="event.preventDefault();
        document.getElementById('delete-specialty-{{ $specialty->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('specialties.destroy', $specialty) }}" method="post"
      id="delete-specialty-{{ $specialty->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <input type="hidden" name="inst" value="{{ request()->inst }}">
    </form>
    {{-- Deleting end --}}
  </div>
</div>
