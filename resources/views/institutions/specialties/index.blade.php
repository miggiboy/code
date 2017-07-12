@extends ('layouts.app')

@section ('title')
  {{ $institution->title . ' - ' . translate($related, 'i', 'p') }}
@endsection

@section ('content')

  <div class="ui custom-table-page container">
    <h2 class="ui header">
      {{ translate($related, 'i', 'p', true) . ' ' . translate(Request::route('studyForm'), 'r', 's') }}
      <br>

      <a href="{{ route('institutions.show', [str_plural($institution->type), $institution]) }}"
         title="{{ $institution->title }}"
         class="custom-link">
        {{ str_limit($institution->title, 50) }}
      </a><br>
      @if (count($institution->specialties))

        <div class="ui medium teal buttons" style="margin-top: 15px;">
          <a href="{{ route("institutions.{$related}.edit", [$institution, Request::route('studyForm')]) }}"
             class="ui button">
            Обновить цены, сроки
          </a>
          <div class="or" id = "or"></div>
          <a href="{{ route("institutions.{$related}.create", [$institution, Request::route('studyForm')]) }}"
             class="ui button">
            Редактировать список
          </a>
        </div>
      @else
        <a href="{{ route("institutions.{$related}.create", [$institution, Request::route('studyForm')]) }}"
           class="ui teal button"
           style="margin-top: 15px;">
          Добавить {{ translate($related, 'i', 'p') }}
        </a>
      @endif
    </h2>
    @if (count($institution->specialties))
      @include ('institutions/specialties/partials/_specialties_table')
    @endif
  </div>
  <br>
  <br>
  <br>
@endsection
