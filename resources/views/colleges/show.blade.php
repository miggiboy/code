  @extends ('layouts.master')

@section ('title')
  {{ $college->title }}
@endsection

@section ('styles')
  <style>
    #map-update-form {
      display: none;
    }

    .overlay {
        position: fixed; bottom: 42px; right: 37px; z-index: 10;
    }
  </style>

  <link rel='stylesheet' href='/vendor/unitegallery/package/unitegallery/css/unite-gallery.css'>
@endsection

@section ('subnavigation')
    @include('colleges.partials.navigation', ['view' => 'show', 'pageTitle' => $college->title])
@endsection


@section ('content')
    <div class="ui very relaxed grid">
      <div class="nine wide column">

        @include ('institutions/partials/_media_gallery',
            ['model' => $college, 'modelType' => 'colleges']
        )

        @include ('institutions/partials/_labels',
            ['model' => $college]
        )

        @include ('colleges/partials/show/_college_information')
        @include ('colleges/partials/show/_reception_committee_information')
      </div>
      <br>
      <div class="one wide column"></div>

      <div class="six wide column">
        <div class="row">
          @include ('colleges/partials/show/_college_specialties')
        </div>
        <br>
        <div class="row">
          @include ('institutions/partials/_map',
              [
                  'model' => $college,
                  'modelType' => 'college'
              ]
          )
        </div>
      </div>
    </div>

    @include ('institutions/partials/_add_image_modal_n_button',
        [
          'model' => $college,
          'route' => 'college.images.store'
        ]
    )
@endsection
@section ('script')
  <script src="/js/map.js"></script>
  <script src="/js/marks.js"></script>

  <script src='/vendor/unitegallery/package/unitegallery/js/unitegallery.min.js'></script>
  <script src='/vendor/unitegallery/package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

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
