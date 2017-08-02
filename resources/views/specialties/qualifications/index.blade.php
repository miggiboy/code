@extends ('layouts.app')

@section ('title')
  {{ $specialty->title }} - связанные квалификации
@endsection

@section ('content')
  <div class="ui custom-table-page container">
    <div class="ui header">
      <h2>
      <a href="{{ route('specialties.show', [$specialty->institution_type, $specialty]) }}" class="custom-link">
        {{ $specialty->getNameWithCodeOrName() }}
      </a>, <br>
      cвязанные калификации
      </h2>

      @php
        $count = $specialty->qualifications->count();
      @endphp

      <a href="{{ route("specialties.qualifications.create", $specialty) }}"
         class="ui teal button">
        {{ $count ? 'Редактировать список' : 'Добавить квалификации' }}
      </a>

      @if ($count)

        <table class="ui celled table" style="margin-bottom: 25px;">
          <thead>
            <tr>
              <th>Квалификация</th>
              <th>Опции</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($specialty->qualifications as $qualification)
              <tr>
                <td>
                  <h4 class="ui header">
                    <div class="content">
                        <a href="{{ route('qualifications.show', $qualification) }}"
                           class="custom-link">
                          {{ $qualification->getNameWithCodeOrName() }}
                        </a>
                      </div>
                    </div>
                  </h4>
                </td>
                <td class="collapsing">
                  <a href="#"
                      class="ui basic icon button"
                      onclick="event.preventDefault();
                      document.getElementById('specialty-detach-qualification-{{ $qualification->id }}-form').submit();"
                      title="Открепить квалификацию">
                      <i class="trash outline icon"></i>
                  </a>
                </td>

                <form action="{{ route('specialties.qualifications.destroy', [$specialty, $qualification]) }}"
                      method="post" id="specialty-detach-qualification-{{ $qualification->id }}-form">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                </form>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
@endsection
