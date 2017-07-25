<br>
@foreach ($model->markersOf(request('markers_of') ?? Auth::user()) as $marker)
  <i class="{{ $marker->color }} circle icon"></i>
@endforeach
