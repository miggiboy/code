<div class="ui grid">
  @if ($specialty->code)
    <div class="three wide column">
      <h5 class="ui header">Код:</h5><div class="content">{{ $specialty->code }}</div>
    </div>
  @endif

  @if (count($specialty->subjects))
    <div class="five wide column">
      <h5 class="ui header">Профильные предметы:</h5>
      <div class="content">
          <p>
            @foreach ($specialty->subjects as $subject)
              <a href="{{ route('subjects.show', $subject) }}">{{ $subject->title }}</a><br>
            @endforeach
          </p>
      </div>
    </div>
  @endif

  @isset($specialty->direction)
    <div class="seven wide column">
        <h5 class="ui header">Направление:</h5>
        <div class="content">
          <a
            href="{{ route('specialties.index', [$institutionType, 'direction' => $specialty->direction->id]) }}"
            title="{{ $specialty->direction->title }}">
            {{ str_limit($specialty->direction->title, 25) }}
          </a>
        </div>
    </div>
  @endisset

</div>
<br>
<div class="ui grid">
  <div class="fourteen wide column">
  <div class="ui divider"></div>
    @if ($specialty->description)
      <p>
        {!! $specialty->description !!}
      </p>
      <br>
    @endif
  </div>
</div>
<br>
