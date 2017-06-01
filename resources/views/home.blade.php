@extends('layouts.master')

@section('title', 'Стена')

@section('content')
  <div class="ui grid">
    <div class="nine wide column">
      <form action="{{ route('feed') }}"
            method="post"
            class="ui form"
            style="margin-bottom: 40px;">

          {{ csrf_field() }}
          <div class="fourteen wide field">
            <label for="body">Сообщение</label>
            <textarea rows="2" name="body" id="body" id="body" autofocus></textarea>
          </div>
          <button type="submit" class="ui tiny basic button" onclick="event.preventDefault(); sendMessage();">
            <i class="blue send icon"></i> Отправить
          </button>
        </form>


        <div class="ui huge feed" id="feed">

        @foreach ($news as $newsInstance)
        <div class="event" style="margin-bottom: 15px;">
          <div class="label">
            <img src="{{ $newsInstance->user->identicon }}" alt="identicon">
          </div>
          <div class="content">
            <div class="summary">
              <a>{{ $newsInstance->user->getNameOrUserName() }}</a>
              <div class="date">
                {{ $newsInstance->created_at->diffForHumans() }}
              </div>
            </div>
            <div class="extra text">
              {{ $newsInstance->body }}
            </div>
            {{-- @if (auth()->user()->owns($newsInstance))
              <div class="meta">
                <a href = "{{ route('news.destroy', $newsInstance) }}" class="like">
                  Удалить
                </a>
              </div>
            @endif --}}
          </div>
        </div>
        @endforeach
    </div>
        </div>

      </div>
@endsection

