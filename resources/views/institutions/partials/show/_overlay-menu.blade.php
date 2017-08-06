<div class="overlay">
  <div class="ui vertical icon menu">
    <a class="item"
       href="{{ route('institutions.edit', [str_plural($institution->type), $institution]) }}"
       title="Редактировать {{ translate($institution->type, 'i', 's') }}">
      <i class="blue edit icon"></i>
    </a>

    <a class="item"
       title="Добавить изображения"
       onclick="event.preventDefault(); $('#add-media-modal').modal({ inverted: true }).modal('show');">
      <i class="green photo icon"></i>
    </a>
    <a class="item"
       title="Карта ({{ $institution->hasMap() ? 'Есть' : 'Нет' }})"
       onclick="event.preventDefault(); $('#map-modal').modal({ inverted: true }).modal('show');">
      <i class="{{ $institution->hasMap() ? 'yellow' : 'grey' }} map icon"></i>
    </a>
  </div>
</div>
