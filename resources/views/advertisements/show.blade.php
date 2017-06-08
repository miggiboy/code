@extends ('layouts.master')


@section ('title')
    {{ $advertisement->description }}
@endsection


@section ('content')
    <div class="ui grid">
        <div class="row">
            <div class="column">
                <div class="ui header">{{ $advertisement->description }}</div>
            </div>
        </div>

        <div class="row">
            @if ($advertisement->getMedia('images'))
                @foreach ($advertisement->getMedia('images') as $image)
                    <a href="http://google.com" class="ui medium image">
                      <img src="/images/wireframe/image-text.png">
                    </a>
                @endforeach
            @else
                Рекламные изображения не загружены!
            @endif
        </div>

        <div class="row">
            <div class="column">
                @if ($image = $advertisement->getMedia('screenshot')->first())
                    <label for="">Скриншот рекламного блока на странице</label>
                    <img src="{{ $image->getUrl() }}" alt="" class="ui large image">
                @else
                    Скриншот рекламного блока на странице отсутствует!
                @endif
            </div>
        </div>

        <div class="field">
            <label for="url">Рекламная ссылка </label>
            <input type="text" name="" value="{{ $advertisement->url }}" id="">
        </div>
    </div>
@endsection
