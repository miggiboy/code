@extends ('layouts.app')

@section ('title')
    {{ $specialty->title }} - квалификации
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 30px;">
        <div style="margin-bottom: 45px; text-align: center;">
            <h2>Квалификаций специальности <br>
                <a href="{{ route('specialties.show', [$specialty->institution_type, $specialty]) }}"
                   target="_blank"
                   class="custom-link">
                    {{ $specialty->getNameWithCodeOrName() }}
                </a>
            </h2>
        </div>

        <form action="{{ route('specialties.qualifications.store', $specialty) }}" method="post">
            {{ csrf_field() }}

            <div class="ui form" style="position: relative; margin-bottom: 33px;">
                <select name="qualifications[]" class="ui fluid search dropdown" multiple="">
                    <option value="">Квалификации</option>
                    @foreach ($qualifications as $qualification)
                        <option value="{{ $qualification->id }}"
                                {{ $specialty->qualifications->contains($qualification) ? 'selected' : '' }}>
                            {{ $qualification->getNameWithCodeOrName() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="direction_id" value="404">

            <div class="thirteen wide column">
                <button class="ui large teal button" type="submit">Сохранить</button>
            </div>

        </form>

        @include ('shared/_temp-notification')
    </div>
@endsection
