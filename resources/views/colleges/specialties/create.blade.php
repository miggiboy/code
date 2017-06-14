@extends ('layouts.master')

@section ('title')
    {{ $college->title }} - добавление @if (request('category') == 'qualifications') 'квалификаций' @else 'специальностей' @endif
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 10px;">

        <h2 style="margin-bottom: 30px; text-align: center;">
            @if (request('category') == 'qualifications') Квалификации @else Специальности @endif
             @if ($studyForm === 'full-time') ОЧНОЙ @elseif ($studyForm === 'extramural') ЗАОЧНОЙ  @endif формы<br>
            <a href="{{ route('colleges.show', $college->slug) }}" target="_blank" title="{{ $college->title }}">
                {{ str_limit($college->title, 50) }}
            </a>
        </h2>
          @include ('colleges/specialties/partials/_creation_form')
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
