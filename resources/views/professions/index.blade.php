@extends ('layouts.master')

@section ('title', 'Профессии - Edukey')

@section ('subnavigation')
    @include ('professions.partials.navigation', ['pageTitle' => 'Профессии'])
@endsection

@section ('content')
<br><br>
<div class="ui grid">

  <div class="thirteen wide column">
    <div class="ui very padded segment">
      <form class="ui small form" action="{{ route('professions.search') }}" method="get">

          <div class="three fields">

            <div class="eight wide field">
              <div class="ui fluid professions search">
                <div class="ui right icon input">
                  <input type="text" name = "query" value="{{ old('query') }}" class="prompt" placeholder="Начните вводить название профессии ..." autofocus>
                  <i class="search icon"></i>
                </div>
              </div>
            </div>

            <div class="four wide field">
                <select class="ui selection search dropdown" name="direction">
                  <option value="">Проф-направление</option>
                  <option value=" ">Не выбрано</option>
                   @foreach ($profDirections as $profDirection)
                     <option value="{{ $profDirection->id }}"
                             {{ (old('direction') == $profDirection->id) ? 'selected' : '' }}>
                       {{ $profDirection->title }}
                     </option>
                   @endforeach
                </select>
              </div>

              <div class="four wide field">
                <input type="submit" value="Поиск" class="ui small basic button">
              </div>
          </div>

          <div class="three wide field" style="margin-top: 7px; margin-top: 7px;">
            <div class="ui checkbox">
              <input type="checkbox"
                     name="marked"
                     value="1"
                     tabindex="0"
                     class="hidden"
                     {{ (request('marked') == "1") ? 'checked' : '' }}>
              <label>Отмеченные</label>
            </div>
          </div>

          <p>Результатов: {{ $professions->total() }}</p>
      </form>

      <br>
      @if (count($professions))
          <div class="ui large celled very relaxed selection list">
          @foreach ($professions as $profession)
                <div class="university item{{ $profession->markedByCurrentUser ? ' marked' : '' }}" style="cursor: default;"
              itemType="profession" itemId="{{ $profession->id }}">

                  @include ('professions/partials/_options')
                  <i class="teal travel icon"></i>
                  <div class="content">
                    <a class="header" href="{{ route('profession.show', $profession) }}">
                      {{ $profession->title }}
                    </a><br>
                    {{ $profession->profDirection->title }}
                  </div>
                </div>
          @endforeach
          </div>
      @endif
      <br>
      </div>
  </div>

  <div class="three wide column">
      <div class="ui vertical teal menu">
        <div class="item">
          <div class="header">Проф-направелния</div>
          <div class="menu">
            @foreach ($profDirections as $profDirection)
              <a href="{{ route('professions.search', ['direction' => $profDirection->id]) }}"
                 class="item">
                {{ $profDirection->title }}
              </a>
            @endforeach
          </div>
        </div>
      </div>
  </div>
</div>
<br>

{{ $professions->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>

@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
