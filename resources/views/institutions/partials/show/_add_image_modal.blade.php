<div class="ui modal" id="add-media-modal">
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
      <p>Загрузка может занять время, если Вы не хотите ждать то можете нажать на
        <a href="" target="_blank">эту ссылку</a>
      </p>
      <br>
      <form action="{{ route('institutions.media.store', $institution) }}"
            method="post"
            enctype="multipart/form-data"
            id="images-form"
            class="ui form">
        {{ csrf_field() }}

        <input type="hidden" name="collection" value="images">

        <div class="field">
          <input type="file" name="images[]" id="file-input" multiple>
        </div>
      </form>
    </div>

  </div>
  <div class="actions">
    <div class="ui positive right labeled icon button"
         id="form-submit-button"
         onclick="event.stopPropagation();
         sendForm({
          id: 'images-form',
          fileInputId: 'file-input',
          submitButtonId: 'form-submit-button'
         });">
      Загрузить <i class="checkmark icon"></i>
    </div>
  </div>
</div>
