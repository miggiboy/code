@extends ('layouts.master')

@section ('title', 'Колледжи')

@section ('subnavigation')
    @include('colleges.partials.navigation', ['pageTitle' => 'Колледжи'])
@endsection

@section ('content')
<br>
<div class="ui grid">
  <div class="thirteen wide column">
    <div class="ui very padded segment">

      @include ('colleges/partials/index/_search_form')

      <br>

      @include ('colleges/partials/index/_colleges_list')

      <br>
    </div>
  </div>

  @include ('colleges/partials/index/_cities_list')

</div>
<br>
{{ $colleges->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
