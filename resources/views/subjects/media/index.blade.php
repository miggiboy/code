@extends ('layouts.app')

@section ('title')
    {{ $subject->title }}
@endsection

@section ('subnavigation')
    @include ('subjects.partials._subject_navigation', ['pageTitle' => $subject->title])
@endsection

@section ('head')
  <style>
    .ui.card {
      margin-left: 65px !important;
      margin-bottom: 40px !important;
    }
    .ui.cards {
        margin-top: 45px;
    }

    .overlay {
        position: fixed; bottom: 42px; right: 37px; z-index: 10;
    }
  </style>
@endsection

@section ('content')

    <br><br>
    <br>

    <div class="ui grid">
        <div class="column">
            <div class="ui very relaxed middle aligned selection list">
              @foreach ($subject->getMedia('') as $media)
                <div class="item">
                  <div class="right floated content">
                    <a href="{{ $media->getUrl() }}" class="ui mini green button"
                      style="margin-right: 15px; text-decoration: underline;" target="_blank" download>Скачать</a>
                    <a href="#" class="ui mini yellow button"
                      onclick="event.preventDefault();
                        document.getElementById('destroy-media-{{ $media->id }}-form').submit();">Удалить</a>
                    <form action="{{ route('subjects.media.destroy', [$subject, $media]) }}"
                            id="destroy-media-{{ $media->id }}-form" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                  </div>
                  <div class="right floated content">
                    <div style="margin-top: 8px; margin-right: 70px; color: #444; font-size: 12px;">
                      {{ $media->created_at->format('d.m.y') }}
                    </div>
                  </div>

                  <div class="right floated content">
                    <div style="margin-top: 8px; margin-right: 70px; color: #444; font-size: 12px;">
                      {{ $media->human_readable_size }}
                    </div>
                  </div>
                  <div class="right floated content">
                    <div style="margin-top: 8px; margin-right: 70px; color: #444; font-size: 12px;">
                      {{ $media->collection_name }}
                    </div>
                  </div>
                  <img class="ui image" src="/images/file-icons/exe.svg" style="width: 37px; height: 37px;">
                  <div class="content">
                    <a href="" style="color: #444; text-decoration: underline; font-size: 12px;" title="{{ $media->name }}">
                      {{ str_limit($media->name, 60) }}
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
        </div>
    </div>

    <div class="ui modal">
      <i class="close icon"></i>
      <div class="header">
        Добавление файлов
      </div>
      <div class="image content">
        <div class="ui medium image">
          <img src="/images/file-icons/exe.svg">
        </div>
        <div class="description">
          <div class="ui header">Прикрепляем файлы предмету</div>
          <p>Заливать можно по нескольку файлов</p>
          <p>Загрузка займет время поэтому если Вы не хотите ждать то можете нажать на <a href="{{ route('subjects') }}" target="_blank">эту ссылку</a></p><br>
          <form action="{{ route('subjects.media.store', $subject) }}" method="post"
            enctype="multipart/form-data" id="subject-files" class="ui form">
            {{ csrf_field() }}

            <div class="field">
              <label for="">Категория файлов</label>
              <select class="ui dropdown" name="category">
                <option value="">Тип файла</option>
                @foreach ($subject->fileCategories as $category)
                  <option value="{{ $category->title }}">{{ $category->display_title }}</option>
                @endforeach
              </select>
            </div>

            <div class="field">
              <input type="file" name="files[]" id="" multiple>
            </div>
          </form>
        </div>

      </div>
      <div class="actions">
        <div class="ui positive right labeled icon button" onclick="event.preventDefault();
          document.getElementById('subject-files').submit();">
          Загрузить
          <i class="checkmark icon"></i>
        </div>
      </div>
    </div>

    <div class="overlay">
      <a href="" onclick="event.preventDefault(); $('.ui.modal').modal({ inverted: true }).modal('show');"
        class="ui huge green circular icon button">
        <i class="ui add icon"></i>
      </a>
    </div>
@endsection
