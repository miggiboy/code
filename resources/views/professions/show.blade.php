@extends ('layouts.master')

@section ('title', 'Профессии')

@section ('subnavigation')
    @include('professions.partials.navigation', ['pageTitle' => "Профессия \"". $profession->title ."\""])
@endsection

@section ('styles')
    <style>
        .ui.container.custom {
            margin-bottom: 30px;
            font-family: Verdana, sans-serif;
            font-size: 15px;
            margin-top: 10px;
            margin-bottom: 40px;
            padding: 0 350px 0 0;
        }
        .overlay {
            position: fixed; bottom: 30px; left: 22px; z-index: 10;
        }

        .ui.container.custom img {
          margin: 15px;
        }
    </style>
@endsection

@section ('content')
    <div class="ui container custom">

      <a class="ui basic label{{ $profession->markedByCurrentUser ? ' marked' : '' }}" id="marker"
          onclick="event.preventDefault(); toggleMark('profession', '{{ $profession->id }}');">
        @if ($profession->markedByCurrentUser)
          Отмечено
        @else
          Отметить
        @endif
      </a><br><br>

      <span>Категория: <a href="{{ route('professions.search', ['direction' => $profession->profDirection->id]) }}">{{ $profession->profDirection->title }}</a></span>
      <br><br>

      <p>{{ $profession->short_description }}</p>
      <p>{!! $profession->full_description !!}</p>

    </div>

    <div style="width: 320px; position: absolute; right: 55px; top: 230px;">
      <div class="ui piled segment" style="min-height: 200px;"> {{-- 'Related' segment --}}
        <h3 class="ui header" style="margin-bottom: 30px;">Связанные специальности</h3>

        <a href="{{ route('profession.specilties.create', $profession) }}"
        style="position: absolute; top: 10px; right: 15px;" title="Добавить специальности">
          <i class="circular plus icon link"></i>
        </a>

        <div class="ui very relaxed divided list"> {{-- List --}}

          @if ($profession->specialities->count())
            @foreach ($profession->specialities as $specialty)
              <div class="item"> {{-- Professions item --}}

                <div class="ui right pointing right floated icon dropdown small basic button content">
                  <i class="ellipsis vertical icon"></i>
                  <div class="menu">
                    <div class="header"><i class="tags icon"></i>  Опции </div>
                    <div class="divider"></div>
                    <a href="#" class="item"
                        onclick="event.preventDefault();
                        document.getElementById('profession-detach-specialty-{{ $specialty->id }}-form').submit();">
                      <i class="circle red delete icon"></i>Открепить
                    </a>
                  </div>
                </div>

                <i class="small teal student middle aligned icon"></i>
                <div class="content">
                  <a href="#" class="header" title="{{ $specialty->title }}">
                    {{ str_limit($specialty->title, 25) }}
                  </a>
                </div>

                <form action="{{ route('profession.specilties.destroy', [$profession, $specialty]) }}"
                    method="post" id="profession-detach-specialty-{{ $specialty->id }}-form">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                </form>

              </div> {{-- End of professions item --}}
            @endforeach
          @else
            <div style="text-align: center;">
              <p>Тут пусто</p>
              <a href="{{ route('profession.specilties.create', $profession) }}" class="ui primary button">Добавить </a>
            </div>
          @endif
        </div> {{-- End of list --}}
      </div> {{-- End of 'related' segment --}}
    </div>

    <div class="overlay">
      <div class="ui left pointing left floated icon dropdown circular big blue button content">
        <i class="ellipsis vertical icon"></i>
        <div class="menu">
          <div class="header"><i class="tags icon"></i>  Опции </div>
          <div class="divider"></div>

          <a href="{{ route('profession.edit', $profession) }}" class="item" target="_blank">
            <i class="blue edit icon"></i> Редактировать
          </a>

          <a href="{{ route('google.profession', $profession) }}" class="item" target="_blank">
            <i class="green google icon"></i> Найти в Google
          </a>

          <a href="{{ route('vipusknik.profession', $profession) }}" class="item" target="_blank">
            <i class="orange checkmark box icon"></i> Выпускник.Kz
          </a>

          <div class="divider"></div>

          {{-- Deleting --}}
          <a href="#" class="item"
            onclick="event.preventDefault();
              document.getElementById('delete-profession-{{ $profession->id }}').submit();">
            <i class="red delete icon"></i>  Удалить
          </a>
          <form action="{{ route('profession.destroy', $profession) }}" method="post"
            id="delete-profession-{{ $profession->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
          </form>
          {{-- Deleting end --}}
        </div>
      </div>
    </div>
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
