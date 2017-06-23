@extends ('layouts.master')

@section ('title')
  {{ $pageTitle = 'Специальности ' . Translator::get($institutionType, 'r', 's') }}
@endsection

@section ('subnavigation')
    @include('specialties.partials.navigation', ['pageTitle' => $pageTitle])
@endsection

@section ('content')
<br>
<div class="ui grid">
  <div class="thirteen wide column">
    <div class="ui very padded segment">
      @include ('specialties/partials/index/_search_form')
      <br>
      @include ('specialties/partials/index/_list')
    </div>
  </div>
  @include ('specialties/partials/index/_directions')
</div>
<br>

{{ $specialties->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>

@endsection

@section ('script')

  @include ('includes/_rt-search-script', [
    'search_class' => '.ui.search',
    'path' => Request::route('institutionType') . "-specialties/rt-search",
    'fields' => [
        'description' => 'description',
        'url' => 'url',
    ]
  ])

  <script src="/js/marks.js"></script>
@endsection
