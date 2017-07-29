@extends ('layouts.app')

@section ('title')
  {{ $heading = 'Редактирование ' . translate($institutionType, 'r', 's') }}
@endsection

@section ('subnavigation')
    @include ('institutions/partials/_navigation', ['heading' => $heading])
@endsection

@section ('head')
  <style>
      .overlay {
          position: fixed;
          bottom: 42px;
          right: 30px;
          z-index: 10;
      }
  </style>
@endsection

@section ('content')
    @include ('includes/_ckeditor')
    <br><br>

    <form action="{{ route('institutions.update', [$institutionType, $institution]) }}"
          method="post"
          class="ui form"
          id="edit-institution-form">

      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      <input type="hidden" name="type" value="{{ $institution->type }}">

      @include ('includes/_form-errors')

      <div class="ui horizontal divider">
          <i class="teal university icon"></i> Основная информация
      </div>
      <br>

      @include ('institutions/partials/edit/_general-fields')

      @include ('institutions/partials/edit/_reception_committee_fields')
      <button class="ui big teal button" type="submit" id="form-submit-button">Сохранить</button>
    </form>

    <br>
    <br>

    @include ('institutions/partials/edit/_overlay-menu')
@endsection

@section('script')
  @include ('institutions/partials/_ckeditor-config')
@endsection
