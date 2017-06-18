<div class="ui vertical teal menu">
  <div class="item">
    <div class="header">Проф-направелния</div>
    <div class="menu">
      @foreach ($categories as $category)
        <a href="{{ route('professions.index', ['s[direction]' => $category->id]) }}"
           class="item">
          {{ $category->title }}
        </a>
      @endforeach
    </div>
  </div>
</div>
