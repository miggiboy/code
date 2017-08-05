<div class="ui modal">
  <i class="close icon"></i>
  <div class="header" id="modal-header">
    Добавление файлов
  </div>
  <div class="image content">
    <div class="ui medium image">
      <img src="/images/file-icons/exe.svg">
    </div>
    <div class="description">
      <div class="ui header">Прикрепляем файлы предмету</div>
      <p>Заливать можно по нескольку файлов</p>
      <p>Загрузка может занять время, поэтому если Вы не хотите ждать то можете нажать на
        <a href="{{ route('subjects.show', $subject) }}" target="_blank">эту ссылку</a>
      </p>
      <br>
      <form action="{{ route('subjects.media.store', $subject) }}"
            method="post"
            enctype="multipart/form-data"
            id="subject-files"
            class="ui form">

        {{ csrf_field() }}

        <div class="field">
          <label for="">Категория файлов</label>
          <select class="ui dropdown" name="category" id="category-select">
            <option value="">Тип файла</option>
            @foreach ($subject->fileCategories as $category)
              <option value="{{ $category->title }}">
                {{ $category->display_title }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <input type="file" name="files[]" id="file-input" multiple>
        </div>
      </form>
    </div>

  </div>
  <div class="actions">
    <div class="ui positive right labeled icon button"
         id="form-submit-button"
         onclick="event.stopPropagation();
         sendForm({
          id: 'subject-files',
          selectId: 'category-select',
          fileInputId: 'file-input',
          submitButtonId: 'form-submit-button'
        });">
      Загрузить
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
