@extends ('layouts.master')

@section ('title')
  {{ $university->title }} - специальности
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
      Специальности @if ($studyForm === 'full-time') очной @elseif ($studyForm === 'extramural') заочной  @endif формы университета<br>

      <a href="{{ route('universities.show', $university->slug) }}" target="_blank">
        {{ str_limit($university->title, 50) }}
      </a><br>
      @if ($university->specialities->count())
        <a href="{{ route('university.specialties.edit', [$university, $studyForm]) }}" class="ui teal button" style="margin-top: 15px;">
        Редактировать
        </a>
      @else
        <a href="{{ route('university.specialties.create', [$university, $studyForm]) }}"
           class="ui teal button"
           style="margin-top: 15px;">
          Добавить специальности
        </a>
      @endif
    </h2>
    @if ($university->specialities->count())
      @include ('universities/specialties/partials/_specialties_table')
    @endif
  </div>
  <br>
  <br>
  <br>
@endsection
