@if (count($quizzes))
  <table class="table">
   <thead>
     <tr>
     <th>Название</th>
     <th>Предмет</th>
     <th>Дата</th>
     </tr>
   </thead>
   <tbody>

    @foreach ($quizzes as $quiz)
      <tr>
       <td><a href="{{ route('quizzes.show', ['id' => $quiz->id]) }}">{{ $quiz->title }}</a></td>
       <td>{{ $quiz->subject->title }}</td>
       <td>{{ $quiz->created_at->diffForHumans() }}</td>
      </tr>
    @endforeach

   </tbody>
  </table>
@else 
  <h4>Тесты пока не добавлены</h4>
@endif