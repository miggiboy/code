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
        ['model' => $university]
    )

    <div class="ui purple horizontal label">ID:  {{ $university->id }}</div>

    <a class="ui basic label{{ $university->markedByCurrentUser ? ' marked' : '' }}" id="marker"
        onclick="event.preventDefault(); toggleMark('University', '{{ $university->id }}');">
      @if ($university->markedByCurrentUser)
        Отмечено
      @else
        Отметить
      @endif
    </a>



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
          [
              'model' => $university,
              'modelType' => 'university'
          ]
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

  <script type='text/javascript' src='/vendor/unitegallery/package/unitegallery/js/unitegallery.min.js'></script>
  <script type='text/javascript' src='/vendor/unitegallery/package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

  <script>
    jQuery("#gallery").unitegallery({
      tile_width:100,
      tile_height:100,
      grid_num_rows:1,
      lightbox_type: "compact"
    });
  </script>
@endsection
