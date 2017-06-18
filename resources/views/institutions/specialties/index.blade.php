@extends ('layouts.master')

@section ('title')
  {{ $institution->title }} - специальности
@endsection

@section ('styles')
  <style>
    .custom.container {
      width:1000px;
      margin: 0 auto;
      margin-top: 40px;
    }

    a {
    color: #444;
    text-decoration: none;
   }

    a:hover {
    text-decoration: underline;
   }
  </style>
@endsection

@section ('content')
  <div class="ui custom container">
    <h2 class="ui header" style="text-align:center; margin-bottom: 40px;">
      Специальности @if (request()->route('institutionType') === 'full-time') очной @elseif (request()->route('institutionType') === 'extramural') заочной  @endif формы университета<br>

      <a href="{{ route('institutions.show', [request()->route('institutionType'), $institution]) }}">
        {{ str_limit($institution->title, 50) }}
      </a><br>
      @if ($institution->specialities->count())
        <a href="{{ route('institutions.specialties.edit', [request()->route('institutionType'), $institution, request()->route('studyForm')]) }}"
           class="ui teal button"
           style="margin-top: 15px;">
        Редактировать
        </a>
      @else
        <a href="{{ route('institutions.specialties.create', [request()->route('institutionType'), $institution, request()->route('studyForm')]) }}"
           class="ui teal button"
           style="margin-top: 15px;">
          Добавить специальности
        </a>
      @endif
    </h2>
    @if ($institution->specialities->count())
      @include ('institutions/specialties/partials/_specialties_table')
    @endif
  </div>
  <br>
  <br>
  <br>
@endsection
