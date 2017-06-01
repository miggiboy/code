<div class="row">
    <div class="page-header">
        <div class="col-lg-9">
          <h1>{{ $quiz->title }}</h1>
        </div>
    </div>
</div>

<hr>
@for ($i = 0; $i < count($questions); $i++)
  @include ('quizzes.partials.question-block')
@endfor
{{ $questions->links() }}
