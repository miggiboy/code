<div class="ui modal">
  <i class="close icon"></i>
  <div class="header">
    Добавление изображений
  </div>
  <div class="image content">
    <div class="ui medium image">
      <img src="/images/file-icons/png.svg">
    </div>
    <div class="description">
      <div class="ui header">Прикрепляем изображения</div>
      <p>Заливать можно по нескольку файлов</p>
      <p>Загрузка займет время поэтому если Вы не хотите ждать то можете нажать на <a href="" target="_blank">эту ссылку</a></p><br>
      <form action="{{ route($route, $model) }}" method="post"
        enctype="multipart/form-data" id="images-form" class="ui form">
        {{ csrf_field() }}

        <div class="field">
          <label for="">Категория файлов</label>
          <select class="ui dropdown" name="collection">
              <option value="images">Не логотипы</option>
              <option value="logo">Логотипы</option>
          </select>
        </div>

        <div class="field">
          <input type="file" name="images[]" id="" multiple>
        </div>
      </form>
    </div>

  </div>
  <div class="actions">
    <div class="ui positive right labeled icon button" onclick="event.preventDefault();
      document.getElementById('images-form').submit();">
      Загрузить
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>

<div class="overlay">
  <a href="" onclick="event.preventDefault(); $('.ui.modal').modal({ inverted: true }).modal('show');"
    class="ui huge purple circular icon button">
    <i class="ui photo icon"></i>
  </a>
</div>
