@extends ('layouts.app')

@section ('title')
  {{ $specialty->title }}
@endsection

@section ('subnavigation')
  @component ('specialties/partials/_navigation', ['institutionType' => Request::route('institutionType')])
    @slot ('custom_heading_layout')
        <div class="nine wide column">
            <div class="ui grid">
                <div class="fifteen wide column">
                    <h1>{{ $specialty->title }}</h1>
                </div>
                <div class="one wide column">
                    @include ('specialties/partials/_options')
                </div>
            </div>
        </div>
    @endslot
  @endcomponent
@endsection

@section ('content')
  <div class="ui very relaxed grid">
    <div class="ten wide column">
      @include ('specialties/partials/show/_labels')
      @include ('specialties/partials/show/_specialty_information')
    </div>
    <div class="one wide column"></div>
    <div class="five wide column">
      @include ('specialties/partials/show/_related')
    </div>
</div>
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
