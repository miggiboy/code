@extends ('layouts.app')

@section ('title')
  {{ $institution->title }}
@endsection

@section ('head')
  <link rel='stylesheet' href='/js/vendor/unitegallery/package/unitegallery/css/unite-gallery.css'>
  <style>
    .overlay {
        position: fixed; bottom: 42px; right: 37px; z-index: 10;
    }

    #map > iframe {
      width: 850px;
      height: 400px;
      margin: 15px 0 15px 25px;
    }
  </style>
@endsection

@section ('subnavigation')
  @component ('institutions/partials/_navigation', ['institutionType' => $institutionType])
    @slot ('custom_heading_layout')
        <div class="nine wide column">
          <div class="ui grid">
              <div class="fifteen wide column">
                  <h1>{{ $institution->title }}</h1>
              </div>

              <div class="one wide column">
                  @include ('institutions/partials/_options', [
                      'show_google_map_option' => true
                  ])
              </div>
          </div>
      </div>
    @endslot
  @endcomponent
@endsection

@section ('content')

<div class="ui very relaxed grid">
  <div class="nine wide column">
    @include ('institutions/partials/show/_media_gallery')
    @include ('institutions/partials/show/_labels')
    @include ('institutions/partials/show/_institution_information')
    @include ('institutions/partials/show/_reception_committee_information')
  </div>

  <div class="one wide column"></div>
  <br>

  <div class="six wide column">
    <div class="row">
      @include ('institutions/partials/show/_institution_specialties')
    </div>
    <br>
  </div>
</div>

@include ('institutions/partials/show/_add_image_modal')
@include ('institutions/partials/show/_map_modal')

<div class="overlay">
  <div class="ui vertical icon menu">
    <a class="item"
       title="Изображения"
       onclick="event.preventDefault(); $('#add-media-modal').modal({ inverted: true }).modal('show');">
      <i class="green photo icon"></i>
    </a>
    <a class="item"
       title="Карта ({{ $institution->hasMap() ? 'Есть' : 'Нет' }})"
       onclick="event.preventDefault(); $('#map-modal').modal({ inverted: true }).modal('show');">
      <i class="{{ $institution->hasMap() ? 'yellow' : 'red' }} map icon"></i>
    </a>
  </div>
</div>

@endsection

@section ('script')
  <script src="/js/vendor/readmore/readmore.min.js"></script>

  <script src='/js/vendor/unitegallery/package/unitegallery/js/unitegallery.min.js'></script>
  <script src='/js/vendor/unitegallery/package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

  <script src="/js/gallery.js"></script>

  <script>
    jQuery("#gallery").unitegallery({
      tile_width:100,
      tile_height:100,
      grid_num_rows:1,
      lightbox_type: "compact"
    });

    $('article').readmore({
      collapsedHeight: 110,
      speed: 500,
      moreLink: '<a href="#">Подробнее</a>',
      lessLink: '<a href="#">Свернуть</a>'
    });
  </script>
@endsection
