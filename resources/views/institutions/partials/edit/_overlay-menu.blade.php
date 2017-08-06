<div class="overlay">
  <div class="ui vertical icon menu">

    @if (isset($institution->web_site_url))
      <a class="item"
         href="{{ $institution->web_site_url }}"
         title="Перейти на сайт {{ translate($institution->type, 'r', 's') }}"
         target="_blank">
        <i class="blue world icon"></i>
      </a>
    @else
      <a class="disabled item"
         title="Для {{ translate($institution->type, 'r', 's') }} не задан сайт. Воспользуйтесь кнопкой поиска в Google (ниже)"
         target="_blank"
         disabled>
        <i class="grey world icon"></i>
      </a>
    @endif

    <a class="item"
       href="{{ url($institution->googleSearchURl()) }}"
       title="Найти {{ translate($institution->type, 'i', 's') }} в Google"
       target="_blank">
      <i class="green google icon"></i>
    </a>

    <a class="item"
       title="Сохранить изменения"
       onclick="event.preventDefault(); document.getElementById('edit-institution-form').submit();">
      <i class="teal save icon"></i>
    </a>

  </div>
</div>
