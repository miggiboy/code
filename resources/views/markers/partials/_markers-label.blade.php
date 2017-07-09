@php
    $markers = $model->markersOf(Auth::user());
@endphp

@if ($markers->count())
    <div class="ui basic label" title="Ваши отметки">
      Отметки: &nbsp;
      @foreach ($markers as $marker)
        <i class="{{ $marker->color }} circle icon"></i>
      @endforeach
    </div>
@endif
