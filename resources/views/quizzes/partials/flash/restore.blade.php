<P>
<form action="{{ route('quizzes.restore', ['id' => session('quiz')->id]) }}" method="post">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <label for="restore" class="control-label">Тест удален.</label>
        <button type="submit" class="btn btn-link" id="restore">
            Восстановить
        </button>
    </form>
</p>