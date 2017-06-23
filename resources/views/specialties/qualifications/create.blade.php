@extends ('layouts.app')

@section ('title')
    {{ $specialty->title }} - привязка квалификаций
@endsection

@section ('content')
    <div class="ui text container" style="margin-bottom: 30px;">
        <div style="margin-bottom: 45px; text-align: center;">
            <h2>Привязка квалификаций к специальности <br><a href="{{ route('specialties.show', $specialty) }}" target="_blank">{{ $specialty->title }}</a></h2>
        </div>

        <form action="{{ route('specialties.qualifications.index', $specialty) }}" method="post">
            {{ csrf_field() }}

            <div class="ui form" style="position: relative; margin-bottom: 33px;">
                <select name="qualifications[]" class="ui fluid search dropdown" multiple="">
                    <option value="">Квалификации</option>
                    @foreach ($qualifications as $qualification)
                        <option value="{{ $qualification->id }}">{{ $qualification->title }}</option>
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
    @include ('includes/_multiple-search-dropdown-script', ['allowAdditions' => false])
@endsection
