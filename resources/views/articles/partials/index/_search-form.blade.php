<form class="ui small form" action="{{ route('articles.index') }}" method="get">
    <div class="three fields">
      <div class="eight wide field">
        <div class="ui fluid search">
          <div class="ui right icon input">
            <input type="text"
                   name="query"
                   value="{{ request('query') }}"
                   class="prompt"
                   placeholder="Название статьи ..."
                   autofocus>
            <i class="search icon"></i>
          </div>
        </div>
      </div>
      <div class="four wide field">
            <select class="ui selection search dropdown" name="category">
              <option value="">Категория</option>
              <option value=" ">Не выбрана</option>
               @foreach ($categories as $category)
                 <option value="{{ $category->id }}"
                         {{ (request('category') == $category->id) ? 'selected' : '' }}>
                   {{ $category->title }}
                 </option>
               @endforeach
            </select>
        </div>
        <div class="four wide field">
          <input type="submit" value="Поиск" class="ui small basic button">
        </div>
    </div>

    <p>Результатов: {{ $articles->total() }}</p>
</form>

<br>
