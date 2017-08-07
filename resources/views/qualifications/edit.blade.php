@extends ('layouts.app')

@section ('title')
  Редактирование квалификации {{ $qualification->title }}
@endsection

@section ('subnavigation')
    @include ('qualifications/partials/_navigation', ['heading' => 'Редактирование квалификации'])
@endsection

@section ('content')
    @include ('includes/_ckeditor')

    <form action="{{ route('qualifications.update', $qualification) }}" method="post" class="ui form">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      @include ('includes/_form-errors')

      <input type="hidden" name="type" value="qualification">

      <div class="two fields">

        <div class="ten wide required field{{ $errors->has('title') ? ' error' : '' }}">
          <label for="title">Название</label>
          <input type="text"
                 name="title"
                 value="{{ old('title', $qualification->title) }}"
                 id="title"
                 placeholder="Название"
                 required
                 autofocus>
        </div>

        <div class="six wide required field">
            <label for="code">Код</label>
            <input type="text"
                   name="code"
                   value="{{ old('code', $qualification->code) }}"
                   id="code"
                   placeholder="Код квалификации"
                   required>
        </div>

      </div>

      <div class="required field">
        <label for="parent_id">Специальность</label>
        <select name="parent_id" class="ui dropdown search" id="parent_id">
          <option value="">Введите название или код специальности...</option>
          <option value=" ">Не выбрано</option>
          @foreach ($specialties as $specialty)
            <option value="{{ $specialty->id }}"
                    {{ ((old('specialty_id', $qualification->specialty->id ?? null)) == $specialty->id)  ? 'selected' : '' }}>
              {{ $specialty->getNameWithCodeOrName() }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="field">
        <label for="short_description">Краткое описание</label>
        <textarea name="short_description" id="short_description" rows="4">{{ old('short_description', $qualification->short_description) }}</textarea>
      </div>

      <div class="field">
        <label for="description">Описание</label>
        <textarea name="description" id="description">{{ old('description', $qualification->description) }}</textarea>
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
