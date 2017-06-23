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
  <script>
    $('.ui.search.specialties').search({
      apiSettings: {
          url: "//mustim09.beget.tech/specialties/search/autocomplete?query={query}&inst={{ request('inst') }}"
      },
     fields: {
          results     : 'specialties',
          title       : 'title',
          description : 'code',
          url         : 'url'
      },
      error : {
        noResults   : 'Поиск не дал результатов',
        serverError : 'Произошла ошибка при поиске...',
      },
      minCharacters : 2
  });

  </script>

  <script src="/js/marks.js"></script>
@endsection
