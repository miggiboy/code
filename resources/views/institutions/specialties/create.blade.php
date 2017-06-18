@extends ('layouts.master')

@section ('title')
    {{ $institution->title }} - добавление специальностей
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 10px;">

        <h2 style="margin-bottom: 30px; text-align: center;">
            Специальности {{ Translator::get(request()->route('studyForm'), 'r', 's') }}

            <br>
            <a href="{{ route('institutions.show', [request()->route('institutionType'), $institution]) }}" target="_blank" title="{{ $institution->title }}">
                {{ str_limit($institution->title, 50) }}
            </a>
        </h2>
        @include ('institutions/specialties/partials/_creation_form')
    </div>

@endsection

@section ('script')
    <script>
        $(document).ready(function() {
              $('.ui.form').keydown(function(event){
                if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
                  alert('shit');
              }
           });
        });

        $('.ui.dropdown').dropdown({
            fullTextSearch: true,
            match:'text',
            allowAdditions: true,
            keys : {
              delimiter  : false, // comma
        } });
    </script>
@endsection
