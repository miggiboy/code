@extends('layouts.app')

@section('title', 'Стена')

@section('content')
  <div class="ui grid">
    <div class="nine wide column">
      <form action="{{ route('messages.store') }}"
            method="post"
            class="ui form"
            style="margin-bottom: 40px;">

          {{ csrf_field() }}

          <div class="fourteen wide field">
            <label for="text">Сообщение</label>
            <textarea rows="2" name="text" id="text" id="text" autofocus></textarea>
          </div>
          <button type="submit"
                  class="ui tiny basic button">
            <i class="blue send icon"></i> Отправить
          </button>
        </form>


        <div class="ui huge feed" id="feed">

        @foreach ($messages as $message)
        <div class="event" style="margin-bottom: 15px;">
          <div class="label">
            <img src="{{ $message->user->identicon }}" alt="identicon">
          </div>
          <div class="content">
            <div class="summary">
              <a>{{ $message->user->getNameOrUserName() }}</a>
              <div class="date">
                {{ $message->created_at->diffForHumans() }}
              </div>
            </div>
            <div class="extra text">
              {{ $message->text }}
            </div>

            @if (Auth::user()->owns($message))
              <div class="meta">
                <a class="like"
                   title="Удалить сообщение"
                   onclick="confirmDeletion('delete-message-{{ $message->id }}', 'сообщение');">
                  Удалить
                </a>
              </div>
            @endif

            <form action="{{ route('messages.destroy') }}" method="post" id="delete-message-{{ $message->id }}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="hidden" name="message" value="{{ $message->id }}">
            </form>

          </div>
        </div>
        @endforeach
    </div>
  </div>
</div>
<br>
{{ $messages->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}}
<br><br>
@endsection

