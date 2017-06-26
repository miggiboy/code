<form action="{{ route('institutions.specialties.store', [$institution, Request::route('studyForm')]) }}"
      method="post">

    {{ csrf_field() }}

    <input type="hidden"
           name="form"
           value='{{ Request::route('studyForm') }}'>

    @php
        $choose_from = request()->choose_from ?? Request::route('studyForm');
    @endphp

    <div class="ui attached info message">
        <i class="idea icon"></i>
        @if ($choose_from == Request::route('studyForm'))
            @if ($choose_from != 'full-time')
                @include (
                    "institutions/specialties/partials/create/_not-full-time-study-form-message"
                )
            @endif
        @else
            @include (
                'institutions/specialties/partials/create/_from-other-study-form-message'
            )
        @endif
    </div>

    <div class="ui attached segment form" style="position: relative; margin-bottom: 25px;">
        <select name="specialties[]"
                class="ui fluid search dropdown"
                multiple>

            <option value="">Специальности</option>
            @foreach ($specialties as $specialty)

                <option value="{{ $specialty->id }}" {{ $institution->specialties->contains($specialty) ? 'selected' : '' }}>
                    {{ "{$specialty->title} {$specialty->code}" }}
                </option>

            @endforeach
        </select>
    </div>

    <div class="thirteen wide column">
        <button class="ui large teal button" type="submit">
            Сохранить
        </button>
    </div>

</form>
