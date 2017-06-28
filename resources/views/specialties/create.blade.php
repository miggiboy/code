@extends ('layouts.app')

@section ('title', 'Добавление специальности')

@section ('subnavigation')
    @include ('specialties/partials/_navigation', ['heading' => 'Добавление специальности'])
@endsection

@section ('content')
    @include ('includes/_ckeditor')

    <form action="{{ route('specialties.store', $institutionType) }}" method="post" class="ui form">
      {{ csrf_field() }}

      @include ('includes/_form-errors')

      <input type="hidden" name="type" value="specialty"> {{-- TODO: needs to be uniq --}}

      <div class="two fields">

        <div class="ten wide required field{{ $errors->has('title') ? ' error' : '' }}">
          <label for="title">Название</label>
          <input type="text"
                 name="title"
                 value="{{ old('title') }}"
                 id="title"
                 placeholder="Название"
                 required
                 autofocus>
        </div>

        <div class="six wide field">
            <label for="code">Код</label>
            <input type="text"
                   name="code"
                   value="{{ old('code') }}"
                   id="code"
                   placeholder="Код специальности">
        </div>

      </div>

      <div class="fields">

        <div class="five wide field{{ $errors->has('subjects.0') ? ' error' : '' }}">
            <label for="title">Предмет 1</label>
            <select name="subjects[0]" class="ui search dropdown" id="subject_1">
              <option value="">Предмет 1</option>
              <option value=" ">Не выбран</option>
              @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"
                        {{ (old('subjects.0') == $subject->id) ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach
            </select>
        </div>

        <div class="five wide field{{ $errors->has('subjects.1') ? ' error' : '' }}">
            <label for="title">Предмет 2</label>
            <select name="subjects[1]" class="ui search dropdown" id="subject_2">
              <option value="">Предмет 2</option>
              <option value=" ">Не выбран</option>
              @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"
                        {{ (old('subjects.1') == $subject->id) ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach
            </select>
        </div>

        <div class="six wide required field{{ $errors->has('direction_id') ? ' error' : '' }}">
            <label for="title">Направление</label>
            <select name="direction_id" class="ui search dropdown" id="direction_id">
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
        <textarea name="short_description" id="short_description">{{ old('short_description') }}</textarea>
      </div>

      <div class="field">
        <label for="description">Описание</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>
     </div>
      <br>
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
@endsection
