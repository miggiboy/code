@extends ('layouts.app')

@section ('title')
    {{ $specialty->title }} - привязка профессий
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 30px;">
        <div style="margin-bottom: 45px; text-align: center;">
            <h2>Профессий специальности <br>
                <a href="{{ route('specialties.show', [$specialty->institution_type, $specialty]) }}"
                   target="_blank"
                   class="custom-link">
                    {{ $specialty->title }}
                </a>
            </h2>
        </div>

        <form action="{{ route('specialties.professions.index', $specialty) }}" method="post">
            {{ csrf_field() }}

            <div class="ui form" style="position: relative; margin-bottom: 33px;">
                <select name="professions[]" class="ui fluid search dropdown" multiple>
                    <option value="">Профессии</option>
                    @foreach ($professions as $profession)
                        <option value="{{ $profession->id }}"
                                {{ $specialty->professions->contains($profession) ? 'selected' : '' }}>
                            {{ $profession->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="thirteen wide column">
                <button class="ui large teal button" type="submit">Сохранить</button>
            </div>

        </form>
    </div>
@endsection
