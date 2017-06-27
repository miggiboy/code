@extends ('layouts.app')

@section ('title')
  {{ $specialty->title }} - связанные профессии
@endsection

@section ('content')
  <div class="ui custom-table-page container" style="margin-top: -15px;">

    <div class="ui header">
      <h2>
        <a href="{{ route('specialties.show', [$specialty->institution_type, $specialty]) }}" class="custom-link">
          {{ $specialty->title }}
        </a>,
        <br>cвязанные профессии</h2>
        <a href="{{ route('specialties.professions.create', $specialty) }}"
           class="ui teal button">
          Добавить профессии
        </a>
    </div> {{-- End of header --}}

    @if ($count = count($specialty->professions))
      <table class="ui celled table" style="margin-bottom: 25px;">
        <thead>
          <tr>
            <th>Профессии ({{ $count }})</th>
            <th>Опции</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($specialty->professions as $profession)
            <tr>
              <td>
                <h4 class="ui header">
                  <div class="content">
                      <a href="{{ route('professions.show', $profession) }}" class="custom-link">
                        {{ $profession->title }}
                      </a>
                      <div class="sub header"> {{ $profession->category->title }}
                    </div>
                  </div>
                </h4>
              </td>
              <td class="collapsing">
                <a href="#"
                    class="ui basic icon button"
                    onclick="event.preventDefault();
                    document.getElementById('specialty-detach-profession-{{ $profession->id }}-form').submit();">
                    <i class="trash outline icon"></i>
                </a>
              </td>

              <form action="{{ route('specialties.professions.destroy', [$specialty, $profession]) }}"
                    method="post"
                    id="specialty-detach-profession-{{ $profession->id }}-form">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
@endsection
