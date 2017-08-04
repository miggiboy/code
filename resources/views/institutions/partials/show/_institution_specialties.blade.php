<div class="ui segment">
  @foreach ($institution->specialtyTypes() as $related)
    <h2 class="ui header">{{ translate($related, 'i', 'p', true) }}</h2><br>
    <div class="ui relaxed list">
      @foreach (Specialty::studyForms() as $form)
          <div class="item">
            <div class="ui pointing right floated icon dropdown small basic button content">
              <i class="ellipsis vertical icon"></i>
              <div class="menu">
                <div class="header"><i class="tags icon"></i>  Опции </div>
                <div class="divider"></div>

                @php
                    $count = count($institution->{"{$related}_distinct"}()->atForm($form)->get());
                @endphp

                <a href="{{ route("institutions.{$related}.create", [$institution, $form]) }}"   class="item">
                  <i class="circle blue icon"></i> {{ $count ? 'Редактировать список' : 'Добавить' }}
                </a>

                @if ($count)
                  <a href="{{ route("institutions.{$related}.edit", [$institution, $form]) }}"   class="item">
                    <i class="circle green icon"></i> Задать цены, сроки
                  </a>
                @endif

              </div>
            </div>

            <i class="large teal student middle aligned icon"></i>
            <div class="content">
              <a href="{{ route("institutions.{$related}.index", [$institution, $form]) }}" class="header">
                 {{ translate($form, 'i', 's', true) }} ({{ $count }})
              </a>
            </div>
          </div>
      @endforeach
  </div>
  @endforeach
</div>
