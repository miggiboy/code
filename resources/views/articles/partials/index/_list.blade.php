@if (count($articles))
  <div class="ui large celled very relaxed selection list">
    @foreach ($articles as $article)
          <div class="custom item">
            @include ('articles/partials/_options')
            <div class="right floated content">
              <div>
                <div>ID:  {{ $article->id }}</div>
                @include ('markers/partials/_in-list-markers', [
                    'model' => $article
                ])
              </div>
            </div>
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
