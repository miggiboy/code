  <div class="ui segment">
    <div class="ui grid">
      <div class="eleven wide column">
        <h2 class="ui header" style="margin-bottom: 12px;">Квалификации</h2>
      </div>
    </div>

    <div class="ui very relaxed divided list">
      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($fullTimeSpecialtiesCount = $college->qualifications()->fullTime()->count())
              <a href="{{ route('college.specialties.edit', [$college, 'full-time', 'category' => 'qualifications']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('college.specialties.create', [$college, 'full-time', 'category' => 'qualifications']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>

          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('college.specialties', [$college, 'full-time', 'category' => 'qualifications']) }}"
          class="header">Очная форма ({{ $fullTimeSpecialtiesCount }})</a>
        </div>
      </div>

      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($extramuralSpecialtiesCount = $college->qualifications()->extramural()->count())
              <a href="{{ route('college.specialties.edit', [$college, 'extramural', 'category' => 'qualifications']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('college.specialties.create', [$college, 'extramural', 'category' => 'qualifications']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>
          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('college.specialties', [$college, 'extramural', 'category' => 'qualifications']) }}"
          class="header">Заочная форма ({{ $extramuralSpecialtiesCount }})</a>
        </div>
      </div>
    </div>

    <br>
    <div class="ui divider"></div>

    <div class="ui grid">
      <div class="eleven wide column">
        <h2 class="ui header" style="margin-bottom: 12px;">Специальности</h2>
      </div>
    </div>

    <div class="ui very relaxed divided list">

      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($fullTimeSpecialtiesCount = $college->specialities()->fullTime()->count())
              <a href="{{ route('college.specialties.edit', [$college, 'full-time']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('college.specialties.create', [$college, 'full-time']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>

          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('college.specialties', [$college, 'full-time']) }}"
          class="header">Очная форма ({{ $fullTimeSpecialtiesCount }})</a>
        </div>
      </div>

      <div class="item">
          <div class="ui right pointing right floated icon dropdown small basic button content">
          <i class="ellipsis vertical icon"></i>
          <div class="menu">
            <div class="header"><i class="tags icon"></i>  Опции </div>
            <div class="divider"></div>
            @if ($extramuralSpecialtiesCount = $college->specialities()->extramural()->count())
              <a href="{{ route('college.specialties.edit', [$college, 'extramural']) }}" class="item">
              <i class="blue edit icon"></i>Задать цены, сроки</a>
            @endif
            <a href="{{ route('college.specialties.create', [$college, 'extramural']) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>
          </div>
        </div>

        <i class="large teal student middle aligned icon"></i>
        <div class="content">
          <a href="{{ route('college.specialties', [$college, 'extramural']) }}"
          class="header">Заочная форма ({{ $extramuralSpecialtiesCount }})</a>
        </div>
      </div>
    </div>

</div>
