@if (count($institutions))
    <div class="ui large celled very relaxed selection list">
    @foreach ($institutions as $institution)
          <div class="university item{{ $institution->markedByCurrentUser ? ' marked' : '' }}"
               style="cursor: default;"
               itemType="University"
               itemId="{{ $institution->id }}">

            @include ('institutions/partials/_options')
            <div class="right floated content">
              <div>ID:  {{ $institution->id }}</div>
            </div>
            @if (count($logos = $institution->getMedia('logo')))
              <img class="ui avatar image" src="{{ $logos[0]->getUrl('thumb') }}">
            @else
              <i class="teal university icon"></i>
            @endif
            <div class="content">
              <a class="header" href="{{ route('institutions.show', [request()->route('institutionType'), $institution]) }}">
                {{ $institution->title }}
              </a><br>
                @if ($institution->is_paid)
                  <a class="ui yellow label" title="Вуз оплатил рекламу на сайте">Платник</a>&nbsp;
                @endif
                {{ $institution->city->title }}
            </div>
          </div>
    @endforeach
    </div>
@endif
<br>
