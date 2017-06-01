@extends ('layouts.master')

@section ('title')
  {{ $specialty->title }} - связанные профессии
@endsection

@section ('styles')
  <style>
    .custom.container {
      width:700px;
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
  <div class="ui custom container" style="margin-top: -15px;">

    <div class="ui header" style="text-align:center; margin-bottom: 30px;">
      <h2><a href="{{ route('specialties.show', $specialty) }}">{{ $specialty->title }}</a>, <br>cвязанные профессии</h2>
      @if (! $specialty->professions()->count())
        <a href="{{ route('specialty.professions.create', $specialty) }}"
           class="ui teal button"
           style="margin-top: 15px;">
          Добавить профессии
        </a>
      @endif
    </div> {{-- End of header --}}

    @if ($specialty->professions()->count())
      <table class="ui celled table" style="margin-bottom: 25px;">
        <thead>
          <tr>
            <th>Профессия</th>
            <th>Опции</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($specialty->professions as $profession)
            <tr>
              <td>
                <h4 class="ui header">
                  <div class="content">
                      <a href="#">
                        {{ $profession->title }}
                      </a>
                      <div class="sub header"> {{ $profession->profDirection->title }}
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

              <form action="{{ route('specialty.professions.destroy', [$specialty, $profession]) }}"
                    method="post" id="specialty-detach-profession-{{ $profession->id }}-form">
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
