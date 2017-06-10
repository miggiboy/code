@if (count($specialties))
    <div class="ui large celled very relaxed selection list">
    @foreach ($specialties as $specialty)
          <div class="university item{{ $specialty->markedByCurrentUser ? ' marked' : '' }}" style="cursor: default;"
              itemType="specialty" itemId="{{ $specialty->id }}">
            @include ('specialties/partials/_options')
            <div class="right floated content">
              <div>ID:  {{ $specialty->id }}</div>
            </div>
            <i class="teal student icon"></i>
            <div class="content">
              <a class="header" href="{{ route('specialties.show', [$specialty, 'inst' => request('inst')]) }}">
                {{ $specialty->getNameWithCodeOrName() }}
              </a><br>
              {{ str_limit($specialty->direction->title, 25) }}
            </div>
          </div>
    @endforeach
    </div>
@endif
