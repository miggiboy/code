@extends ('layouts.master')

@section ('title')
    {{ $profession->title }} - привязка специальностей
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 30px;">
        <div style="margin-bottom: 45px; text-align: center;">
            <h2>Привязка специальностей к профессии <br><a href="{{ route('profession.show', $profession) }}" target="_blank">{{ $profession->title }}</a></h2>
        </div>

        <form action="{{ route('profession.specialties.store', $profession) }}" method="post">
            {{ csrf_field() }}

            <div class="ui form" style="position: relative; margin-bottom: 33px;">
                <select name="specialties[]" class="ui fluid search dropdown" multiple="">
                    <option value="">Специальности</option>
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}"
                        {{ $profession->specialities->contains($specialty) ? 'selected' : '' }}>
                            {{ $specialty->getNameWithCodeOrName() }}
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

@section ('script')
    @include ('includes/_multiple-selection-dropdown-script', ['allowAdditions' => false])
@endsection
