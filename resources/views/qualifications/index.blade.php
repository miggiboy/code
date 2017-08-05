@extends ('layouts.app')

@section ('title')
  {{ $heading = 'Квалификации' }}
@endsection

@section ('subnavigation')
    @include('qualifications/partials/_navigation', ['heading' => $heading])
@endsection

@section ('content')
<br>
<div class="ui grid">
  <div class="column">
    <div class="ui very padded segment">
      @include ('qualifications/partials/index/_search-form')
      <br>
      @include ('qualifications/partials/index/_list')
    </div>
  </div>
</div>
<br>

{{ $qualifications->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}

<br>
<br>

@endsection

@section ('script')

  @include ('includes/_rt-search-script', [
    'search_class' => '.ui.search',
    'path' => 'qualifications/rt-search',
    'fields' => [
        'url' => 'url',
    ]
  ])
@endsection
