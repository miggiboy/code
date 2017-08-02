<div class="ui grid">
  @if ($qualification->code)
    <div class="three wide column">
      <h5 class="ui header">Код:</h5>
      <div class="content">{{ $qualification->code }}</div>
    </div>
  @endif

    <div class="seven wide column">
        <h5 class="ui header">Специальность:</h5>
        <div class="content">
          @if($qualification->specialty)
            <a
              href="{{ route('specialties.show', [$qualification->specialty->institution_type, $qualification->specialty]) }}"
              title="{{ $qualification->specialty->title }}">
              {{ str_limit($qualification->specialty->title, 25) }}
            </a>
          @else
            <a href="{{ route('qualifications.edit', $qualification) }}">Указать</a>
          @endif
        </div>
    </div>


</div>
<br>
<div class="ui grid">
  <div class="fourteen wide column">
    <div class="ui divider"></div>
      @if ($qualification->description)
        <p>
          {!! $qualification->description !!}
        </p>
        <br>
      @endif
  </div>
</div>
<br>
