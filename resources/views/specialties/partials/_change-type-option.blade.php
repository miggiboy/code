@if ($model->belongsToA('college'))
  @php
    $newType = $model->typeIs('qualification') ? 'специальностью' : 'квалификацией';
  @endphp
  <a class="item"
     title="Сделать {{ $newType }}"
     onclick="confirmSpecialtyTypeUpdate('update-specialty-{{ $model->id }}-type-form', '{{ $model->title }}', '{{ $newType }}');">
    <i class="violet exchange icon"></i>
    Сделать {{ $model->typeIs('qualification') ? 'специальностью' : 'квалификацией' }}
  </a>

  <form action="{{ route(str_plural($model->type) . '.types.update', $model) }}"
        method="post"
        id="update-specialty-{{ $model->id }}-type-form">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
  </form>
@endif
