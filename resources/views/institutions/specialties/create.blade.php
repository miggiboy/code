@extends ('layouts.app')

@section ('title')
    {{ $institution->title }} - добавление специальностей
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 10px;">

        <h2 style="margin-bottom: 20px; text-align: center;">
            <a href="{{ route('institutions.specialties.index', [$institution, Request::route('studyForm')]) }}">
                Специальности
            </a>
            {{ Translator::get(Request::route('studyForm'), 'r') }}

            <br>
            <a href="{{ route('institutions.show', [str_plural($institution->type), $institution]) }}"
               target="_blank"
               title="{{ $institution->title }}"
               class="custom-link">
                    {{ str_limit($institution->title, 50) }}
            </a>
        </h2>

    @include ('institutions/specialties/partials/_creation_form')
    </div>

@endsection

@section ('script')
    @include ('includes/_multiple-selection-dropdown-script')
@endsection
