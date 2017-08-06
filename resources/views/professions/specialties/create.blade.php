@extends ('layouts.app')

@section ('title')
    {{ $profession->title }} - привязка специальностей
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 30px;">
        <div style="margin-bottom: 45px; text-align: center;">
            <h2>Специальности профессии <br>
                <a href="{{ route('professions.show', $profession) }}" target="_blank" class="custom-link">
                    {{ $profession->title }}
                </a>
            </h2>
        </div>

        <form action="{{ route('professions.specialties.store', $profession) }}" method="post">
            {{ csrf_field() }}

            <div class="ui form" style="position: relative; margin-bottom: 33px;">
                <select name="specialties[]" class="ui fluid search dropdown" multiple="">
                    <option value="">Название или код специальности...</option>
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}"
                        {{ $profession->specialties->contains($specialty) ? 'selected' : '' }}>
                            {{ $specialty->getNameWithCodeOrName() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="thirteen wide column">
                <button class="ui large teal button" type="submit">Сохранить</button>
            </div>

        </form>

        @include ('shared/_temp-notification')
    </div>
@endsection
