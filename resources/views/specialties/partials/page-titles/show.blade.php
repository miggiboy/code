<div class="nine wide column">

    <div class="ui grid">
        <div class="fifteen wide column">
            <h1>@if ($specialty->isQualification()) Квалификация @else Специальность @endif '{{ $specialty->title }}'</h1>
        </div>

        <div class="one wide column">
            @include ('specialties/partials/_options')
        </div>
    </div>
</div>
