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
                  @include ('institutions/partials/_options')
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
    <div class="row">
      {{-- @include ('institutions/partials/show/_map') --}}
    </div>
  </div>
</div>

@include ('institutions/partials/show/_add_image_modal')

<div class="overlay">
  <a href=""
     onclick="event.preventDefault(); $('#add-media-modal').modal({ inverted: true }).modal('show');"
     class="ui huge green circular icon button"
     title="Добавить изображения">
    <i class="ui photo icon"></i>
  </a>
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
