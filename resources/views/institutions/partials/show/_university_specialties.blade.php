<div class="ui segment">
    <div class="ui grid">
      <div class="eleven wide column">
        <h2 class="ui header">Специальности</h2><br>
      </div>
    </div>

    <div class="ui very relaxed divided list">

      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($fullTimeSpecialtiesCount = $institution->specialities()->fullTime()->count())
              <a href="{{ route('university.specialties.edit', [request()->route('type'), $institution, 'full-time']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('university.specialties.create', [request()->route('type'), $institution, 'full-time']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>

          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('university.specialties', [request()->route('type'), $institution, 'full-time']) }}"
          class="header">Очная форма ({{ $fullTimeSpecialtiesCount }})</a>
        </div>
      </div>

      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($extramuralSpecialtiesCount = $institution->specialities()->extramural()->count())
              <a href="{{ route('university.specialties.edit', [request()->route('type'), $institution, 'extramural']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('university.specialties.create', [request()->route('type'), $institution, 'extramural']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>
          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('university.specialities', [request()->route('type'), $institution, 'extramural']) }}"
          class="header">Заочная форма ({{ $extramuralSpecialtiesCount }})</a>
        </div>
      </div>
    </div>

</div>
