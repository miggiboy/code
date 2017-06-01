<div class="media">
  <div class="media-left">
    <a href="{{ route('users.show', ['id' => $user->id]) }}">
      <img class="media-object" src="{{ $user->getAvatarUrl() }}" alt="">
    </a>
  </div>
    <div class="media-body">
      <a href="{{ route('users.show', ['id' => $user->id]) }}"><h4 class="media-heading">{{ $user->getNameOrUserName() }}</h4></a>
      @if ($user->location)
          <p>{{ $user->location }}</p>
      @endif
    </div>
</div>