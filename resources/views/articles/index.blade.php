@extends ('layouts.master')

@section ('title', 'Статьи')

@section ('subnavigation')
    @include ('articles.partials.navigation', ['pageTitle' => 'Статьи'])
@endsection

@section ('content')
<br><br>
<div class="ui grid">

  <div class="thirteen wide column">
    <div class="ui very padded segment">
      @include ('articles/partials/index/_search-form')
      @include ('articles/partials/index/_list')
    </div>
  </div>

  <div class="three wide column">
      @include ('articles/partials/index/_categories')
  </div>

</div>
{{ $articles->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>

@endsection
