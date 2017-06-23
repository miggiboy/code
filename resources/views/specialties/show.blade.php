@extends ('layouts.app')

@section ('title')
  {{ $specialty->title }}
@endsection

@section ('subnavigation')
    @include('specialties.partials.navigation', ['view' => 'show', 'pageTitle' => $specialty->title])
@endsection

@section ('content')
  <div class="ui very relaxed grid">
    <div class="ten wide column">

      <div class="ui purple label">ID:  {{ $specialty->id }}</div>

      <a class="ui basic label{{ $specialty->marked_by_current_user ? ' marked' : '' }}" id="marker"
          onclick="event.preventDefault(); toggleMark('specialty', '{{ $specialty->id }}');"
          title="Оставляйте отметки чтобы вернуться к ним позже. Ваши отметки видны только Вам.">
        @if ($specialty->marked_by_current_user)
          Отмечено Вами
        @else
          Отметить для себя
        @endif
      </a>

      <br>
      <br>

      <div class="ui grid">

        @if ($specialty->code)
          <div class="three wide column">
            <h5 class="ui header">Код:</h5><div class="content">{{ $specialty->code }}</div>
          </div>
        @endif

        @if ($specialty->subjects->count() == 2)
          <div class="five wide column">
            <h5 class="ui header">Профильные предметы:</h5>
            <div class="content">
              <p>{{ $specialty->subjects[0]->title }}, {{ $specialty->subjects[1]->title }}</p>
            </div>
          </div>
        @endif

        @if (isset($specialty->direction))
          <div class="seven wide column">
              <h5 class="ui header">Направление:</h5>
              <div class="content">
                <a
                  href="{{ route('specialties.index', [$institutionType, 'direction' => $specialty->direction->id]) }}"
                  title="{{ $specialty->direction->title }}">
                  {{ str_limit($specialty->direction->title, 25) }}
                </a>
              </div>
          </div>
        @endif

      </div>
      <br>
      <div class="ui divider"></div>
      @if ($specialty->description)
        <p>
          {!! $specialty->description !!}
        </p>
        <br>
      @endif
      <br>
    </div> {{-- End of column --}}

    <div class="one wide column"></div> {{-- Just extra space column --}}

    <div class="five wide column" style="position: absolute; right: 35px; top: 190px;"> {{-- Left menu with related categories --}}
      <div class="ui segment"> {{-- 'Related' segment --}}
        <div class="eleven wide column"><h2 class="ui header" style="margin-bottom: 33px;">Связанные</h2></div>

        <div class="ui relaxed list"> {{-- List --}}

          <div class="item"> {{-- Professions item --}}

            <div class="ui right pointing right floated icon dropdown small basic button content">
              <i class="ellipsis vertical icon"></i>
              <div class="menu">
                <div class="header"><i class="tags icon"></i>  Опции </div>
                <div class="divider"></div>
                <a href="{{ route('specialties.professions.create', $specialty) }}" class="item">
                  <i class="circle green add icon"></i>Добавить</a>
              </div>
            </div>

            <i class="small teal travel middle aligned icon"></i>
            <div class="content">
            <a href="{{ route('specialties.professions.index', $specialty) }}"
              class="header">Профессии ({{ $specialty->professions()->count() }})</a>
            </div>
          </div> {{-- End of professions item --}}


          <div class="item"> {{-- Institutions item --}}

            <i class="small teal university middle aligned icon"></i>
            <div class="content">
            <a href="{{ route('specialties.institutions.index', $specialty) }}"
              class="header">
                {{ Translator::get($institutionType, 'i', 'p', true) }} ({{ $specialty->institutions()->count() }})
            </a>
            </div>
          </div> {{-- End of professions item --}}


        </div> {{-- End of list --}}

      </div> {{-- End of 'related' segment --}}
    </div> {{-- End of column --}}
    <br>
</div> {{-- End of grid --}}
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
