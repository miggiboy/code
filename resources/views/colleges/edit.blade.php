@extends ('layouts.master')

@section ('title')
  Редактирование колледжа {{ $college->title }}
@endsection

@section ('subnavigation')
    @include ('colleges.partials.navigation', ['pageTitle' => 'Редактирование колледжа'])
@endsection

@section ('content')

    @include ('layouts.ckeditor')

    <br>

    <form action="{{ route('colleges.update', $college) }}" method="post" class="ui form">
      {{ method_field('PATCH') }}
      {{ csrf_field() }}

      @include ('layouts.form-errors')

      <div class="ui horizontal divider">
          <i class="teal university icon"></i> Основная информация
      </div>
      <br>

      <div class="fields">

        <div class="eight wide required field{{ $errors->has('title') ? ' error' : '' }}">
            <label for="title">Название</label>
            <input type="text" name="title" id="title" value="{{ old('title', $college->title) }}" placeholder="Название" required>
        </div>

        <div class="five wide field">
            <label for="acronym">Акроним(-ы)</label>
            <input type="text" name="acronym" id="acronym" value="{{ old('acronym', $college->acronym) }}" placeholder="Акроним(-ы)">
        </div>

        <div class="three wide field">
            <label for="has_dormitory">Общежитие</label>
            <select name="has_dormitory" id="has_dormitory" class="ui dropdown">
              <option value="">Общежитие</option>
              <option value="1"
                {{ ((old('has_dormitory', $college->has_dormitory)) == "1") ? 'selected' : '' }}>
                Eсть
              </option>
              <option value="0"
                {{ ((old('has_dormitory', $college->has_dormitory)) == "0") ? 'selected' : '' }}>
                Нет
              </option>
              <option value=" ">Неизвестно</option>
            </select>
        </div>

      </div><br>

      <div class="fields">
        <div class="four wide required field{{ $errors->has('city_id') ? ' error' : '' }}">
            <label for="city_id">Город</label>
            <select name="city_id" id="city_id" class="ui search dropdown">
                <option value="">Город</option>

                @foreach ($cities as $city)
                  <option value="{{ $city->id }}"
                    {{ ((old('city_id', $college->city->id)) == $city->id) ? 'selected' : '' }}>
                    {{ $city->title }}
                  </option>
                @endforeach

            </select>
        </div>

        <div class="four wide field{{ $errors->has('address') ? ' error' : '' }}">
            <label for="address">Адрес</label>
            <input type="text" name="address" value="{{ old('address', $college->address) }}" id="address" placeholder="Адрес">
        </div>

        <div class="three wide field">
              <label for="call_center">Телефон</label>
              <input type="text"
                     name="call_center"
                     value="{{ old('call_center') ?: $college->call_center }}"
                     id="call_center"
                     placeholder="Телефон колледжа"
              >
        </div>

        <div class="three wide field{{ $errors->has('web_site') ? ' error' : '' }}">
            <label for="web_site">Веб-сайт</label>
            <input type="text" name="web_site" value="{{ old('web_site', $college->web_site) }}" id="web_site" placeholder="Веб-сайт">
        </div>

        <div class="two wide field{{ $errors->has('foundation_year') ? ' error' : '' }}">
            <label for="foundation_year">Год основания</label>
            <input type="text" name="foundation_year" value="{{ old('foundation_year', $college->foundation_year) }}" id="foundation_year" placeholder="Год основания">
        </div>

      </div>

      <div class="field">
          <label for="description">Описание</label>
          <textarea id="description" name="description">{!! old('description', $college->description) !!}
          </textarea>
       </div>
      <br><br>

      <div class="ui horizontal divider">
          <i class="teal call icon"></i> Приемная комиссия
      </div>
      <br>

      <div class="fields">

          <div class="four wide field">
              <label for="reception[phone]">Телефон</label>
              <input type="text" name="reception[phone]"
                     value = "{{ old('reception.phone') ?: ($college->hasReception() ? $college->reception->phone : '') }}"
                     id="reception[phone]"
                     placeholder="Телефон приемной ком."
              >
          </div>

          <div class="four wide field">
              <label for="reception[phone_2]">Доп. телефон</label>
              <input type="text" name="reception[phone_2]"
                     value = "{{ old('reception.phone_2') ?: ($college->hasReception() ? $college->reception->phone_2 : '') }}"
                     id="reception[phone2]"
                     placeholder="Телефон приемной ком."
              >
          </div>

          <div class="four wide field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="reception[email]">Email</label>
                <input type="email"
                       name="reception[email]"
                       value="{{ old('reception.email') ?: ($college->hasReception() ? $college->reception->email : '') }}"
                       id="reception[email]"
                       placeholder="Email"
                >
            </div>

          <div class="four wide field{{ $errors->has('reception[address]') ? ' error' : '' }}">
              <label for="reception[address]">Адрес</label>
              <input type="text"
                     name="reception[address]"
                     value="{{ old('reception.address') ?: ($college->hasReception() ? $college->reception->address : '') }}"
                     id="reception[address]"
                     placeholder="Адрес приемной ком."
              >
          </div>

        </div>

        <div class="field">
          <label for="reception[info]">Информация по приемной комиссии</label>
          <textarea name="reception[info]" id="reception[info]">{!! old('reception.info') ?: ($college->hasReception() ? $college->reception->info : '') !!}
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
        height: 350
      });
      CKEDITOR.replace('reception[info]', {
        height: 350
      });
  </script>
@endsection
