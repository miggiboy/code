@extends ('layouts.app')

@section ('title')
    {{ $subject->title }}
@endsection

@section ('subnavigation')
    @include ('subjects/partials/_navigation', ['heading' => $subject->title])
@endsection

@section ('head')
  <style>
    .overlay {
        position: fixed;
        bottom: 42px;
        right: 37px;
        z-index: 10;
    }

    #subject-media-list > a {
        margin-right: 15px;
        text-decoration: underline;
    }

    .subject-file-meta {
      margin-top: 8px;
      margin-right: 70px;
      color: #444;
      font-size: 12px;
    }

    .subject-file-name {
      color: #444;
      text-decoration: underline;
      font-size: 12px;
    }

    .subject-file-icon {
        width: 37px;
        height: 37px;
    }
  </style>
@endsection

@section ('content')
    <br><br><br>

    @include ('subjects/media/partials/index/_list')
    @include ('subjects/media/partials/index/_media-add-modal')

    <div class="overlay">
      <a href="" onclick="event.preventDefault(); $('.ui.modal').modal({ inverted: true }).modal('show');"
        class="ui huge green circular icon button"
        title="Добавить файлы">
        <i class="ui add icon"></i>
      </a>
    </div>
    <br>
    {{ $subjectMedia->appends(request()
        ->except('page', '_token'))
        ->links('vendor.pagination.default')
    }}
    <br><br>
@endsection
