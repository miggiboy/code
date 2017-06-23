@extends ('layouts.master')

@section ('title')
  {{ $pageTitle = Translator::get($institutionType, 'i', 'p', true) }}
@endsection

@section ('subnavigation')
    @include('institutions.partials.navigation', ['pageTitle' => $pageTitle])
@endsection

@section ('content')
<br>
<div class="ui grid">

  <div class="thirteen wide column">
    <div class="ui very padded segment">
      @include ('institutions/partials/index/_search_form')
      @include ('institutions/partials/index/_list')
    </div>
  </div>

  <div class="three wide column">
    @include ('institutions/partials/index/_cities')
  </div>

</div>
<br>
{{ $institutions->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>
@endsection

@section ('script')

  @include ('includes/_rt-search-script', [
    'search_class' => '.ui.search',
    'path' => 'institutions/' . $institutionType . '/rt-search',
    'fields' => [
        'description' => 'description',
        'url' => 'url',
    ]
  ])

  <script src="/js/marks.js"></script>
@endsection
