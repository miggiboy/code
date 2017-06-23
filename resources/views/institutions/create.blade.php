@extends ('layouts.master')

@section ('title')
  {{ $pageTitle = 'Добавление ' . Translator::get($institutionType, 'r', 's') }}
@endsection

@section ('subnavigation')
    @include ('institutions.partials.navigation', ['pageTitle' => $pageTitle])
@endsection

@section ('content')

    @include ('includes.ckeditor')

    <br><br>
    <form action="{{ route('institutions.store', $institutionType) }}"
          method="post"
          class="ui form">

      {{ csrf_field() }}

      <input type="hidden" name="type" value="{{ str_singular($institutionType) }}">

      @include ('includes.form-errors')

      <div class="ui horizontal divider">
        <i class="teal university icon"></i> Основная информация
      </div>
      <br>

      @include ('institutions/partials/create/_' . $institutionType . '-general-fields')

      @include ('institutions/partials/create/_reception_committee_fields')

      <div class="inline field">
            <div class="ui toggle checkbox">
                <input type="checkbox" tabindex="0" class="hidden" name="add_specialities">
                <label>Добавить специальности после сохранения</label>
            </div>
      </div>
      <br>

      <button class="ui big teal button" type="submit">Сохранить</button>
    </form>
    <br><br>

@endsection

@section('script')
  @include ('institutions/partials/_ckeditor-config')
@endsection
