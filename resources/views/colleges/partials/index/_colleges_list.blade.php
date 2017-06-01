@if (count($colleges))
  <div class="ui large celled very relaxed selection list">
  @foreach ($colleges as $college)
        <div class="university item{{ $college->markedByCurrentUser ? ' marked' : '' }}" style="cursor: default;"
              itemType="college" itemId="{{ $college->id }}">
          @include ('colleges/partials/_options')
          <div class="right floated content">
            <div class="">ID:  {{ $college->id }}</div>
          </div>

          @if (count($logos = $college->getMedia('logo')))
            <img class="ui avatar image" src="{{ $logos[0]->getUrl('thumb') }}">
          @else
            <i class="teal university icon"></i>
          @endif

          <div class="content">
            <a class="header" href="{{ route('colleges.show', $college->slug) }}">
              {{ $college->title }}
            </a><br>
            @if ($college->is_paid) <a class="ui yellow label" title="Колледж оплатил рекламу на сайте">Платник</a>&nbsp; @endif
            {{ $college->city->title }}
          </div>
        </div>
  @endforeach
  </div>
@endif
