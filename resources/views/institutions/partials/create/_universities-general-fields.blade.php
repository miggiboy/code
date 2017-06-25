<div class="fields">

  <div class="eight wide required field{{ $errors->has('title') ? ' error' : '' }}">
    <label for="title">Название</label>
    <input type="text" name="title"
           value="{{ old('title') }}"
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
    <label for="abbreviation">Аббревиатура(-ы)</label>
    <input type="text"
           name="abbreviation"
           value="{{ old('abbreviation') }}"
           id="abbreviation"
           placeholder="Аббревиатура(-ы)">
  </div>

</div>
<div class="fields">

  <div class="four wide disabled field">
      <label for="type_id">Тип вуза</label>
      <select name="" id="type_id" class="ui search dropdown">
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
           value="{{ old('foundation_year') }}"
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

  <div class="four wide field{{ $errors->has('address') ? ' error' : '' }}">
      <label for="address">Адрес</label>
      <input type="text"
             name="address"
             value="{{ old('address') }}"
             id="address"
             placeholder="Адрес">
  </div>

  <div class="four wide field">
          <label for="call_center">Телефон</label>
          <input type="text"
                 name="call_center"
                 value="{{ old('call_center') }}"
                 id="call_center"
                 placeholder="Телефон вуза">
  </div>

  <div class="four wide field{{ $errors->has('web_site') ? ' error' : '' }}">
      <label for="web_site">Веб-сайт</label>
      <input type="text"
             name="web_site"
             value="{{ old('web_site') }}"
             id="web_site"
             placeholder="Веб-сайт">
  </div>

</div>

<div class="field">
      <label for="description">Описание</label>
      <textarea id="description" name="description">{{ old('description') }}</textarea>
      <h5 class="ui right aligned header" style="font-weight: lighter; margin-top: 1px;">
        Описание должно быть в пределах 700 символов
      </h5>
 </div>
<br><br>

<div class="field">
      <label for="extra_description">Дополнительное описание</label>
      <textarea id="extra_description" name="extra_description">{{ old('extra_description') }}</textarea>
 </div>
<br><br>
