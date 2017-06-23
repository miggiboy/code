@extends('layouts.master')

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
          </div>
        </div>
        @endforeach
    </div>
  </div>
</div>
@endsection

