@extends ('layouts.app')
@section ('title', 'Добавление теста')

@section ('subnavigation')
    @include ('quizzes.partials.navigation', ['pageTitle' => 'Добавление теста'])
@endsection

@section ('head')
<style>
    textarea {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 16pt;
        padding: 5px;
    }
</style>
@endsection

@section ('content')
<br><br>
<form action="{{ route('quizzes.preview') }}" method="post" class="ui form">
    {{ csrf_field() }}

    <div class="fields">

        <div class="eight wide required field{{ $errors->has('title') ? ' error' : '' }}">
            <label for="title">Название</label>
            <input type="text"
                   name="title"
                   value="{{ old('title') ?: '' }}"
                   id="title"
                   placeholder="Название"
                   required
                   autofocus>

            @if($errors->has('title'))
                <div class="ui error message">
                    <p>{{ $errors->first('title') }}</p>
                </div>
            @endif
        </div>

        <div class="three wide required field">
            <label for="subject_id">Предмет</label>
            <select name="subject_id" id="subject_id" class="ui search dropdown">
              <option value="">Предмет</option>
              @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"
                    @if (session('subject_id') && session('subject_id') == $subject->id)
                        selected = 'selected'
                    @endif
                >
                    {{ $subject->title }}
                </option>
              @endforeach
            </select>
        </div>

        <div class="five wide field">
            <label for="comment">Коментарий</label>
            <input type="text" name="comment" value="{{ old('comment') ?: '' }}" id="comment" placeholder="Коментарий к тесту">
        </div>
    </div>

    <div class="required field">
        <label for="text">Текст теста</label>
        <textarea rows="25" id="text" name="text">{{ old('text') ?: '' }}</textarea>
    </div>
    <br>
    <button class="ui big yellow button" type="submit">Превью</button>
</form>
<br><br>
@endsection
