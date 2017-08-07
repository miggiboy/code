@if ($model->belongsToA('college'))
  <a class="item"
     title="Сделать {{ $model->typeIs('qualification') ? 'специальностью' : 'квалификацией' }}"
     onclick="event.preventDefault();
     document.getElementById('update-specialty-{{ $model->id }}-type-form').submit();">
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
