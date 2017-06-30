@if (count($articles))
  <div class="ui large celled very relaxed selection list">
    @foreach ($articles as $article)
          <div class="custom item">
            @include ('articles/partials/_options')
            <i class="teal travel icon"></i>
            <div class="content">
              <a class="header" href="{{ route('articles.show', $article) }}">
                {{ $article->title }}
              </a>
              <br>
              {{ $article->short_description }}
            </div>
          </div>
    @endforeach
    </div>
@endif
<br>
