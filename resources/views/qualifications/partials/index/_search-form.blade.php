<form class="ui small form"
      action="{{ route('qualifications.index') }}"
      method="get">

    <div class="three fields">

      <div class="eight wide field">
        <div class="ui fluid search">
          <div class="ui right icon input">
            <input type="text"
                   name="query"
                   value="{{ request('query') }}"
                   class="prompt"
                   placeholder="Название или код квалификации..."
                   autofocus>
            <i class="search icon"></i>
          </div>
        </div>
      </div>

      <div class="four wide field">
        <input type="submit" value="Поиск" class="ui small basic button">
      </div>

    </div>

    <div class="fields" style="margin-bottom: 17px;">

      <div class="three wide field" style="margin-top: 7px;">
        <div class="ui checkbox">
          <input type="checkbox"
                 name="has_specialty"
                 value="0"
                 tabindex="0"
                 class="hidden"
                 {{ (request('has_specialty') == "0") ? 'checked' : '' }}>
          <label>Без специальности</label>
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

      @include ('markers/partials/_marked-by-filter')

    </div>

    <p>Результатов: {{ $qualifications->total() }}</p>
</form>
