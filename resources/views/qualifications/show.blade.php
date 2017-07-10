@extends ('layouts.app')

@section ('title')
  {{ $qualification->title }}
@endsection

@section ('subnavigation')
  @component ('qualifications/partials/_navigation')
    @slot ('custom_heading_layout')
        <div class="nine wide column">
            <div class="ui grid">
                <div class="fifteen wide column">
                    <h1>{{ $qualification->title }}</h1>
                </div>
                <div class="one wide column">
                    @include ('qualifications/partials/_options')
                </div>
            </div>
        </div>
    @endslot
  @endcomponent
@endsection

@section ('content')
  <div class="ui very relaxed grid">
    <div class="ten wide column">

      @include ('markers/partials/_markers-label', [
          'model' => $qualification
      ])

      <div><br></div>
      @include ('qualifications/partials/show/_qualification-information')
    </div>
    <div class="one wide column"></div>
    <div class="five wide column">
      @include ('qualifications/partials/show/_related')
    </div>
</div>
@endsection
