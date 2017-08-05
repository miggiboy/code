<div
  class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>

    <a href="{{ route('professions.edit', $profession) }}"
       class="item"
       @isset ($edit_target_blank) target="_blank" @endisset>
      <i class="blue edit icon"></i> Редактировать
    </a>

    @include ('shared/_to-primary-app-option', [
        'model' => $profession
    ])

    @include ('markers/partials/_markers-option', [
        'model' => $profession,
        'modelType' => 'profession'
    ])

    @include ('shared/_google-option', [
        'model' => $profession
    ])

    <div class="divider"></div>

    {{-- Deleting --}}
    <a class="item"
      onclick="
      confirmDeletion('delete-profession-{{ $profession->id }}', '{{ $profession->title }}');">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('professions.destroy', $profession) }}" method="post"
      id="delete-profession-{{ $profession->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
