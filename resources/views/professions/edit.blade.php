@extends ('layouts.app')

@section ('title', 'Редактирование профессии')

@section ('subnavigation')
    @include ('professions.partials.navigation', ['pageTitle' => 'Редактирование  профессии'])
@endsection

@section ('content')

    @include ('includes.ckeditor')

    @include ('includes.form-errors')

    <form action="{{ route('professions.update', $profession) }}" method="post" class="ui form" style="margin-bottom: 35px; margin-top: 25px;">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      <div class="two fields">
        <div class="twelve wide required field">
            <label for="title">Название</label>
            <input type="text"
                   name="title"
                   id="title"
                   placeholder="Название профессии"
                  value ="{{ old('title', $profession->title) }}"
                  required>
        </div>

        <div class="four wide required field">
            <label for="prof_direction_id">Направление</label>
            <select name="prof_direction_id" id="prof_direction_id" class="ui search dropdown">
                <option value="">Направление</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                {{ (old('prof_direction_id', $profession->category->id) == $category->id) ? 'selected' : '' }}>
                {{ $category->title }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="field">
        <label for="short_description">Короткое описание</label>
        <textarea name="short_description" id="short_description" rows="3" required>{{ old('short_description', $profession->short_description) }}
        </textarea>
    </div>

    <div class="field">
        <label for="full_description">Полное описание</label>
        <textarea name="full_description" id="full_description" rows="20" required>{{ old('full_description', $profession->full_description) }}
        </textarea>
    </div>

    <button class="ui big teal button">Сохранить</button>

    </form>
@endsection

@section ('script')
  <script>
    CKEDITOR.replace('full_description', {
        height: 500
    });
  </script>
@endsection
