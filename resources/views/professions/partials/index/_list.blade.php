@if (count($professions))
<div class="ui large celled very relaxed selection list">
@foreach ($professions as $profession)
      <div class="custom item">

        @include ('professions/partials/_options', [
            'edit_target_blank' => true
        ])
        <div class="right floated content">
          <div>ID:  {{ $profession->id }}</div>
          @include ('markers/partials/_in-list-markers', [
              'model' => $profession
          ])
        </div>
        <i class="teal travel icon"></i>
        <div class="content">
          <a class="header" href="{{ route('professions.show', $profession) }}">
            {{ $profession->title }}
          </a><br>
          {{ $profession->category->title }}
        </div>
      </div>
@endforeach
</div>
@endif
<br>
