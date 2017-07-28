<div class="ui right pointing right floated icon dropdown basic borderless button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">

    {{-- Editing --}}
    <div class="header"><i class="tags icon"></i>  Опции </div>
    <div class="divider"></div>
    <a href="{{ route('institutions.edit', [$institutionType, $institution]) }}"
       class="item"
       @isset ($edit_target_blank) target="_blank" @endisset>
      <i class="blue edit icon"></i>  Редактировать
    </a>

    @include ('shared/_to-primary-app-option', [
        'model' => $institution
    ])

    @include ('markers/partials/_markers-option', [
        'model' => $institution,
        'modelType' => 'institution',
    ])

    @include ('shared/_google-option', [
        'model' => $institution
    ])

    @isset ($show_google_map_option)
      <a href="{{ $institution->googleMapsUrl() }}"
         class="item"
         target="_blank">
        <i class="blue location arrow icon"></i> Google карты
      </a>
    @endisset

    <div class="divider"></div>

    <a href="#" class="item"
       onclick="event.preventDefault();
       document.getElementById('update-paid-status-of-{{ $institution->id }}-form').submit();">
      <i class="yellow star icon"></i>  Сделать {{ $institution->is_paid ? 'не' : '' }}платником
    </a>

    <form action="{{ route('institutions.paid-status.update', $institution) }}"
          method="post"
          id="update-paid-status-of-{{ $institution->id }}-form">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
    </form>


    {{-- Deleting --}}
    <a href="#" class="item"
       onclick="event.preventDefault();
       document.getElementById('delete-institution-{{ $institution->id }}').submit();">
      <i class="red delete icon"></i>  Удалить
    </a>
    <form action="{{ route('institutions.destroy', [$institutionType, $institution]) }}" method="post"
      id="delete-institution-{{ $institution->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    {{-- Deleting end --}}
  </div>
</div>
