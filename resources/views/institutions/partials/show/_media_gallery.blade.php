@if ($institution->media->count())
  <div id="gallery" style="display:none;">

    @if ($institution->hasLogo())
        @include ('institutions/partials/show/_gallery-image', ['image' => $institution->logo()])
    @endif

    @if ($media = $institution->getMedia('images'))
        @each ('institutions/partials/show/_gallery-image', $media, 'image')
    @endif

  </div>

  <a href="#"
     onclick="event.preventDefault();
     $('#delete-gallery-items-modal').modal({ inverted: true }).modal('show');"
     style="text-decoration:none; color: #000; opacity:0.7;">
    Редактировать галерею
  </a>
  <br>
  <br>
  <br>

  @include ('institutions/partials/show/_edit-gallery-modal')

@endif
