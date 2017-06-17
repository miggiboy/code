@extends ('layouts.master')

@section ('title')
    {{ $university->title }} - добавление специальностей
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 10px;">

        <h2 style="margin-bottom: 30px; text-align: center;">
            Специальности @if ($studyForm === 'full-time') очной @elseif ($studyForm === 'extramural') заочной  @endif формы<br>
            <a href="{{ route('universities.show', $university->slug) }}" target="_blank" title="{{ $university->title }}">
                {{ str_limit($university->title, 50) }}
            </a>
        </h2>
        @include ('universities/specialties/partials/_creation_form')
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
