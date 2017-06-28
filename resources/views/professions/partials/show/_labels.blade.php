<div class="ui purple label">ID:  {{ $profession->id }}</div>

<a class="ui basic label{{ $profession->marked_by_current_user ? ' marked' : '' }}"
   id="marker"
   onclick="event.preventDefault(); toggleMark('profession', '{{ $profession->id }}');"
   title="Оставляйте отметки чтобы вернуться к ним позже. Ваши отметки видны только Вам.">

@if ($profession->marked_by_current_user)
  Отмечено Вами
@else
  Отметить для себя
@endif
</a><br><br>
