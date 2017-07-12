<div class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>
    <a href="{{ route('qualifications.edit', $qualification) }}"
       class="item"
       @isset ($edit_target_blank) target="_blank" @endisset>
      <i class="blue edit icon"></i>  Редактировать
    </a>

    @include ('shared/_to-primary-app-option', [
        'model' => $qualification
    ])

    @include ('markers/partials/_markers-option', [
        'model' => $qualification,
        'modelType' => 'qualification',
    ])

    @include ('shared/_google-option', [
        'model' => $qualification
    ])

    <div class="divider"></div>

    {{-- Deleting --}}
    <a href="#" class="item"
       onclick="event.preventDefault();
       document.getElementById('delete-qualification-{{ $qualification->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('qualifications.destroy', $qualification) }}"
          method="post"
          id="delete-qualification-{{ $qualification->id }}">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>