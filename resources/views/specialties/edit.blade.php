@extends ('layouts.master')

@section ('title')
  {!! "Редактирование cпециальности - {$specialty->title}" !!}
@endsection

@section ('subnavigation')
    @include ('specialties.partials.navigation', ['pageTitle' => 'Редактирование специальности'])
@endsection

@section ('content')
    @include ('layouts.ckeditor')

    <br><br>
    <form action="{{ route('specialties.update', $specialty) }}"
          method="POST"
          class="ui form">

      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      @include ('layouts.form-errors')

      <input type="hidden" name="inst" value="{{ request('inst') }}">

      <div class="required field{{ $errors->has('title') ? ' error' : '' }}">
        <label for="title">Название специальности</label>
        <input type="text"
               name="title"
               value="{{ old('title', $specialty->title) }}"
               id="title"
               placeholder="Название">
      </div>

      <div class="field">
        <label for="code">Код специальности</label>
        <input type="text"
               name="code"
               value="{{ old('code', $specialty->code) }}"
               id="code"
               placeholder="Код">
      </div>
      <div class="fields">

        <div class="four wide field{{ $errors->has('subject_1_id') ? ' error' : '' }}">
            <label for="title">Предмет 1-й</label>
            <select name="subject_1_id" class="ui search dropdown">
              <option value="">Предмет 1-й</option>
              <option value=" ">Не выбрано</option>

              @foreach ($subjects as $subject)
                <option
                value="{{ $subject->id }}"
                {{ ((old('subject_1_id') ?: (isset($specialty->subjects[0]) ? $specialty->subjects[0]->id : '')) == $subject->id) ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach

            </select>
        </div>

        <div class="four wide field{{ $errors->has('subject_2_id') ? ' error' : '' }}">
            <label for="title">Предмет 2-й</label>
            <select name="subject_2_id" class="ui search dropdown">
              <option value="">Предмет 2-й</option>
              <option value=" ">Не выбрано</option>

              @foreach ($subjects as $subject)
                <option
                value="{{ $subject->id }}"
                {{ ((old('subject_2_id') ?: (isset($specialty->subjects[1]) ? $specialty->subjects[1]->id : '')) == $subject->id) ? 'selected' : '' }}>
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
