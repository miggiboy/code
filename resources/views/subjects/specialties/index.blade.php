@extends ('layouts.app')

@section ('title')
    {{ $subject->title }}
@endsection

@section ('content')
    <div class="ui custom-table-page container" style="margin-top: -15px; width: 800px;">

        <div class="ui header">
          <h2>
            <a href="{{ route('subjects.show', $subject) }}" class="custom-link">
              {{ $subject->title }}
            </a>,
            <br>связанные специальности</h2>
        </div> {{-- End of header --}}

        @if ($count = count($specialties))
          <table class="ui celled table" style="margin-bottom: 25px;">
            <thead>
              <tr>
                <th>Специальности ({{ $count }})</th>
                <th>Второй предмет</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($specialties as $specialty)
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
                    </h4>
                  </td>

                  @php
                      $secondSubject = $specialty->otherSubject($subject);
                  @endphp

                  <td class="collapsing">
                    @if ($secondSubject)
                        <a href="{{ route('subjects.show',  $secondSubject) }}" class="custom-link">
                            {{ $secondSubject->title }}
                        </a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
@endsection
