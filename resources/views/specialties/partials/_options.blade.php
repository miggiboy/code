<div class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>
    <a href="{{ route('specialties.edit', [$institutionType, $specialty]) }}"
       class="item"
       @isset ($edit_target_blank) target="_blank" @endisset>
      <i class="blue edit icon"></i>  Редактировать
    </a>

    @include ('shared/_to-primary-app-option', [
        'model' => $specialty
    ])

    @include ('markers/partials/_markers-option', [
        'model' => $specialty,
        'modelType' => 'specialty',
    ])

    @include ('shared/_google-option', [
        'model' => $specialty
    ])

    <div class="divider"></div>

    @include ('specialties/partials/_change-type-option', [
        'model' => $specialty
    ])

    {{-- Deleting --}}
    <a class="item"
       onclick="confirmDeletion('delete-specialty-{{ $specialty->id }}', '{{ $specialty->title }}');">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('specialties.destroy', [$institutionType, $specialty]) }}"
          method="post"
          id="delete-specialty-{{ $specialty->id }}">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
