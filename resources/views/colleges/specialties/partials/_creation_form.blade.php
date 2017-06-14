<form action="{{ route('college.specialties', [$college, $studyForm]) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="form" value='{{ request('form') }}'>
    <input type="hidden" name="category" value='{{ request('category') }}'>

    <div class="ui form" style="position: relative; margin-bottom: 25px;">
        <select name="specialties[]" class="ui fluid search dropdown" multiple="">
            <option value="">Специальности</option>
            @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}"
                {{ $college->specialities->contains($specialty) ? 'selected' : '' }}>
                    {{ "{$specialty->title} {$specialty->code}" }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="thirteen wide column">
        <button class="ui large teal button" type="submit">Сохранить</button>
    </div>

</form>
