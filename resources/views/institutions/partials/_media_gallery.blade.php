@if (count($model->getMedia('images')) || count($model->getMedia('logo')))
  <div id="gallery" style="display:none;">
    @if ($logo = $model->getMedia('logo'))
        @foreach ($logo as $mediaItem)
          <a href="{{ route('home') }}/">
          <img alt="{{ $mediaItem->name }}"
               src="{{ parse_url($mediaItem->getUrl('thumb'), PHP_URL_PATH) }}"
               data-image="{{ parse_url($mediaItem->getUrl(), PHP_URL_PATH) }}"
               data-description="{{ $mediaItem->name }}"
               style="display:none">
          </a>
        @endforeach
    @endif

    @if ($media = $model->getMedia('images'))
        @foreach ($media as $mediaItem)
          <a href="{{ route('home') }}/">
          <img alt="{{ $mediaItem->name }}"
               src="{{ parse_url($mediaItem->getUrl('thumb'), PHP_URL_PATH) }}"
               data-image="{{ parse_url($mediaItem->getUrl(), PHP_URL_PATH) }}"
               data-description="{{ $mediaItem->name }}"
               style="display:none">
          </a>
        @endforeach
    @endif
  </div>
  <a href="#"
     onclick="event.preventDefault(); $('#delete-gallery-items-modal').modal({ inverted: true }).modal('show');"
     style="text-decoration:none; color: #000; opacity:0.7;">Редактировать галерею</a>
  <br><br><br>

  <div class="ui modal" id="delete-gallery-items-modal">
    <i class="close icon"></i>
    <div class="header">
      Редактирование галереи
    </div>
    <div class="content">

      <div class="ui grid">

        @foreach ($logo as $mediaItem)
          <div class="row">
            <div class="four wide column">
              <div class="ui middle aligned small image">
                <a href="{{ $mediaItem->getUrl() }}" target="_blank" title="Просмотреть">
                  <img src="{{ $mediaItem->getUrl('thumb') }}">
                </a>
              </div>
            </div>
            <div class="four wide column middle aligned">
              <div class="ui teal button"
                   onclick="event.preventDefault(); toggleLogo({{ $model->id }}, '{{ $modelType }}', {{ $mediaItem->id }});"
                   id="toggle-logo-button-{{ $mediaItem->id }}">Является логотипом</div>
            </div>
            <div class="three wide column middle aligned">
              <div class="ui yellow button"
                   onclick="event.preventDefault(); deleteMedia('{{ $modelType }}', {{ $mediaItem->id }});"
                   id="delete-media-{{ $mediaItem->id }}">
                Удалить
              </div>
            </div>
          </div>
        @endforeach



        @foreach ($media as $mediaItem)
          <div class="row">
            <div class="four wide column">
              <div class="ui middle aligned small image">
                <a href="{{ $mediaItem->getUrl() }}" target="_blank" title="Просмотреть">
                  <img src="{{ $mediaItem->getUrl('thumb') }}">
                </a>
              </div>
            </div>
            <div class="four wide column middle aligned">
              <div class="ui teal button"
                   onclick="event.preventDefault(); toggleLogo({{ $model->id }}, '{{ $modelType }}', {{ $mediaItem->id }});"
                   id="toggle-logo-button-{{ $mediaItem->id }}">
                Сделать логотипом
              </div>
            </div>
            <div class="three wide column middle aligned">
              <div class="ui yellow button"
                   onclick="event.preventDefault(); deleteMedia('{{ $modelType }}', {{ $mediaItem->id }});"
                   id="delete-media-{{ $mediaItem->id }}">
                Удалить
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>

@endif


