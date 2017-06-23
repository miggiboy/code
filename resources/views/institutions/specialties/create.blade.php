@extends ('layouts.app')

@section ('title')
    {{ $institution->title }} - добавление специальностей
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 10px;">

        <h2 style="margin-bottom: 30px; text-align: center;">
            Специальности {{ Translator::get(Request::route('studyForm'), 'r', 's') }}

            <br>
            <a href="{{ route('institutions.show', [str_plural($institution->type), $institution]) }}"
               target="_blank"
               title="{{ $institution->title }}">

                {{ str_limit($institution->title, 50) }}
            </a>
        </h2>
        @include ('institutions/specialties/partials/_creation_form')
    </div>

@endsection

@section ('script')
    @include ('includes/_multiple-selection-dropdown-script', ['allowAdditions' => false])
@endsection
