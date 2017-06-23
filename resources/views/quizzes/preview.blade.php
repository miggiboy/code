@extends ('layouts.app')

@section ('title', 'Превью теста')


@section ('subnavigation')
    @include('quizzes.partials.navigation', ['pageTitle' => session('title') . ' ' . '(превью теста)'])
@endsection

@section('content')
    <div class="ui form" style="margin: 30px;">
        @for ($i = 0; $i < count(session('questions')); $i++)
          <div class="ui green segment">
              <div class="grouped fields">
                <label>{{ ($i+1) . '. ' . session('questions')[$i] }}</label>
                    @for ($j=0; $j < count(session('answers')[$i]); $j++)
                        <div class="field">
                            @if (count(session('answers')[$i]) <= 5)
                                 <div class="ui radio checkbox">
                                    <input type="radio" name="answer{{ $i }}" tabindex="0" class="hidden"
                                    @if (session('answers')[$i][$j]['is_right'] == true)
                                      checked = 'checked'
                                    @endif
                                    >
                                    <label>{{ session('answers')[$i][$j]['text'] }}</label>
                                 </div>
                            @else
                              <div class="ui checkbox">
                                  <input type="checkbox" name="answer{{ $i }}"
                                  @if (session('answers')[$i][$j]['is_right'] == true)
                                    checked = 'checked'
                                  @endif
                                  >
                                  <label>{{ session('answers')[$i][$j]['text'] }}</label>
                              </div>
                            @endif
                        </div>
                    @endfor
              </div>
          </div>
        @endfor
        <a href="{{ route('quizzes.store') }}" class="ui teal big button">
          Сохранить
        </a>
    </div>
@endsection
