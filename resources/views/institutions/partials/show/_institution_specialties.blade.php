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
            @if ($fullTimeSpecialtiesCount = $institution->specialties()->atForm('full-time')->count())
              <a href="{{ route('institutions.specialties.edit', [$institution, 'full-time']) }}"   class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('institutions.specialties.create', [$institution, 'full-time']) }}"   class="item">
            <i class="circle green add icon"></i>Добавить</a>

          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('institutions.specialties.index', [$institution, 'full-time']) }}"
             class="header">Очная форма ({{ $fullTimeSpecialtiesCount }})</a>
        </div>
      </div>

      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($extramuralSpecialtiesCount = $institution->specialties()->atForm('extramural')->count())
              <a href="{{ route('institutions.specialties.edit', [$institution, 'extramural']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('institutions.specialties.create', [$institution, 'extramural']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>
          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('institutions.specialties.index', [$institution, 'extramural']) }}"
          class="header">Заочная форма ({{ $extramuralSpecialtiesCount }})</a>
        </div>
      </div>
    </div>

</div>
