@extends ('layouts.master')

@section ('title', 'Профессии')

@section ('subnavigation')
    @include ('professions.partials.navigation', ['pageTitle' => 'Профессии'])
@endsection

@section ('content')
<br><br>
<div class="ui grid">

  <div class="thirteen wide column">
    <div class="ui very padded segment">
      @include ('professions/partials/index/_search-form')
      @include ('professions/partials/index/_list')
    </div>
  </div>

  <div class="three wide column">
      @include ('professions/partials/index/_categories')
  </div>
</div>
<br>

{{ $professions->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>

@endsection

@section ('script')

  @include ('includes/_rt-search-script', [
    'search_class' => '.ui.search',
    'path' => 'professions/rt-search',
    'fields' => [
        'url' => 'url',
    ]
  ])
@endsection
