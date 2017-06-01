@extends ('layouts.master')

@section ('title')
  {{ $college->title }} - специальности
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
      Специальности @if ($studyForm === 'full-time') очной @elseif ($studyForm === 'extramural') заочной  @endif формы колледжа<br>

      <a href="{{ route('colleges.show', $college->slug) }}" target="_blank">
        {{ str_limit($college->title, 50) }}
      </a><br>
      @if ($college->specialities->count())
        <a href="{{ route('college.specialties.edit', [$college, $studyForm]) }}" class="ui teal button" style="margin-top: 15px;">
        Редактировать
        </a>
      @else
        <a href="{{ route('college.specialties.create', [$college, $studyForm]) }}"
           class="ui teal button"
           style="margin-top: 15px;">
          Добавить специальности
        </a>
      @endif
    </h2>
    @if ($college->specialities->count())
      @include ('colleges/specialties/partials/_specialties_table')
    @endif
  </div>
  <br>
  <br>
  <br>
@endsection
