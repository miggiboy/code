<div class="ui grid">
    <div class="column">
        <div class="ui very relaxed middle aligned selection list" id="subject-media-list">
          @foreach ($subject->media as $media)
            <div class="item">

              <div class="right floated content">
                <a href="{{ $media->getUrl() }}"
                   class="ui mini green button"
                   target="_blank"
                   download>
                  Скачать
                </a>
                <a href="#" class="ui mini yellow button"
                   onclick="event.preventDefault();
                   document.getElementById('destroy-media-{{ $media->id }}-form').submit();">
                  Удалить
                </a>
                <form action="{{ route('subjects.media.destroy', [$subject, $media]) }}"
                      id="destroy-media-{{ $media->id }}-form"
                      method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
              </div>
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
              <img class="ui image" src="/images/file-icons/exe.svg" style="width: 37px; height: 37px;">
              <div class="content">
                <a href="" class="subject-file-name" title="{{ $media->name }}">
                  {{ str_limit($media->name, 60) }}
                </a>
              </div>
            </div>
          @endforeach
        </div>
    </div>
</div>
