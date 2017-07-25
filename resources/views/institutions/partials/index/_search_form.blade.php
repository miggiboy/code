<form class="ui small form" action="{{ route('institutions.index', $institutionType) }}" method="get">
    <div class="three fields">

      <div class="eight wide field">
        <div class="ui fluid search universities">
          <div class="ui right icon input">
            <input type="text"
                   value="{{ request('query') }}"
                   name = "query"
                   class="prompt"
                   placeholder="Название или аббревиатура ..."
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
                      {{ (request('city') == $city->id) ? 'selected' : '' }}>
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
                 name="has_map"
                 value="0"
                 tabindex="0"
                 class="hidden"
                 {{ (request('has_map') == "0") ? 'checked' : '' }}>
          <label>Без карты</label>
        </div>
      </div>

      <div class="four wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="has_specialties"
                 value="0"
                 tabindex="0"
                 class="hidden"
                 {{ (request('has_specialties') == "0") ? 'checked' : '' }}>
          <label>Без специальностей</label>
        </div>
      </div>

      @include ('markers/partials/_marked-by-filter')

    </div>

    <p>Результатов: {{ $institutions->total() }}</p>
</form>
<br>
