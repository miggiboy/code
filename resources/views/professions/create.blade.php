@extends ('layouts.app')

@section ('title', 'Добавление профессии')

@section ('subnavigation')
    @include ('professions/partials/_navigation', ['heading' => 'Добавление  профессии'])
@endsection

@section ('content')
    @include ('includes/_ckeditor')

    @include ('includes/_form-errors')

    <form action="{{ route('professions.store') }}"
          method="post"
          class="ui form" style="margin-bottom: 35px; margin-top: 25px;">

      {{ csrf_field() }}

      <div class="two fields">
        <div class="twelve wide required field">
          <label for="title">Название</label>
          <input type="text"
                 name="title"
                 id="title"
                 placeholder="Название профессии"
                 value="{{ old('title') }}"
                 required
                 autofocus>
        </div>

        <div class="four wide required field">
          <label for="category_id">Категория</label>
          <select name="category_id" id="category_id" class="ui search dropdown">
            <option value="">Категория</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}"
                      {{ (old('category_id') == $category->id ? 'selected' : '') }}>
                  {{ $category->title }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="field">
        <label for="short_description">Краткое описание</label>
        <textarea name="short_description" id="short_description" rows="3">{{ (old('short_description')) }}
        </textarea>
      </div>

      <div class="field">
        <label for="full_description">Полное описание</label>
        <textarea name="full_description" id="full_description">{{ (old('full_description')) }}
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
