<br>
@foreach ($model->markersOf(Auth::user()) as $marker)
  <i class="{{ $marker->color }} circle icon"></i>
@endforeach
