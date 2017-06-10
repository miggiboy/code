@extends ('layouts.master')

@section ('title', 'Добавление вуза')

@section ('subnavigation')
    @include ('universities.partials.navigation', ['pageTitle' => 'Добавление вуза'])
@endsection

@section ('content')

    @include ('layouts.ckeditor')

    <br><br>
    <form action="{{ route('universities') }}" method="post" class="ui form">
      {{ csrf_field() }}

      @include ('layouts.form-errors')

      <div class="ui horizontal divider">
        <i class="teal university icon"></i> Основная информация
      </div>
      <br>

      <div class="fields">

        <div class="eight wide required field{{ $errors->has('title') ? ' error' : '' }}">
          <label for="title">Название</label>
          <input type="text" name="title"
                 value="{{ old('title') ?: '' }}"
                 id="title"
                 placeholder="Название"
                 required
                 autofocus>
          @if($errors->has('title'))
              <div class="ui error message">
                <p>{{ $errors->first('title') }}</p>
              </div>
          @endif
        </div>

        <div class="eight wide field">
          <label for="acronym">Акроним(-ы)</label>
          <input type="text"
                 name="acronym"
                 value="{{ old('acronym') ?: '' }}"
                 id="acronym"
                 placeholder="Акроним(-ы)"
          >
        </div>

      </div>
      <div class="fields">

        <div class="four wide disabled field">
            <label for="type_id">Тип вуза</label>
            <select name="type_id" id="type_id" class="ui search dropdown">
              <option value="">Тип вуза</option>
            </select>
        </div>

        <div class="four wide field">
            <label for="has_dormitory">Общежитие</label>
            <select name="has_dormitory" id="has_dormitory" class="ui dropdown">
              <option value="">Общежитие</option>
              <option value="1" {{ (old('has_dormitory') == "1") ? 'selected' : '' }}>
                Eсть
              </option>
              <option value="0" {{ (old('has_dormitory') == "0") ? 'selected' : '' }}>
                Нет
              </option>
              <option value=" ">Неизвестно</option>
            </select>
        </div>

        <div class="four wide field">
            <label for="has_military_dep">Военная кафедра</label>
            <select name="has_military_dep" id="has_military_dep" class="ui dropdown">
              <option value="">Военная каф.</option>
              <option value="1" {{ (old('has_military_dep') == "1") ? 'selected' : '' }}>
                Eсть
              </option>
              <option value="0" {{ (old('has_military_dep') == "0") ? 'selected' : '' }}>
                Нет
              </option>
              <option value=" ">Неизвестно</option>
            </select>
        </div>

        <div class="four wide field{{ $errors->has('foundation_year') ? ' error' : '' }}">
          <label for="foundation_year">Год основания</label>
          <input type="text"
                 name="foundation_year"
                 value="{{ old('foundation_year') ?: '' }}"
                 id="foundation_year"
                 placeholder="Год основания">
        </div>
      </div>
      <br><br>

      <div class="fields">

        <div class="four wide required field{{ $errors->has('city_id') ? ' error' : '' }}">
            <label for="city_id">Город</label>
              <select name="city_id" id="city_id" class="ui search dropdown">
                <option value="">Город</option>
                @foreach ($cities as $city)
                  <option value="{{ $city->id }}" {{ (old('city_id') == $city->id) ? 'selected' : '' }}>
                    {{ $city->title }}
                  </option>
                @endforeach
            </select>
        </div>

        <div class="five wide field{{ $errors->has('address') ? ' error' : '' }}">
            <label for="address">Адрес</label>
            <input type="text"
                   name="address"
                   value="{{ old('address') ?: '' }}"
                   id="address"
                   placeholder="Адрес">
        </div>

        {{-- Paste here --}}

        <div class="three wide field">
                <label for="call_center">Телефон</label>
                <input type="text"
                       name="call_center"
                       value="{{ old('call_center') ?: '' }}"
                       id="call_center"
                       placeholder="Телефон вуза">
        </div>

        <div class="four wide field{{ $errors->has('web_site') ? ' error' : '' }}">
            <label for="web_site">Веб-сайт</label>
            <input type="text"
                   name="web_site"
                   value="{{ old('web_site') ?: '' }}"
                   id="web_site"
                   placeholder="Веб-сайт">
        </div>

      </div>

      <div class="field">
            <label for="description">Описание</label>
            <textarea id="description" name = "description">{{ old('description') ?: '' }}</textarea>
            <h5 class="ui right aligned header" style="font-weight: lighter; margin-top: 1px;">Описание должно быть в пределах 700 символов</h5>
       </div>
      <br><br>

      <div class="field">
            <label for="extra_description">Дополнительное описание</label>
            <textarea id="extra_description" name = "extra_description">{{ old('extra_description') ?: '' }}</textarea>
       </div>
      <br><br>

      <div class="ui horizontal divider">
        <i class="teal call icon"></i> Приемная комиссия
      </div>
      <br>

        <div class="fields">

          <div class="four wide field">
                <label for="reception[phone]">Телефон</label>
                <input type="text"
                       name="reception[phone]"
                       value="{{ old('reception.phone') ?: '' }}"
                       id="reception[phone]"
                       placeholder="Телефон приемной ком.">
          </div>

          <div class="four wide field">
              <label for="reception[phone_2]">Доп. телефон</label>
              <input type="text"
                     name="reception[phone_2]"
                     value="{{ old('reception.phone_2') ?: '' }}"
                     id="reception[phone_2]"
                     placeholder="Телефон приемной ком.">
          </div>

          <div class="four wide field{{ $errors->has('reception[email]') ? ' error' : '' }}">
                <label for="reception[email]">Email</label>
                <input type="email"
                       name="reception[email]"
                       value="{{ old('reception.email') ?: '' }}"
                       id="reception[email]"
                       placeholder="Email">
          </div>

          <div class="four wide field{{ $errors->has('reception[address]') ? ' error' : '' }}">
                <label for="reception[address]">Адрес</label>
                <input type="text"
                       name="reception[address]"
                       value="{{ old('reception.address') ?: '' }}"
                       id="reception[address]"
                       placeholder="Адрес приемной ком.">
          </div>

        </div>

        <div class="field">
            <label for="reception[info]">Информация по приемной комиссии</label>
            <textarea name="reception[info]" id="reception[info]">{{ old('reception.info') ?: '' }}
            </textarea>
       </div>
       <br>

       <div class="inline field">
            <div class="ui toggle checkbox">
                <input type="checkbox" tabindex="0" class="hidden" name="add_specialities">
                <label>Добавить специальности после сохранения</label>
            </div>
        </div>
        <br>

        <button class="ui big teal button" type="submit">Сохранить</button>
    </form>
    <br><br>

@endsection

@section('script')
  <script>
      CKEDITOR.replace('description', {
          height: 350,
          extraPlugins: 'wordcount',
          wordcount: {
              showWordCount: false,
              showCharCount: true,
              maxWordCount: -1,
              maxCharCount: -1,
              showParagraphs: false,
              countSpacesAsChars: false,
              countHTML: false
          }
      });

      CKEDITOR.replace('extra_description', {
        height: 150
      });

      CKEDITOR.replace('reception[info]', {
        height: 350
      });
  </script>
@endsection
