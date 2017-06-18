<form class="ui small form" action="{{ route('institutions.index', request()->route('institutionType')) }}" method="get">
    <div class="three fields">

      <div class="eight wide field">
        <div class="ui fluid search universities">
          <div class="ui right icon input">
            <input type="text"
                   value="{{ request('s.query') }}"
                   name = "s[query]"
                   class="prompt"
                   placeholder="Начните вводить название вуза ..."
                   autofocus>

            <i class="search icon"></i>
          </div>
        </div>
      </div>

      <div class="four wide field">
          <select class="ui selection search dropdown" name="s[city]">
            <option value="">Город</option>
            <option value=" ">Не выбрано</option>
            @foreach ($cities as $city)
              <option value="{{ $city->id }}"
                      {{ (request('s.city') == $city->id) ? 'selected' : '' }}>
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
                 name="s[is_paid]"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('s.is_paid') == "1") ? 'checked' : '' }}>
          <label>Платники</label>
        </div>
      </div>

      <div class="three wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="s[without_map]"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('s.without_map') == "1") ? 'checked' : '' }}>
          <label>Без карты</label>
        </div>
      </div>

      <div class="four wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="s[without_specialities]"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('s.without_specialities') == "1") ? 'checked' : '' }}>
          <label>Без специальностей</label>
        </div>
      </div>

      <div class="field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="s[marked]"
                 value="1"
                 tabindex="0"
                 class="hidden"
                 {{ (request('s.marked') == "1") ? 'checked' : '' }}>
          <label>Отмеченные</label>
        </div>
      </div>
    </div>

    <p>Результатов: {{ $institutions->total() }}</p>
</form>
<br>
