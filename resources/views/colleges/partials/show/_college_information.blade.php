<div class="ui vertical segment">

  <article>
    {!! $college->description !!}

    @if ($college->extra_description)
        <h3>Дополнительное описание</h3>
        {!! $college->extra_description !!}
    @endif
  </article>

  <br>

  <div class="ui grid">

    @if ($college->acronym)
        <div class="four wide column">
          <h5 class="ui header">Известен как:
            <div class="sub header">{{ $college->acronym }}</div>
          </h5>
        </div>
    @endif

    <div class="four wide column">
      <h5 class="ui header">Город:
        <div class="sub header">{{ $college->city->title }}</div>
      </h5>
    </div>

    @if (isset($college->has_dormitory))
      <div class="four wide column">
          <h5 class="ui header">Общежитие:
              @if ($college->has_dormitory == true)
                  <div class="sub header">Есть</div>
              @else
                  <div class="sub header">Нет</div>
              @endif
          </h5>
        </div>
    @endif

    @if ($college->foundation_year)
        <div class="four wide column">
          <h5 class="ui header">Год основания:
            <div class="sub header">{{ $college->foundation_year }}</div>
          </h5>
        </div>
    @endif

    @if ($college->web_site)
        <div class="four wide column">
          <h5 class="ui header">Веб сайт:
            <div class="sub header">
              <a href="{{ $college->web_site }}" target="_blank">
                {{ $college->getBaseUrl() }}
              </a>
            </div>
          </h5>
        </div>
    @endif

  </div>
</div>
