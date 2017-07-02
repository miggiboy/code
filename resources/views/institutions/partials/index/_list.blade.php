@if (count($institutions))
    <div class="ui large celled very relaxed selection list">
    @foreach ($institutions as $institution)
          <div class="custom item">
            @include ('institutions/partials/_options', ['edit_target_blank' => true])
            <div class="right floated content">
              <div>
                <div>ID:  {{ $institution->id }}</div>
                <br>
                @foreach ($institution->markersOf(Auth::user()) as $marker)
                  <i class="{{ $marker->color }} circle icon"></i>
                @endforeach
              </div>
            </div>
            @if (count($logos = $institution->getMedia('logo')))
              <img class="ui avatar image" src="{{ $logos[0]->getUrl('thumb') }}">
            @else
              <i class="teal university icon"></i>
            @endif
            <div class="content">
              <a class="header" href="{{ route('institutions.show', [$institutionType, $institution]) }}">
                {{ $institution->title }}
              </a><br>
                @if ($institution->is_paid)
                  <a class="ui yellow label">Платник</a>&nbsp;
                @endif
                {{ $institution->city->title }}
            </div>
          </div>
    @endforeach
    </div>
@endif
<br>
