@extends ('layouts.app')

@section ('title')
  {{ $specialty->title }} - связанное
@endsection

@section ('head')
  <style>
    .custom.container {
      width:1000px;
      margin: 0 auto;
      margin-top: 40px;
    }

    a {
    color: #444;
    text-decoration: none;
   }

    a:hover {
    text-decoration: underline;
   }
  </style>
@endsection

@section ('content')
  <div class="ui custom container">
    <h2 class="ui header" style="text-align:center; margin-bottom: 40px;">

      <a href="{{ route('specialties.show', [$specialty->getBelongsTo(), $specialty]) }}">
        {{ str_limit($specialty->title, 50) }}
      </a><br>
      Связанные {{ Translator::get($specialty->getBelongsTo(), 'i', 'p') }}
    </h2>

    @if ($specialty->institutions)
      <table class="ui celled striped table">
        <thead>
          <th style="width: 400px;">Учебное заведение</th>
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
                      <a href="{{ route('institutions.show', [$institution->type, $institution]) }}">
                        {{ $institution->title }}
                      </a>
                      <div class="sub header"> {{ $institution->city->title }}
                    </div>
                  </div>
                </h4>
              </td>
              <td>
                {{ Translator::get($institution->pivot->form, 'i', 's') }}
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
