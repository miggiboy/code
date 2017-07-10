@if (count($specialties))
    <div class="ui large celled very relaxed selection list">
        @foreach ($specialties as $specialty)
            <div class="custom item">
                @include ('specialties/partials/_options', [
                    'edit_target_blank' => true
                ])
                <div class="right floated content">
                  <div>ID:  {{ $specialty->id }}</div>
                  @include ('markers/partials/_in-list-markers', [
                      'model' => $specialty
                  ])
                </div>
                <i class="teal student icon"></i>
                <div class="content">
                  <a class="header" href="{{ route('specialties.show', [$institutionType, $specialty]) }}">
                    {{ $specialty->getNameWithCodeOrName() }}
                  </a>
                  <br>
                  {{ str_limit($specialty->direction->title, 35) }}
                </div>
            </div>
        @endforeach
    </div>
@endif
