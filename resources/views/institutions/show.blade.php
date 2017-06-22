@extends ('layouts.master')

@section ('title')
  {{ $institution->title }}
@endsection

@section ('subnavigation')
    @include('institutions.partials.navigation', ['view' => 'show', 'pageTitle' => $institution->title])
@endsection

@section ('head')

  <link rel='stylesheet' href='/js/vendor/unitegallery/package/unitegallery/css/unite-gallery.css'>

  <style>
    #map-update-form {
      display: none;
    }

    .overlay {
        position: fixed; bottom: 42px; right: 37px; z-index: 10;
    }
  </style>
@endsection

@section ('content')
<div class="ui very relaxed grid">

  <div class="nine wide column" style="margin-right: 46px;">

    @include ('institutions/partials/show/_media_gallery')

    @include ('institutions/partials/show/_labels')

    @include ('institutions/partials/show/_institution_information')
    @include ('institutions/partials/show/_reception_committee_information')
  </div>

  <br>

  <div class="six wide column">

    <div class="row">
      @include ('institutions/partials/show/_institution_specialties')
    </div>

    <br>
    <div class="row">
      @include ('institutions/partials/show/_map')
    </div>

  </div>

</div>

@include ('institutions/partials/show/_add_image_modal_n_button')

@endsection

@section ('script')
  <script src="/js/map.js"></script>
  <script src="/js/marks.js"></script>

  <script src='/js/vendor/unitegallery/package/unitegallery/js/unitegallery.min.js'></script>
  <script src='/js/vendor/unitegallery/package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

  <script src="/js/medialibrary.js"></script>

  <script>

    jQuery("#gallery").unitegallery({
      tile_width:100,
      tile_height:100,
      grid_num_rows:1,
      lightbox_type: "compact"
    });
  </script>
@endsection
