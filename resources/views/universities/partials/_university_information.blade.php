<div class="ui vertical segment">

  <article>
    {!! $university->description !!}
  </article>

  <br>
  <div class="ui grid">

    @if ($university->acronym)
        <div class="four wide column">
          <h5 class="ui header">Известен как:
            <div class="sub header">{{ $university->acronym }}</div>
          </h5>
        </div>
    @endif

    <div class="four wide column">
      <h5 class="ui header">Город:
        <div class="sub header">{{ $university->city->title }}</div>
      </h5>
    </div>

    @if (isset($university->has_dormitory))
      <div class="four wide column">
          <h5 class="ui header">Общежитие:
              @if ($university->has_dormitory == true)
                  <div class="sub header">Есть</div>
              @else
                  <div class="sub header">Нет</div>
              @endif
          </h5>
        </div>
    @endif

    @if (isset($university->has_military_dep))
      <div class="four wide column">
          <h5 class="ui header">Военная каф:
              @if ($university->has_military_dep == true)
                  <div class="sub header">Есть</div>
              @else
                  <div class="sub header">Нет</div>
              @endif
          </h5>
        </div>
    @endif

    @if ($university->foundation_year)
        <div class="four wide column">
          <h5 class="ui header">Год основания:
            <div class="sub header">{{ $university->foundation_year }}</div>
          </h5>
        </div>
    @endif

    @if ($university->call_center)
        <div class="four wide column">
            <h5 class="ui header">Основн. телефон
              <div class="sub header">
                  {{ $university->call_center }}
              </div>
            </h5>
        </div>
    @endif

    @if ($university->web_site)
        <div class="four wide column">
          <h5 class="ui header">Веб сайт:
            <div class="sub header">
              <a href="{{ $university->web_site }}" target="_blank">
                {{ $university->getBaseUrl() }}
              </a>
            </div>
          </h5>
        </div>
    @endif

  </div>
</div>
