@if (count($qualifications))
    <div class="ui large celled very relaxed selection list">
        @foreach ($qualifications as $qualification)
            <div class="custom item">
                @include ('qualifications/partials/_options', [
                    'edit_target_blank' => true
                ])
                <div class="right floated content">
                  <div>ID:  {{ $qualification->id }}</div>
                  @include ('markers/partials/_in-list-markers', [
                      'model' => $qualification
                  ])
                </div>
                <i class="teal student icon"></i>
                <div class="content">
                  <a class="header" href="{{ route('qualifications.show', $qualification) }}">
                    {{ $qualification->getNameWithCodeOrName() }}
                  </a>
                  <br>
                  @isset ($qualification->specialty)
                    {{ $qualification->specialty->title }}
                  @endisset
                </div>
            </div>
        @endforeach
    </div>
@endif
