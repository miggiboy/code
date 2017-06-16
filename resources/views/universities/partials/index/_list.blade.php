@if (count($universities))
    <div class="ui large celled very relaxed selection list">
    @foreach ($universities as $university)
          <div class="university item{{ $university->markedByCurrentUser ? ' marked' : '' }}" style="cursor: default;"
              itemType="University" itemId="{{ $university->id }}">
            @include ('universities/partials/_options')
            <div class="right floated content">
              <div>ID:  {{ $university->id }}</div>
            </div>
            @if (count($logos = $university->getMedia('logo')))
              <img class="ui avatar image" src="{{ $logos[0]->getUrl('thumb') }}">
            @else
              <i class="teal university icon"></i>
            @endif
            <div class="content">
              <a class="header" href="{{ route('institutions.show', [$university, 'type' => request('type')]) }}">
                {{ $university->title }}
              </a><br>
                @if ($university->is_paid) <a class="ui yellow label" title="Вуз оплатил рекламу на сайте">Платник</a>&nbsp; @endif {{ $university->city->title }}
            </div>
          </div>
    @endforeach
    </div>
@endif
<br>
