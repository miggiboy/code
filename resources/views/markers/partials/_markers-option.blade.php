<div class="item">
  <i class="left teal dropdown icon"></i>
  <span class="text">Ваша отметка</span>
  <div class="left menu">
    @foreach (Marker::colors() as $color)
      @if ($model->isMarkedByCurrentUserWith($color))
        <a href="#"
           onclick="event.preventDefault();
           document.getElementById('unmark-model-{{ $model->id }}-{{ $color }}').submit();"
           class="item"
           target="_blank">
          <i class="{{ $color }} circle icon"></i> Снять
        </a>

        <form action="{{ route('markers.destroy', [$modelType, $model->id]) }}"
              method="post"
              id="unmark-model-{{ $model->id }}-{{ $color }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <input type="hidden" name="color" value="{{ $color }}">
        </form>
      @else
        <a href="#"
           onclick="event.preventDefault();
           document.getElementById('mark-model-{{ $model->id }}-{{ $color }}').submit();"
           class="item"
           target="_blank">
          <i class="{{ $color }} circle icon"></i> Поставить
        </a>

        <form action="{{ route('markers.store', [$modelType, $model->id]) }}"
              method="post"
              id="mark-model-{{ $model->id }}-{{ $color }}">
          {{ csrf_field() }}
          <input type="hidden" name="color" value="{{ $color }}">
        </form>
      @endif

    @endforeach
  </div>
</div>
