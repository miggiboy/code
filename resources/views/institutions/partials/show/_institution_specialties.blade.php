<div class="ui segment">
    <div class="ui grid">
      <div class="eleven wide column">
        <h2 class="ui header">Специальности</h2><br>
      </div>
    </div>

    <div class="ui very relaxed divided list">

      @foreach (['full-time', 'extramural', 'distant'] as $form)
          <div class="item">
            <div class="ui pointing right floated icon dropdown small basic button content">
              <i class="ellipsis vertical icon"></i>
              <div class="menu">
                <div class="header"><i class="tags icon"></i>  Опции </div>
                <div class="divider"></div>

                @php
                    $count = $institution->specialties()->atForm($form)->count();
                @endphp

                <a href="{{ route('institutions.specialties.create', [$institution, $form]) }}"   class="item">
                  <i class="circle blue icon"></i> {{ $count ? 'Редактировать список' : 'Добавить' }}
                </a>

                @if ($count)
                  <a href="{{ route('institutions.specialties.edit', [$institution, $form]) }}"   class="item">
                    <i class="circle green icon"></i> Задать цены, сроки
                  </a>
                @endif

              </div>
            </div>

            <i class="large teal student middle aligned icon"></i>
            <div class="content">
              <a href="{{ route('institutions.specialties.index', [$institution, $form]) }}" class="header">
                 {{ Translator::get($form, 'i', 's', true) }} ({{ $count }})
              </a>
            </div>
          </div>
      @endforeach
  </div>
</div>
