<div class="ui modal" id="map-modal">
  <i class="close icon"></i>
  <div class="header">
    Карта {{ translate($institution->type, 'r', 's') }} &nbsp;

    <a href="{{ $institution->googleMapsUrl() }}"
       class="item"
       target="_blank"
       title="Найти {{ translate($institution->type, 'i', 's') }} в Google картах">
      <i class="blue location arrow icon"></i>Google карты
    </a>
  </div>
  @if ($institution->hasMap())
    <div class="description">
        <div id="map">
          {!! $institution->map->source_code !!}
        </div>
    </div>

    <div id="update-map-form" style="display: none;">
      @include ('institutions/partials/show/_upload-map-form', [
          'action' => 'update',
          'method' => 'PATCH',
      ])
    </div>

    <div class="ui fluid teal button" id="update-map-button">
      Загрузить новую карту
    </div>
  @else
    @include ('institutions/partials/show/_upload-map-form', [
        'action' => 'store',
        'method' => 'POST',
    ])
  @endif
</div>
