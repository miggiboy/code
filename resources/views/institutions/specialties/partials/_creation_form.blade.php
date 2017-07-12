<form action="{{ route("institutions.{$related}.store", [$institution, Request::route('studyForm')]) }}"
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
                <a href="?choose_from=full-time">Выбрать из {{ Translator::get($related, 'r', 'p') }} очной формы</a>
            @endif
        @else
            Вы выбираете из {{ Translator::get($related, 'r', 'p') }} очной формы.
            <a href="{{ route('institutions.specialties.create', [$institution, Request::route('studyForm')]) }}">
                Вернуться назад
            </a>
        @endif
    </div>

    <div class="ui attached segment form" style="position: relative; margin-bottom: 25px;">
        <select name="specialties[]"
                class="ui fluid search dropdown"
                multiple>

            <option value="">{{ Translator::get($related, 'i', 'p', true) }}</option>
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
