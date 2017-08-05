<div class="ui grid">
    <div class="column">
        <div class="ui very relaxed middle aligned selection list" id="subject-media-list">
          @foreach ($subjectMedia as $media)
            <div class="item">

              {{-- Buttons --}}
              <div class="right floated content">
                <a href="{{ $media->getUrl() }}"
                   class="ui mini green button"
                   target="_blank"
                   download>
                  Скачать
                </a>
                <a class="ui mini yellow button"
                   onclick="confirmDeletion('destroy-media-{{ $media->id }}-form', '{{ $media->name }}');">
                  Удалить
                </a>
                <form action="{{ route('subjects.media.destroy', [$subject, $media]) }}"
                      id="destroy-media-{{ $media->id }}-form"
                      method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
              </div>

              {{-- File meta data --}}
              <div class="right floated content">
                <div class="subject-file-meta">
                  {{ $media->created_at->format('d.m.y') }}
                </div>
              </div>

              <div class="right floated content">
                <div class="subject-file-meta">
                  {{ $media->human_readable_size }}
                </div>
              </div>
              <div class="right floated content">
                <div class="subject-file-meta">
                  {{ $media->collection_name }}
                </div>
              </div>


              {{-- File icon --}}
              @php
                  $file_icon_path = "images/file-icons/{$media->extension}.svg";
              @endphp

              @if (file_exists($file_icon_path))
                  <img class="ui image subject-file-icon" src="{{ asset($file_icon_path) }}">
              @else
                  <img class="ui image subject-file-icon" src="/images/file-icons/file.svg">
              @endif

              {{-- File name --}}
              <div class="content">
                <a href="{{ $media->getUrl() }}"
                   class="subject-file-name"
                   title="Нажмите для просмотра"
                   target="_blank">

                  {{ str_limit($media->name, 60) }}
                </a>
              </div>
            </div>
          @endforeach
        </div>
    </div>
</div>
