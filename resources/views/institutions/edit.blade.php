@extends ('layouts.master')

@section ('title', 'Редактирование вуза')

@section ('subnavigation')
    @include ('institutions.partials.navigation', ['pageTitle' => 'Редактирование вуза'])
@endsection

@section ('content')
    @include ('includes.ckeditor')
    <br><br>

    <form action="{{ route('institutions.update', [request()->route('institutionType'), $institution]) }}"
          method="post"
          class="ui form">

      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      @include ('includes.form-errors')

      <div class="ui horizontal divider">
          <i class="teal university icon"></i> Основная информация
      </div>
      <br>

      @include ('institutions/partials/create/_' . request()->route('institutionType') . '-general-fields')

      @include ('institutions/partials/create/_reception_committee_fields')

      <div class="inline field">
            <div class="ui toggle checkbox">
                <input type="checkbox" tabindex="0" class="hidden" name="add_specialities">
                <label>Добавить специальности после сохранения</label>
            </div>
      </div>
      <br>

    <button class="ui big teal button" type="submit" id="form-submit-button">Сохранить</button>
    </form>
    <br><br>
@endsection

@section('script')
  @include ('institutions/partials/_ckeditor-config')
@endsection
