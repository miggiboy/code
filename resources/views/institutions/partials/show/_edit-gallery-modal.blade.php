<div class="ui modal" id="delete-gallery-items-modal">
  <i class="close icon"></i>
  <div class="header">
    Редактирование галереи
  </div>
  <div class="content">

    <div class="ui grid">

      @foreach ($institution->media as $image)
        <div class="row">
          <div class="four wide column">
            <div class="ui middle aligned small image">
              <a href="{{ $image->getUrl() }}" target="_blank" title="Просмотреть">
                <img src="{{ $image->getUrl('thumb') }}">
              </a>
            </div>
          </div>
          <div class="four wide column middle aligned">
            <div class="ui teal button"
                 onclick="event.preventDefault();
                 toggleLogo('{{ $institution->slug }}', {{ $image->id }});"
                 id="toggle-logo-button-{{ $image->id }}">
              {{ $image->collection_name == 'logo' ? 'Является' : 'Сделать' }} логотипом
            </div>
          </div>
          <div class="three wide column middle aligned">
            <div class="ui yellow button"
                 onclick="event.preventDefault();
                 deleteMedia({{ $image->id }});"
                 id="delete-media-{{ $image->id }}">
              Удалить
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</div>
