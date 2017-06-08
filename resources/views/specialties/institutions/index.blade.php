@extends ('layouts.master')

@section ('title')
  {{ $specialty->title }} - связанное
@endsection

@section ('styles')
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

      <a href="{{ route('specialties.show', [$specialty, 'inst' => request('inst')]) }}">
        {{ str_limit($specialty->title, 50) }}
      </a><br>
      Связанные {{ $specialty->getTranslatedInsitutionType() }}
    </h2>

    @if ($specialty->getInstitutions()->count())
      <table class="ui celled striped table">
        <thead>
          <th style="width: 400px;">Уч. заведение</th>
            <th style="width: 120px;">Цена за год</th>
            <th style="width: 240px;">Срок обучения</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($specialty->getInstitutions() as $institution)
            <tr>
              <td class="collapsing">
                <a href="{{ route(strtolower(str_plural((class_basename($institution)))) . '.show', $institution->slug) }}">
                  {{ $institution->title }}
                </a>
              </td>
              <td>{{ $institution->pivot->price }}</td>
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
