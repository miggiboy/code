@extends ('layouts.master')

@section ('title', 'Добавление статьи')

@section ('subnavigation')
    @include ('articles.partials.navigation', ['pageTitle' => 'Добавление  статьи'])
@endsection

@section ('content')
    @include ('includes.ckeditor')

    @include ('includes.form-errors')

    <form action="{{ route('articles.store') }}"
          method="post"
          class="ui form"
          style="margin-bottom: 35px; margin-top: 25px;">

        {{ csrf_field() }}

      <div class="two fields">
        <div class="twelve wide required field">
          <label for="title">Название</label>
          <input type="text"
                 name="title"
                 id="title"
                 placeholder="Название статьи"
                 value="{{ old('title') ?: '' }}"
                 required
                 autofocus>
        </div>

        <div class="four wide required field">
          <label for="type">Тип</label>
          <select name="type" id="type" class="ui dropdown">
             <option value="">Тип статьи</option>
              <option value="1" {{ (old('type') == "1") ? 'selected' : '' }}>
                Статья
              </option>
              <option value="0" {{ (old('type') == "0") ? 'selected' : '' }}>
                Новостная статья
              </option>
          </select>
        </div>
      </div>

      <div class="two fields">

        <div class="eleven wide field">
          <label for="categories[]">Категории</label>
          <select name="categories[]"
                 id="categories[]"
                 class="ui search dropdown"
                 multiple="">
            <option value="">Выберите из списка</option>
               @foreach ($categories as $category)
                 <option value="{{ $category->id }}"
                  {{ ((collect(old('categories', []))->contains($category->id)) ? 'selected' : '') }}>
                    {{ $category->title }}
                 </option>
               @endforeach
          </select>
        </div>

        <div class="field">
          <label for="new_category">Новая категория</label>
          <input type="text"
                 name="new_category"
                 id="new_category"
                 placeholder="Или придумайте новую."
                 value="{{ old('new_category') ?: '' }}">
        </div>

      </div>

      <div class="required field">
        <label for="short_description">Краткое описание</label>
        <textarea name="short_description" id="short_description" rows="3">{{ (old('short_description') ?: '') }}
        </textarea>
      </div>

      <div class="required field">
        <label for="full_description">Содержание</label>
        <textarea name="full_description" id="full_description" rows="20">{{ (old('full_description') ?: '') }}
        </textarea>
      </div>

      <button class="ui big teal button">Сохранить</button>
    </form>
@endsection

@section ('script')
  <script>
      CKEDITOR.replace('full_description', {
        height: 450
      });
  </script>
@endsection
