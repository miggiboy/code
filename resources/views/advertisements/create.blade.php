@extends ('layouts.master')

@section ('title')
    Реклама на сайте
@endsection

@section ('styles')
  <style>
    #advertisement-form > .field {
       margin-bottom: 20px;
    }
  </style>
@endsection

@section ('content')

  <div class="ui text container">

    @include ('layouts.form-errors')

    <form action="{{ route('advertisements.store') }}"
              method="post"
              enctype="multipart/form-data"
              class="ui form"
              style="margin-bottom: 35px; margin-top: 25px;"
              id="advertisement-form">

            {{ csrf_field() }}

          {{-- <div class="two fields"> --}}
            <div class="required field">
              <label for="description">Описание</label>
              <input type="text"
                     name="description"
                     id="description"
                     placeholder="Описание рекламы"
                     value="{{ old('description') ?: '' }}"
                     required
                     autofocus>
            </div>

            <div class="required field">
              <label for="type">Тип</label>
              <select name="type" id="type" class="ui dropdown">
                 <option value="">Тип рекламы</option>
                  <option value="banner" {{ (old('type') == "banner") ? 'selected' : '' }}>
                    Одиночный баннер
                  </option>
                  <option value="slider" {{ (old('type') == "slider") ? 'selected' : '' }}>
                    Слайдер с баннерами
                  </option>
              </select>
            </div>
          {{-- </div> --}}

          <div class="field">
                <label for="url">Ссылка</label>
                  <input type="text"
                         name="url"
                         id="url"
                         placeholder="Ссылка рекламы"
                         value="{{ old('url') ?: '' }}"
                         required
                         autofocus>
          </div>

          {{-- <div class="two fields"> --}}
            <div class="field">
                <label for="media">Рекламные изображения</label>
                <input type="file" name="images[]" id="" multiple>
            </div>

            <div class="field">
                <label for="screenshot">Скриншот рекламного блока на сайте</label>
                <input type="file" name="screenshot" id="screenshot">
            </div>

          {{-- </div> --}}

          <button type="submit" class="ui fluid teal button">Сохранить</button>
        </form>

  </div>




@endsection
