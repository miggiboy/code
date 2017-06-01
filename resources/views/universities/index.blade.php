@extends ('layouts.master')

@section ('title', 'Университеты')

@section ('subnavigation')
    @include('universities.partials.navigation', ['pageTitle' => 'Университеты'])
@endsection

@section ('content')
<br>
<div class="ui grid">
  <div class="thirteen wide column">
    <div class="ui very padded segment">
      @include ('universities/partials/index/_search_form')
      @include ('universities/partials/index/_list')
    </div>
  </div>
  @include ('universities/partials/index/_cities')
</div>
<br>
{{ $universities->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
