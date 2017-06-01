@extends ('layouts.master')

@section ('title', 'Просмотр теста')


@section ('subnavigation')
    @include('quizzes.partials.navigation', ['pageTitle' => $quiz->title])
@endsection

@section ('content')
<div class="ui form" style="margin: 30px;">
    @for ($i = 0; $i < count($questions); $i++)
      <div class="ui green segment">
          <div class="grouped fields">
            <label>{{ ($i + ((request('page') ?? 1) * 5 - 4)) . '. ' . $questions[$i]->text }}</label>
                @for ($j=0; $j < count($questions[$i]->answers); $j++)
                    <div class="field">
                        @if (count($questions[$i]->answers) <= 5)
                             <div class="ui radio checkbox" onclick="checkAnswer({{ $questions[$i]->answers[$j]->id }});">
                                <input type="radio" name="answer{{ $i }}" tabindex="0" class="hidden">
                                <label>{{ $questions[$i]->answers[$j]->text }} {{ $questions[$i]->answers[$j]->is_right ? '(right)' : '' }}</label>
                             </div>
                        @else
                          <div class="ui checkbox">
                              <input type="checkbox" name="answer{{ $i }}">
                              <label>{{ $questions[$i]->answers[$j]->text }}</label>
                          </div>
                        @endif
                    </div>
                @endfor
          </div>
      </div>
    @endfor
    {{ $questions->links() }}
</div>
@endsection

@section ('script')
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script>
      function checkAnswer(answerId) {
          axios.post('/answer/' + answerId, {
        })
        .then(function (response) {
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-bottom-center",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "130",
              "hideDuration": "180",
              "timeOut": "900",
              "extendedTimeOut": "150",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            if (response.data.right_answer_id == answerId) {
              toastr["info"]("Правильно!")
            } else {
              toastr["error"]("Не верно!")
            }
        })
        .catch(function (error) {
          console.log(error);
        });
      }
  </script>
@endsection
