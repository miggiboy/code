<table class="ui celled table">
  <thead>
    <th style="width: 400px;">Специальность</th>
      <th style="width: 120px;">Цена за год</th>
      <th style="width: 240px;">Срок обучения</th>
      <th class="collapsing">Опции</th>
  </tr></thead>
  <tbody>
    @foreach ($college->specialities as $specialty)
    <tr>
      <td>
        <h4 class="ui header">
          <div class="content">
            <a href="{{ route('specialties.show', [$specialty, 'inst' => 1]) }}">
              {{ $specialty->title }}
            </a>
            <div class="sub header"> {{ $specialty->code }}
          </div>
        </div>
      </h4></td>
      <td class="collapsing">
        @if (isset($specialty->pivot->study_price))
          {{ $specialty->pivot->study_price }}
        @endif
      </td>
      <td class="collapsing">
        @if (isset($specialty->pivot->study_period))
          {{ $specialty->pivot->study_period }}
        @endif
      </td>
      <td>
        <a href="#" class="ui basic icon button"
          onclick="event.preventDefault();
          document.getElementById('detach-specialty-{{ $specialty->id }}').submit();">
            <i class="trash outline icon"></i>
        </a>
        <form action="{{ route('college.specialties.destroy', [$college, $studyForm, $specialty]) }}"
         id="detach-specialty-{{ $specialty->id }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
