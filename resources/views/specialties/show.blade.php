@extends ('layouts.master')

@section ('title')
  Специальность {{ "{$specialty->title}" }}
@endsection

@section ('subnavigation')
    @include('specialties.partials.navigation', ['view' => 'show', 'pageTitle' => $specialty->title])
@endsection

@section ('content')
  <div class="ui very relaxed grid">
    <div class="ten wide column">

      <a class="ui basic label{{ $specialty->markedByCurrentUser ? ' marked' : '' }}" id="marker"
          onclick="event.preventDefault(); toggleMark('specialty', '{{ $specialty->id }}');">
        @if ($specialty->markedByCurrentUser)
          Отмечено
        @else
          Отметить
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

        @if (isset($specialty->direction->title))
          <div class="seven wide column">
              <h5 class="ui header">Направление:</h5>
              <div class="content">
                <a
                  href="{{ route('specialties.search', ['direction' => $specialty->direction->id, 'inst' => request('inst')]) }}"
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

        <div class="ui very relaxed divided list"> {{-- List --}}

          <div class="item"> {{-- Professions item --}}

            <div class="ui right pointing right floated icon dropdown small basic button content">
              <i class="ellipsis vertical icon"></i>
              <div class="menu">
                <div class="header"><i class="tags icon"></i>  Опции </div>
                <div class="divider"></div>
                <a href="{{ route('specialty.professions.create', $specialty) }}" class="item"><i class="circle green add icon"></i>Добавить</a>
              </div>
            </div>

            <i class="small teal travel middle aligned icon"></i>
            <div class="content">
            <a href="{{ route('specialty.professions.index', $specialty) }}"
              class="header">Профессии ({{ $specialty->professions()->count() }})</a>
            </div>
          </div> {{-- End of professions item --}}
        </div> {{-- End of list --}}


        <div class="ui very relaxed divided list"> {{-- List --}}

          <div class="item"> {{-- Institutions item --}}

            <div class="ui right pointing right floated icon dropdown small basic button content">
              <i class="ellipsis vertical icon"></i>
              <div class="menu">
                <div class="header"><i class="tags icon"></i>  Опции </div>
                <div class="divider"></div>
                <a href="{{ route('specialty.professions.create', $specialty) }}" class="item"><i class="circle green add icon"></i>Добавить</a>
              </div>
            </div>

            <i class="small teal travel middle aligned icon"></i>
            <div class="content">
            <a href="{{ route('specialty.professions.index', $specialty) }}"
              class="header">{{ $institutionType = $specialty->getLocalInsitutionType() }} ({{ $specialty->countRelatedInstitutions() }})</a>
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
