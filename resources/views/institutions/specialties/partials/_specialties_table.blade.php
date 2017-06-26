<table class="ui celled table">
  <thead>
    <th style="width: 400px;">Специальности ({{ $institution->specialties->count() }})</th>
      <th style="width: 120px;">Цена за год</th>
      <th style="width: 240px;">Срок обучения</th>
      <th class="collapsing">Опции</th>
  </tr></thead>
  <tbody>
    @foreach ($institution->specialties as $specialty)
    <tr>
      <td>
        <h4 class="ui header">
          <div class="content">
            <a href="{{ route('specialties.show', [$specialty->institution_type, $specialty]) }}" class="custom-link">
              {{ $specialty->title }}
            </a>
            <div class="sub header"> {{ $specialty->code }}
          </div>
        </div>
      </h4></td>
      <td class="collapsing">
        @isset($specialty->pivot->study_price)
          {{ $specialty->pivot->study_price }}
        @endisset
      </td>
      <td class="collapsing">
        @isset($specialty->pivot->study_period)
          {{ $specialty->pivot->study_period }}
        @endisset
      </td>
      <td>
        <a href="#" class="ui basic icon button"
           onclick="event.preventDefault();
           document.getElementById('detach-specialty-{{ $specialty->id }}').submit();">
            <i class="trash outline icon"></i>
        </a>
        <form action="{{ route('institutions.specialties.destroy', [$institution, Request::route('studyForm'), $specialty]) }}"
         id="detach-specialty-{{ $specialty->id }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
