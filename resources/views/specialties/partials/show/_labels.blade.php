<div class="ui purple label">ID:  {{ $specialty->id }}</div>

<a class="ui basic label{{ $specialty->marked_by_current_user ? ' marked' : '' }}" id="marker"
    onclick="event.preventDefault(); toggleMark('specialty', '{{ $specialty->id }}');"
    title="Оставляйте отметки чтобы вернуться к ним позже. Ваши отметки видны только Вам.">
  @if ($specialty->marked_by_current_user)
    Отмечено Вами
  @else
    Отметить для себя
  @endif
</a>
<br>
<br>
