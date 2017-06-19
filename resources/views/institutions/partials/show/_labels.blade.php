<div class="ui purple label">ID:  {{ $institution->id }}</div>

@if ($institution->is_paid)
  <div class="ui orange label">
    <i class="star icon"></i> Платник
  </div>
@endif

<a class="ui basic label{{ $institution->marked_by_current_user ? ' marked' : '' }}"
   id="marker"
   onclick="event.preventDefault(); toggleMark('{{ $institution->id }}');"
   title="Оставляйте отметки чтобы вернуться к ним позже. Ваши отметки видны только Вам.">
  @if ($institution->marked_by_current_user)
    Отмечено Вами
  @else
    Отметить для себя
  @endif
</a>

{{-- @if ($institution->pin)
  <a href="#" class="ui olive label" onmouseover="showPin()" onmouseout="hidePin()" id="pin-label">
    Показать пин
  </a>
@endif
 --}}
