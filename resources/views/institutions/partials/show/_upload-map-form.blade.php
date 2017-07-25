<div class="image content">
  <div class="ui medium image">
    <a href="{{ $institution->googleMapsUrl() }}"
       class="item"
       target="_blank"
       title="Найти {{ translate($institution->type, 'i', 's') }} в Google картах">
      <img src="/images/map.svg">
    </a>
  </div>

  <div class="description">
    <div class="ui header">Прикрепляем карту</div>
    <form action="{{ route("institutions.maps.{$action}", $institution) }}"
          method="post"
          id="map-form"
          class="ui form">
      {{ csrf_field() }}
      {{ method_field(strtoupper($method)) }}

      <div class="field">
        <textarea name="source_code" id="" cols="66" rows="12"></textarea>
      </div>
    </form>
  </div>

</div>
<div class="actions">
  <div class="ui positive right labeled icon button"
       onclick="event.preventDefault();
       document.getElementById('map-form').submit();">
    Сохранить <i class="checkmark icon"></i>
  </div>
</div>
