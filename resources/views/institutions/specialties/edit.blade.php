@extends ('layouts.app')

@section ('title')
  {{ $institution->title }} - специальности
@endsection

@section ('head')
  <style>
    .custom.container {
      width: 1000px;
      margin: 0 auto;
      margin-bottom: 50px;
    }

    a {
    color: #444;
    text-decoration: none;
   }

    a:hover {
    text-decoration: none;
   }
  </style>
@endsection

@section ('content')

  <div class="ui custom container">
    <h2 style="margin-bottom: 50px; text-align: center;">
      <a href="{{ route('institutions.show', [str_plural($institution->type), $institution]) }}"
         target="_blank"
         title="{{ $institution->title }}">
        {{ str_limit($institution->title, 55) }}
      </a><br>
      специальности {{ Translator::get(Request::route('studyForm'), 'r', 's') }}
    </h2>
    @include ('institutions/specialties/partials/_edition_form')
  </div>
  <br>
  <br>
@endsection

@section('script')
    <script src="/js/specialty-details.js"></script>
@endsection
