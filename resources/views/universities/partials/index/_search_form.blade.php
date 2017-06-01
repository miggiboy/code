<form class="ui small form" action="{{ route('universities.search') }}" method="get">
    <div class="three fields">

      <div class="eight wide field">
        <div class="ui fluid search universities">
          <div class="ui right icon input">
            <input type="text"
                   value="{{ old('query') }}"
                   name = "query"
                   class="prompt"
                   placeholder="Начните вводить название вуза ..."
                   autofocus>

            <i class="search icon"></i>
          </div>
        </div>
      </div>

      <div class="four wide field">
          <select class="ui selection search dropdown" name="city">
            <option value="">Город</option>
            <option value=" ">Не выбрано</option>
            @foreach ($cities as $city)
              <option value="{{ $city->id }}"
                      {{ (old('city') == $city->id) ? 'selected' : '' }}>
                {{ $city->title }}
              </option>
            @endforeach
          </select>
      </div>

      <div class="four wide field">
        <input type="submit" value="Поиск" class="ui small basic button">
      </div>
    </div>

    <div class="five fields" style="margin-bottom: 10px;">

      <div class="three wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="is_paid"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('is_paid') == "1") ? 'checked' : '' }}>
          <label>Платники</label>
        </div>
      </div>

      <div class="three wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="without_map"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('without_map') == "1") ? 'checked' : '' }}>
          <label>Без карты</label>
        </div>
      </div>

      <div class="four wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="without_specialities"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('without_specialities') == "1") ? 'checked' : '' }}>
          <label>Без специальностей</label>
        </div>
      </div>

      <div class="field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="marked"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('marked') == "1") ? 'checked' : '' }}>
          <label>Отмеченные</label>
        </div>
      </div>
    </div>

    <p>Результатов: {{ $universities->total() }}</p>
</form>
<br>
