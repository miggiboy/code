<div class="fields">

<div class="eight wide required field{{ $errors->has('title') ? ' error' : '' }}">
    <label for="title">Название</label>
    <input type="text"
           name="title"
           id="title"
           value="{{ old('title', $institution->title) }}"
           placeholder="Название"
           required>
</div>

<div class="eight wide field">
    <label for="abbreviation">Аббревиатура(-ы)</label>
    <input type="text"
           name="abbreviation"
           id="abbreviation"
           value="{{ old('abbreviation', $institution->abbreviation) }}"
           placeholder="Аббревиатура(-ы)">
</div>

</div>
<div class="fields">

<div class="four wide field">
    <label for="has_dormitory">Общежитие</label>
    <select name="has_dormitory" id="has_dormitory" class="ui dropdown">
      <option value="">Общежитие</option>
      <option value="1"
        {{ ((old('has_dormitory', $institution->has_dormitory)) == "1") ? 'selected' : '' }}>
        Eсть
      </option>
      <option value="0"
        {{ ((old('has_dormitory', $institution->has_dormitory)) == "0") ? 'selected' : '' }}>
        Нет
      </option>
      <option value=" ">Неизвестно</option>
    </select>
</div>

<div class="four wide {{ ($institutionType == 'colleges') ? 'disabled ' : '' }}field">
    <label for="has_military_dep">Военная каф.</label>
    <select name="has_military_dep" id="has_military_dep" class="ui dropdown">
      <option value="">Военная каф.</option>
      <option value="1"
        {{ ((old('has_military_dep', $institution->has_military_dep)) == "1") ? 'selected' : '' }}>
        Eсть
      </option>
      <option value="0"
        {{ ((old('has_military_dep', $institution->has_military_dep)) == "0") ? 'selected' : '' }}>
        Нет
      </option>
      <option value=" ">Неизвестно</option>
    </select>
</div>

<div class="four wide field{{ $errors->has('foundation_year') ? ' error' : '' }}">
    <label for="foundation_year">Год основания</label>
    <input type="text"
           name="foundation_year"
           value="{{ old('foundation_year', $institution->foundation_year) }}"
           id="foundation_year"
           placeholder="Год основания">
</div>

<div class="four wide required field">
    <label for="is_paid">Платник?</label>
    <select name="is_paid" id="is_paid" class="ui dropdown">
      <option value="0" selected>Нет</option>
      <option value="1">Да</option>
    </select>
</div>

</div>
<br><br>

<div class="fields">
<div class="four wide required field{{ $errors->has('city_id') ? ' error' : '' }}">
    <label for="city_id">Город</label>
    <select name="city_id" id="city_id" class="ui search dropdown">
        <option value="">Город</option>
        @foreach ($cities as $city)
          <option value="{{ $city->id }}"
            {{ ((old('city_id', $institution->city->id)) == $city->id) ? 'selected' : '' }}>
            {{ $city->title }}
          </option>
        @endforeach
    </select>
</div>

<div class="four wide field{{ $errors->has('address') ? ' error' : '' }}">
    <label for="address">Адрес</label>
    <input type="text"
           name="address"
           value="{{ old('address', $institution->address) }}"
           id="address"
           placeholder="Адрес">
</div>


<div class="four wide field">
      <label for="phone_number">Основной телефон</label>
      <input type="text"
             name="phone_number"
             value="{{ old('phone_number', $institution->phone_number) }}"
             id="phone_number"
             placeholder="Основной телефон">
</div>


<div class="four wide field{{ $errors->has('web_site') ? ' error' : '' }}">
    <label for="web_site">Веб-сайт</label>
    <input type="text"
           name="web_site"
           value="{{ old('web_site', $institution->web_site) }}"
           id="web_site"
           placeholder="Веб-сайт">
</div>

</div>

<div class="field">
  <label for="description">Описание</label>
  <textarea id="description" name="description">{!! old('description', $institution->description) !!}</textarea>
  <h5 class="ui right aligned header" style="font-weight: lighter; margin-top: 1px;">Описание должно быть в пределах 700 символов</h5>
</div>
<br><br>

<div class="field">
  <label for="extra_description">Дополнительное описание</label>
  <textarea id="extra_description" name="extra_description">{!! old('extra_description', $institution->extra_description) !!}</textarea>
</div>
<br><br>
