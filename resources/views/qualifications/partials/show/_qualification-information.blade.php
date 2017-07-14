<div class="ui grid">
  @if ($qualification->code)
    <div class="three wide column">
      <h5 class="ui header">Код:</h5>
      <div class="content">{{ $qualification->code }}</div>
    </div>
  @endif

  @isset($qualification->specialty)
    <div class="seven wide column">
        <h5 class="ui header">Специальность:</h5>
        <div class="content">
          <a
            href="{{ route('specialties.show', [$qualification->specialty->institution_type, $qualification->specialty]) }}"
            title="{{ $qualification->specialty->title }}">
            {{ str_limit($qualification->specialty->title, 25) }}
          </a>
        </div>
    </div>
  @endisset

</div>
<br>
<div class="ui divider"></div>
@if ($qualification->description)
  <p>
    {!! $qualification->description !!}
  </p>
  <br>
@endif
<br>
