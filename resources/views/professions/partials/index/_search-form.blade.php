<form class="ui small form" action="{{ route('professions.index') }}" method="get">

  <div class="three fields">

    <div class="eight wide field">
      <div class="ui fluid professions search">
        <div class="ui right icon input">
          <input type="text"
                 name = "query"
                 value="{{ request('query') }}"
                 class="prompt"
                 placeholder="Начните вводить название профессии ..."
                 autofocus>

          <i class="search icon"></i>
        </div>
      </div>
    </div>

    <div class="four wide field">
        <select class="ui selection search dropdown" name="direction">
          <option value="">Проф-направление</option>
          <option value=" ">Не выбрано</option>
           @foreach ($categories as $category)
             <option value="{{ $category->id }}"
                     {{ (request('direction') == $category->id) ? 'selected' : '' }}>
               {{ $category->title }}
             </option>
           @endforeach
        </select>
      </div>

      <div class="four wide field">
        <input type="submit" value="Поиск" class="ui small basic button">
      </div>
  </div>

  <div class="three wide field" style="margin-top: 7px; margin-top: 7px;">
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

  <p>Результатов: {{ $professions->total() }}</p>
</form>

<br>
