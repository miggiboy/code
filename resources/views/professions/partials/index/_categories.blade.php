<div class="ui vertical teal menu">
  <div class="item">
    <div class="header">Категории</div>
    <div class="menu">
      @foreach ($categories as $category)
        <a href="{{ route('professions.index', ['category' => $category->id]) }}"
           class="item">
          {{ $category->title }}
        </a>
      @endforeach
    </div>
  </div>
</div>
