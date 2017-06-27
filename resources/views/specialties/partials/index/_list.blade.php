@if (count($specialties))
    <div class="ui large celled very relaxed selection list">
        @foreach ($specialties as $specialty)
            <div class="custom item{{ $specialty->marked_by_current_user ? ' marked' : '' }}" itemId="{{ $specialty->id }}">
                @include ('specialties/partials/_options', ['edit_target_blank' => true])
                <div class="right floated content">
                  <div>ID:  {{ $specialty->id }}</div>
                </div>
                <i class="teal student icon"></i>
                <div class="content">
                  <a class="header" href="{{ route('specialties.show', [$institutionType, $specialty]) }}">
                    {{ $specialty->getNameWithCodeOrName() }}
                  </a><br>
                  {{ str_limit($specialty->direction->title, 35) }}
                </div>
            </div>
        @endforeach
    </div>
@endif
