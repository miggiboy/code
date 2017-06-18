<form class="ui small form" action="" method="get">
    <div class="two fields">
      <div class="eight wide field">
        <div class="ui fluid search universities">
          <div class="ui right icon input">
            <input type="text" name = "query" class="prompt" placeholder="Начните вводить название статьи ...">
            <i class="search icon"></i>
          </div>
        </div>
      </div>
      <div class="three wide field">
            <select class="ui selection search dropdown" name="category">
              <option value="">Категория</option>
               @foreach ($categories as $category)
                 <option value="{{ $category->id }}">
                   {{ $category->title }}
                 </option>
               @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="ui small basic button">Поиск</button>
</form>

<br>
