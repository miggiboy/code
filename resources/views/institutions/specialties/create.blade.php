@extends ('layouts.app')

@section ('title')
    {{ $institution->title }} - добавление {{ Translator::get($related, 'r', 'p') }}
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 10px;">

        <h2 style="margin-bottom: 20px; text-align: center;">
            <a href="{{ route("institutions.{$related}.index", [$institution, Request::route('studyForm')]) }}"
               class="custom-link"
               target="_blank">
                {{ Translator::get($related, 'i', 'p', true) }}
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
