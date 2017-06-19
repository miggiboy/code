@extends ('layouts.master')

@section ('title', 'Добавление специальности')

@section ('subnavigation')
    @include ('specialties.partials.navigation', ['pageTitle' => 'Добавление специальн-ти/квалиф-ии'])
@endsection

@section ('content')
    @include ('includes.ckeditor')

    <form action="{{ route('specialties.store', $institutionType) }}" method="post" class="ui form">
      {{ csrf_field() }}

      @include ('includes.form-errors')

      <div class="required field{{ $errors->has('title') ? ' error' : '' }}">
        <label for="title">Название</label>
        <input type="text"
               name="title"
               value="{{ old('title') ?: '' }}"
               id="title"
               placeholder="Название"
               required
               autofocus>
      </div>

      <div class="two fields">

        <div class="nine wide field">
            <label for="code">Код</label>
            <input type="text"
                   name="code"
                   value="{{ old('code') ?: '' }}"
                   id="code"
                   placeholder="Код">
        </div>

        <div class="required field">
            <label for="title">Тип</label>
            <select name="model_type" class="ui dropdown" id="model_type">
              <option value="">Что добавляем?</option>
              <option value="qualification">Квалификация</option>
              <option value="specialty">Специальность</option>
            </select>
        </div>

      </div>

      <div class="required field" id="specialty_search_field" style="display: none;">
        <label for="specialty_search_field">Родительская специальность</label>
        <select class="remote ui search dropdown" name="parent_id">
          <option value="">Cпециальность</option>
          <option value=" ">Не выбрано</option>
          @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}"
                    {{ (old('subject_1_id') == $subject->id) ? 'selected' : '' }}>
              {{ $subject->title }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="fields">

        <div class="five wide dependent field{{ $errors->has('subject_1_id') ? ' error' : '' }}">
            <label for="title">Предмет 1-й</label>
            <select name="subject_1_id" class="ui search dependent dropdown" id="subject_1">
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

        <div class="five wide dependent field{{ $errors->has('subject_2_id') ? ' error' : '' }}">
            <label for="title">Предмет 2-й</label>
            <select name="subject_2_id" class="ui search dependent dropdown" id="subject_2">
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

        <div class="eight wide dependent required field{{ $errors->has('direction_id') ? ' error' : '' }}">
            <label for="title">Направление</label>
            <select name="direction_id" class="ui search dependent dropdown" id="direction_id">
              <option value="">Направление</option>
              @foreach ($directions as $direction)
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

    $('#model_type').change(function () {
        if ($(this).val() == 'qualification') {

            $('.dependent option').removeAttr('selected')

            $('.dependent').hide()
            $('#specialty_search_field').show()
        } else if ($(this).val() == 'specialty') {
            $('.dependent').show()
            $('#specialty_search_field').hide()
        }
    });

    $('.remote.ui.dropdown').dropdown({
      apiSettings: {
        url: '//mustim09.beget.tech/specialties/search/college/specialties?query={query}&inst={{ request('inst') }}'
      },
      error : {
          noResults   : 'Поиск не дал результатов',
          serverError : 'Произошла ошибка при поиске...',
        },
        minCharacters : 2
    });
  </script>
@endsection
