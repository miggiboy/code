@if ($model->getMedia())
  <div id="gallery" style="display:none;">
    @if ($media = $model->getMedia('logo'))
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
@endif
