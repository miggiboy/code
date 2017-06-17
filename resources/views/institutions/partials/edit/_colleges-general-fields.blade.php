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
    <h5 class="ui right aligned header" style="font-weight: lighter; margin-top: 1px;">Описание должно быть в пределах 700 символов</h5>
  </div>

<br><br>

  <div class="field">
    <label for="extra_description">Дополнительное описание</label>
    <textarea id="extra_description" name="extra_description">{!! old('extra_description', $college->extra_description) !!}
    </textarea>
 </div>
<br><br>
