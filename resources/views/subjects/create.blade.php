@extends ('layouts.app')

@section ('title')
    Добавление предмета
@endsection

@section ('subnavigation')
    @include ('subjects/partials/_navigation', ['heading' => ''])
@endsection

@section ('head')
  <style>
      .centered.header{
        text-align: center;
        margin-top: -30px;
      }
    </style>
@endsection

@section ('content')
    <div class="centered header">
      <h1>Новый предмет</h1>
    </div>
    <div class="ui text container" style="margin-top: 60px;">
      @include ('includes/_form-errors')
      <form action="{{ route('subjects.index') }}" method="post" class="ui big form">
        {{ csrf_field() }}
        <div class="field">
          <input type="text"
                 name="title"
                 id="title"
                 placeholder="Название предмета"
                 autofocus
                 required>
        </div>
        <button type="submit" class="ui big teal button">Сохранить</button>
      </form>
    </div>
@endsection
