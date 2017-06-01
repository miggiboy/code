@extends ('layouts.master')

@section ('title', 'Тесты')

@section ('subnavigation')
    @include('quizzes.partials.navigation', ['pageTitle' => 'Тесты'])
@endsection

@section ('content')
  <br>
    @if (count($quizzes))
        <table class="ui celled single line table">
          <thead>
            <tr>
              <th>Тест</th>
              <th>Предмет</th>
              <th>Вопросов</th>
              <th>Добавлен</th>
              <th class="collapsing">Опции</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($quizzes as $quiz)
                <tr>
                  <td>
                      <a href="{{ route('quizzes.show', $quiz) }}" title="{{ $quiz->comment }}">
                          {{ $quiz->title }}
                      </a>
                  </td>
                  <td>{{ $quiz->subject->title }}</td>
                  <td>{{ $quiz->questions_count }}</td>
                  <td>{{ $quiz->created_at->format('d.m.y') }}</td>
                  <td>
                    <a href="#" class="ui basic icon button"
                      onclick="event.preventDefault();
                      document.getElementById('delete-quiz-{{ $quiz->id }}').submit();">
                        <i class="trash outline icon"></i>
                    </a>
                    <form action="{{ route('quizzes.destroy', $quiz) }}"
                     id="delete-quiz-{{ $quiz->id }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    @else
        <div class="segment">
            <p>Тесты пока не добавлены.</p>
        </div>
    @endif
@endsection
