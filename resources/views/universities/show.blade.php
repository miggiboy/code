@extends ('layouts.master')

@section ('title')
  {{ $university->title }}
@endsection

@section ('subnavigation')
    @include('universities.partials.navigation', ['view' => 'show', 'pageTitle' => $university->title])
@endsection

@section ('styles')

  <link rel='stylesheet' href='/vendor/unitegallery/package/unitegallery/css/unite-gallery.css'>

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

    @include ('institutions/partials/_media_gallery',
        ['model' => $university, 'modelType' => 'universities']
    )

    @include ('institutions/partials/_labels',
        ['model' => $university]
    )

    @include ('universities/partials/_university_information')
    @include ('universities/partials/_reception_committee_information')
  </div>

  <br>

  {{-- <div class="one wide column"></div> --}}

  <div class="six wide column">

    <div class="row">
      @include ('universities/partials/_university_specialties')
    </div>

    <br>
    <div class="row">
      @include ('institutions/partials/_map',
          ['model' => $university]
      )
    </div>

  </div>

</div>

@include ('institutions/partials/_add_image_modal_n_button',
    [
      'model' => $university,
      'route' => 'university.images.store'
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

    function showPin(institutionId)
    {
       let pin = {{ $university->pin }}

       //
    }

    function generatePin(institutionId)
    {

      axios.post('/' + institutionId + '/pin')
        .then(function (response) {
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        });

      showPin()
    }

    function showPin()
    {
        $('#pin-label').text('Пин вуза: ' + {{ $university->pin }})
    }

    function hidePin()
    {
       $('#pin-label').text('Показать пин')
    }

    jQuery("#gallery").unitegallery({
      tile_width:100,
      tile_height:100,
      grid_num_rows:1,
      lightbox_type: "compact"
    });
  </script>
@endsection
