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
            @if ($fullTimeSpecialtiesCount = $university->specialities()->fullTime()->count())
              <a href="{{ route('university.specialties.edit', [$university, 'full-time']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('university.specialties.create', [$university, 'full-time']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>

          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('university.specialties', [$university, 'full-time']) }}"
          class="header">Очная форма ({{ $fullTimeSpecialtiesCount }})</a>
        </div>
      </div>

      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($extramuralSpecialtiesCount = $university->specialities()->extramural()->count())
              <a href="{{ route('university.specialties.edit', [$university, 'extramural']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('university.specialties.create', [$university, 'extramural']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>
          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('university.specialities', [$university, 'extramural']) }}"
          class="header">Заочная форма ({{ $extramuralSpecialtiesCount }})</a>
        </div>
      </div>
    </div>

</div>
