<div class="three wide column">
  <div class="ui vertical teal menu">
      <div class="item">
        <div class="header">Направления</div>
        <div class="menu">
          @foreach ($directions as $direction)
            <a href="{{ route('specialties.index', [$institutionType, 'direction' => $direction->id]) }}"
               class="item"
               title="{{ $direction->title }}">

              {{ str_limit($direction->title, 25) }}
            </a>
          @endforeach
        </div>
      </div>
    </div>
</div>
