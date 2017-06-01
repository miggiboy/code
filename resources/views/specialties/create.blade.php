@extends ('layouts.master')

@section ('title', 'Добавление специальности')

@section ('subnavigation')
    @include ('specialties.partials.navigation', ['pageTitle' => 'Добавление специальности'])
@endsection

@section ('content')
    @include ('layouts.ckeditor')

    <form action="{{ route('specialties') }}" method="POST" class="ui form">
      {{ csrf_field() }}

      <input type="hidden" name="inst" value="{{ request('inst') }}">

      @include ('layouts.form-errors')

      <div class="required field{{ $errors->has('title') ? ' error' : '' }}">
        <label for="title">Название специальности</label>
        <input type="text"
               name="title"
               value="{{ old('title') ?: '' }}"
               id="title"
               placeholder="Название"
               required
               autofocus>
      </div>

      <div class="field">
          <label for="code">Код специальности</label>
          <input type="text"
                 name="code"
                 value="{{ old('code') ?: '' }}"
                 id="code"
                 placeholder="Код">
      </div>
      <div class="fields">

        <div class="five wide field{{ $errors->has('subject_1_id') ? ' error' : '' }}">
            <label for="title">Предмет 1-й</label>
            <select name="subject_1_id" class="ui search dropdown">
              <option value="">Предмет 1-й</option>
              <option value=" ">Не выбрано</option>
              @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"
                        {{ (old('subject_1_id') == $subject->id) ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach
            </select>
        </div>

        <div class="five wide field{{ $errors->has('subject_2_id') ? ' error' : '' }}">
            <label for="title">Предмет 2-й</label>
            <select name="subject_2_id" class="ui search dropdown">
              <option value="">Предмет 2-й</option>
              <option value=" ">Не выбрано</option>
              @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"
                        {{ (old('subject_2_id') == $subject->id) ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach
            </select>
        </div>

        <div class="eight wide required field{{ $errors->has('direction_id') ? ' error' : '' }}">
            <label for="title">Направление</label>
            <select name="direction_id" class="ui search dropdown">
              <option value="">Направление</option>
              @foreach (\App\Models\Specialty\Direction::getByInstitution(request('inst')) as $direction)
                <option value="{{ $direction->id }}"
                        {{ (old('direction_id') == $direction->id) ? 'selected' : '' }}>
                  {{ $direction->title }}
                </option>
              @endforeach
            </select>
        </div>

      </div>

      <div class="field">
        <label for="short_description">Краткое описание</label>
        <textarea name="short_description" id="short_description">{{ old('short_description', '') }}</textarea>
      </div>

      <div class="field">
        <label for="description">Описание</label>
        <textarea name="description" id="description">{{ old('description') ?: '' }}</textarea>
     </div>

      <button class="ui big teal button" type="submit">Сохранить</button>
    </form>
    <br>
    <br>
    <br>
@endsection

@section('script')
  <script>
      CKEDITOR.replace('description', {
        height: 350
      });
  </script>
  <script>
    $('.ui.dropdown')
      .dropdown({
        allowAdditions: true
      });
  </script>
@endsection
