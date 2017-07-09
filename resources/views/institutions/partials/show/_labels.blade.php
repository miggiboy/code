@if ($institution->is_paid)
  <div class="ui orange label">
    <i class="star icon"></i> Платник
  </div>
@endif

@include ('markers/partials/_markers-label', [
    'model' => $institution
])
