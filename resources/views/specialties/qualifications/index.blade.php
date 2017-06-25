@extends ('layouts.app')

@section ('title')
  {{ $specialty->title }} - связанные квалификации
@endsection

@section ('head')
  <style>
    .custom.container {
      width:700px;
      margin: 0 auto;
      margin-top: 20px;
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
      <h2><a href="{{ route('specialties.show', $specialty) }}">{{ $specialty->title }}</a>, <br>cвязанные калификации</h2>
      @if (! $specialty->qualifications()->count())
        <a href="{{ route('specialties.qualifications.create', $specialty) }}"
           class="ui teal button"
           style="margin-top: 15px;">
          Добавить калификации
        </a>
      @endif
    </div> {{-- End of header --}}

    @if ($specialty->qualifications()->count())
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
                      <a href="#">
                        {{ $qualification->title }}
                      </a>
                    </div>
                  </div>
                </h4>
              </td>
              <td class="collapsing">
                <a href="#"
                    class="ui basic icon button"
                    onclick="event.preventDefault();
                    document.getElementById('specialty-detach-qualification-{{ $qualification->id }}-form').submit();">
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
@endsection
