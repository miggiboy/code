<div class="ui modal" id="map-modal">
  <i class="close icon"></i>
  <div class="header">
    Добавление карты {{ translate($institution->type, 'r', 's') }} &nbsp;

    <a href="{{ $institution->googleMapsUrl() }}"
       class="item"
       target="_blank"
       title="Найти {{ translate($institution->type, 'i', 's') }} в Google картах">
      <i class="blue location arrow icon"></i>Найти в Google картах
    </a>
  </div>
  @if ($institution->hasMap())
    <div class="description">
        <div id="map">
          {!! $institution->map->source_code !!}
        </div>
    </div>

    <form action="{{ route('institutions.maps.destroy', $institution) }}" method="post" id="delete-map-form">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    <div class="actions">
      <div class="ui right labeled icon button"
           onclick="confirmDeletion('delete-map-form', 'Карту');">
        Удалить карту <i class="delete icon"></i>
      </div>
    </div>

  @else
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
        <div class="ui header">Код карты</div>
        <form action="{{ route("institutions.maps.store", $institution) }}"
              method="post"
              id="map-form"
              class="ui form">
          {{ csrf_field() }}

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

  @endif
</div>


