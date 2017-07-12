@extends ('layouts.app')

@section ('title')
  {{ $specialty->title }} - связанное
@endsection

@section ('content')
  <div class="ui custom-table-page container">
    <h2 class="ui header">
      <a href="{{ route('specialties.show', [$specialty->institution_type, $specialty]) }}"
         class="custom-link">
        {{ str_limit($specialty->title, 50) }}
      </a><br>
      cвязанные {{ translate($specialty->institution_type, 'i', 'p') }}
    </h2>

    @if ($specialty->institutions)
      <table class="ui celled table">
        <thead>
          <th style="width: 400px;">Учебные заведения ({{ count($specialty->institutions_distinct) }})</th>
          <th style="width: 120px;">Форма обучения</th>
            <th style="width: 120px;">Цена за год</th>
            <th style="width: 120px;">Срок обучения</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($specialty->institutions as $institution)
            <tr>
              <td class="collapsing">
                <h4 class="ui header">
                  <div class="content">
                      <a href="{{ route('institutions.show', [str_plural($institution->type), $institution]) }}"
                         class="custom-link">
                        {{ $institution->title }}
                      </a>
                      <div class="sub header"> {{ $institution->city->title }}
                    </div>
                  </div>
                </h4>
              </td>
              <td>
                {{ translate($institution->pivot->form) }}
              </td>
              <td>{{ $institution->pivot->study_price }}</td>
              <td class="right aligned collapsing">{{ $institution->pivot->study_period }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
  <br>
  <br>
  <br>
@endsection
