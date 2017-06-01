@extends ('layouts.master')

@section ('title')
  {{ $university->title }} - специальности
@endsection

@section ('content')
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

  <div class="ui custom container">
    <h2 style="margin-bottom: 50px; text-align: center;">
      <a href="{{ route('universities.show', $university->slug) }}" target="_blank" title="{{ $university->title }}">
        {{ str_limit($university->title, 55) }}
      </a><br>
      специальности @if ($studyForm === 'full-time') очной @elseif ($studyForm === 'extramural') заочной  @endif формы
    </h2>
    @include ('universities/specialties/partials/_edition_form')
  </div>
  <br>
  <br>
@endsection

@section('script')
    <script src="/js/dynamic-speciality-details.js"></script>
@endsection
