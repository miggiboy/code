@extends ('layouts.app')

@section ('title')
  Редактирование cпециальности {{ $specialty->title }}
@endsection

@section ('subnavigation')
    @include ('specialties/partials/_navigation', ['heading' => 'Редактирование специальности'])
@endsection

@section ('content')
    @include ('includes/_ckeditor')

    <br><br>
    <form action="{{ route('specialties.update', [$institutionType, $specialty]) }}"
          method="post"
          class="ui form">

      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      @include ('includes/_form-errors')

      <input type="hidden" name="type" value="{{ $specialty->type }}">

      <div class="two fields">
        <div class="ten wide required field{{ $errors->has('title') ? ' error' : '' }}">
          <label for="title">Название специальности</label>
          <input type="text"
                 name="title"
                 value="{{ old('title', $specialty->title) }}"
                 id="title"
                 placeholder="Название">
        </div>

        <div class="six wide field">
          <label for="code">Код</label>
          <input type="text"
                 name="code"
                 value="{{ old('code', $specialty->code) }}"
                 id="code"
                 placeholder="Код специальности">
        </div>
      </div>

      <div class="fields">

        <div class="five wide field{{ $errors->has('subjects.0') ? ' error' : '' }}">
            <label for="title">Предмет 1</label>
            <select name="subjects[0]" class="ui search dropdown">
              <option value="">Предмет 1</option>
              <option value=" ">Не выбран</option>

              @foreach ($subjects as $subject)
                <option
                value="{{ $subject->id }}"
                {{ ((old('subjects.0') ?: (isset($specialty->subjects[0]) ? $specialty->subjects[0]->id : '')) == $subject->id) ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach

            </select>
        </div>

        <div class="five wide field{{ $errors->has('subjects.1') ? ' error' : '' }}">
            <label for="title">Предмет 2</label>
            <select name="subjects[1]" class="ui search dropdown">
              <option value="">Предмет 2</option>
              <option value=" ">Не выбран</option>

              @foreach ($subjects as $subject)
                <option
                value="{{ $subject->id }}"
                {{ ((old('subjects.1') ?: (isset($specialty->subjects[1]) ? $specialty->subjects[1]->id : '')) == $subject->id) ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach
            </select>
        </div>

        <div class="six wide required field{{ $errors->has('direction_id') ? ' error' : '' }}">
            <label for="title">Направление</label>
            <select name="direction_id" class="ui search dropdown">
              <option value="">Направление</option>
              @foreach ($directions as $direction)
                <option value="{{ $direction->id }}"
                        {{ ((old('direction_id', $specialty->direction->id)) == $direction->id)  ? 'selected' : '' }}>
                  {{ $direction->title }}
                </option>
              @endforeach
            </select>
        </div>
      </div>

      <div class="field">
        <label for="short_description">Краткое описание</label>
        <textarea name="short_description" id="short_description">{{ old('short_description', $specialty->short_description) }}</textarea>
      </div>

      <div class="field">
        <label for="description">Описание</label>
        <textarea id="description" name="description">{!! old('description', $specialty->description) !!}</textarea>
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
@endsection
