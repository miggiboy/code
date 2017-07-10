@extends ('layouts.app')

@section ('title', 'Добавление квалификации')

@section ('subnavigation')
    @include ('qualifications/partials/_navigation', ['heading' => 'Добавление квалификации'])
@endsection

@section ('content')
    @include ('includes/_ckeditor')

    <form action="{{ route('qualifications.store') }}" method="post" class="ui form">
      {{ csrf_field() }}

      @include ('includes/_form-errors')

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

        <div class="six wide required field">
            <label for="code">Код</label>
            <input type="text"
                   name="code"
                   value="{{ old('code') }}"
                   id="code"
                   placeholder="Код квалификации"
                   required>
        </div>

      </div>

      <div class="required field">
        <label for="title">Специальность</label>
        <select name="specialty_id" class="ui search dropdown" id="specialty_id">
          <option value="">Связанная специальность</option>
          @foreach ($specialties as $specialty)
            <option value="{{ $specialty->id }}"
                    {{ (old('specialty_id') == $specialty->id) ? 'selected' : '' }}>
              {{ $specialty->getNameWithCodeOrName() }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="field">
        <label for="short_description">Краткое описание</label>
        <textarea name="short_description" id="short_description" rows="7">{{ old('short_description') }}</textarea>
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

  @include ('includes/_multiple-selection-dropdown-script')
@endsection
