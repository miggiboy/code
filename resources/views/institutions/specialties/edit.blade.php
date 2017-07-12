@extends ('layouts.app')

@section ('title')
  {{ $institution->title }} - {{ Translator::get($related, 'i', 'p') }}
@endsection

@section ('content')

  <div class="ui custom-table-page container">
    <h2 class = "ui header">
      <a href="{{ route('institutions.show', [str_plural($institution->type), $institution]) }}"
         target="_blank"
         title="{{ $institution->title }}"
          class="custom-link">
        {{ str_limit($institution->title, 55) }}
      </a><br>
      {{ Translator::get($related, 'i', 'p') }} {{ Translator::get(Request::route('studyForm'), 'r', 's') }}
    </h2>
    @include ('institutions/specialties/partials/_edition_form')
  </div>
  <br>
  <br>
@endsection

@section('script')
    <script src="/js/specialty-details.js"></script>
@endsection
