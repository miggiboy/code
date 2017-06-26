@extends ('layouts.app')

@section ('title')
  {{ $institution->title }} - специальности
@endsection

@section ('content')
  <div class="ui custom-table-page container">
    <h2 class="ui header">
      Специальности {{ Translator::get(Request::route('studyForm'), 'r', 's') }}<br>

      <a href="{{ route('institutions.show', [str_plural($institution->type), $institution]) }}"
         title="{{ $institution->title }}"
         class="custom-link">
        {{ str_limit($institution->title, 50) }}
      </a><br>
      @if ($institution->specialties->count())

        <div class="ui medium teal buttons" style="margin-top: 15px;">
          <a href="{{ route('institutions.specialties.edit', [$institution, Request::route('studyForm')]) }}" class="ui button">
            Редактировать цены, сроки
          </a>
          <div class="or"></div>
          <a href="{{ route('institutions.specialties.create', [$institution, Request::route('studyForm')]) }}" class="ui button">
            Добавить специальности
          </a>
        </div>
      @else
        <a href="{{ route('institutions.specialties.create', [$institution, Request::route('studyForm')]) }}"
           class="ui teal button"
           style="margin-top: 15px;">
          Добавить специальности
        </a>
      @endif
    </h2>
    @if ($institution->specialties->count())
      @include ('institutions/specialties/partials/_specialties_table')
    @endif
  </div>
  <br>
  <br>
  <br>
@endsection
