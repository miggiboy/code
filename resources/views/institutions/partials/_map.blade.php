@if ($model->map)
  <div id="map">
    {!! $model->getResizedMap(375, 300) !!}
  </div>

  <button class="ui fluid button" id="replace-map-button" onclick="event.preventDefault(); showMapReplacementForm();">Заменить карту</button>

  <form action="{{ route('map.update', [$modelType, $model->id]) }}" method="post" class="ui form" id="map-update-form">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="field">
      <label for="source_code">Код карты</label>
      <textarea name="source_code" id="source_code" cols="30" rows="7" required></textarea>
    </div>
    <button type="submit" class="ui fluid teal button">Обновить карту</button>
  </form>

@else
  @include  ('layouts.form-errors')
  <form action="{{ route('map.store', [$modelType, $model->id]) }}" method="post" class="ui form">
    {{ csrf_field() }}
    <div class="field">
      <label for="source_code">Код карты</label>
      <textarea name="source_code" id="source_code" cols="30" rows="7" required></textarea>
    </div>
    <button type="submit" class="ui fluid teal button">Сохранить карту</button>
  </form>
@endif
