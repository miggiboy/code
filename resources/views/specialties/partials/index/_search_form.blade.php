<form class="ui small form"
      action="{{ route('specialties.index', $institutionType) }}"
      method="get">

    <div class="three fields">

      <div class="eight wide field">
        <div class="ui fluid search specialties">
          <div class="ui right icon input">
            <input type="text"
                   name="query"
                   value="{{ request('query') }}"
                   class="prompt"
                   placeholder="Название или код специальности..."
                   autofocus>

            <i class="search icon"></i>
          </div>
        </div>
      </div>

      <div class="six wide field">
          <select class="ui selection search dropdown" name="direction">
            <option value="">Направление</option>
            <option value=" ">Не выбрано</option>
              @foreach ($directions as $direction)
                <option value="{{ $direction->id }}"
                        {{ (request('direction') == $direction->id) ? 'selected' : '' }}>
                  {{ $direction->title }}
                </option>
              @endforeach
          </select>
      </div>

      <div class="four wide field">
        <input type="submit" value="Поиск" class="ui small basic button">
      </div>

    </div>

    <div class="four fields" style="margin-bottom: 17px;">

      <div class="three wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="has_subjects"
                 value="0"
                 tabindex="0"
                 class="hidden"
                 {{ (request('has_subjects') == "0") ? 'checked' : '' }}>
          <label>Без предметов</label>
        </div>
      </div>

      <div class="three wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="has_description"
                 value="0"
                 tabindex="0"
                 class="hidden"
                 {{ (request('has_description') == "0") ? 'checked' : '' }}>
          <label>Без описания</label>
        </div>
      </div>

      <div class="field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="has_direction"
                 value="0"
                 tabindex="0"
                 class="hidden"
                 {{ (request('has_direction') == "0") ? 'checked' : '' }}>
          <label>Без направления</label>
        </div>
      </div>

      <div class="three wide field" style="margin-top: 7px;">
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

    <p>Результатов: {{ $specialties->total() }}</p>
</form>
