<div class="ui vertical segment">

  <article>
    {!! $institution->description !!}

    @if ($institution->extra_description)
        <h3>Дополнительное описание</h3>
        {!! $institution->extra_description !!}
    @endif
  </article>

  <br>
  <div class="ui grid">

    @if ($institution->abbreviation)
        <div class="four wide column">
          <h5 class="ui header">Аббревиатура(-ы):
            <div class="sub header">{{ $institution->abbreviation }}</div>
          </h5>
        </div>
    @endif

    <div class="four wide column">
      <h5 class="ui header">Город:
        <div class="sub header">
          <a href="{{ route('institutions.index', [$institutionType, 'city' => $institution->city->id]) }}"
             title="Уч. заведения в {{ $institution->city->title }}"
             class="custom-link">
                {{ $institution->city->title }}
          </a>
        </div>
      </h5>
    </div>

    @isset($institution->has_dormitory)
      <div class="four wide column">
          <h5 class="ui header">Общежитие:
              @if ($institution->has_dormitory == true)
                  <div class="sub header">Есть</div>
              @else
                  <div class="sub header">Нет</div>
              @endif
          </h5>
        </div>
    @endisset

    @isset($institution->has_military_dep)
      <div class="four wide column">
          <h5 class="ui header">Военная каф:
              @if ($institution->has_military_dep == true)
                  <div class="sub header">Есть</div>
              @else
                  <div class="sub header">Нет</div>
              @endif
          </h5>
        </div>
    @endisset

    @if ($institution->foundation_year)
        <div class="four wide column">
          <h5 class="ui header">Год основания:
            <div class="sub header">{{ $institution->foundation_year }}</div>
          </h5>
        </div>
    @endif

    @if ($institution->phone_number)
        <div class="four wide column">
            <h5 class="ui header">Основн. телефон:
              <div class="sub header">
                  {{ $institution->phone_number }}
              </div>
            </h5>
        </div>
    @endif

    @if ($institution->web_site_url)
        <div class="four wide column">
          <h5 class="ui header">Веб сайт:
            <div class="sub header">
              <a href="{{ $institution->web_site_url }}" target="_blank" class="custom-link">
                {{ $institution->getBaseUrl() }}
              </a>
            </div>
          </h5>
        </div>
    @endif

  </div>
</div>
