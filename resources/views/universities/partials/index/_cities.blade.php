<div class="three wide column">
  <div class="ui vertical teal menu">
    <div class="item">
      <div class="header">Города</div>
        <div class="menu">
          @foreach ($cities as $city)
            <a href="{{ route('universities.search', ['city' => $city->id]) }}" class="item">
              {{ $city->title }}
            </a>
          @endforeach
        </div>
    </div>
  </div>
</div>
