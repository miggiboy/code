<div class="ui vertical segment">
  @if ($college->reception)
    <h3 class="header">Приемная коммиссия</h3>

    <article>
      {!! $college->reception->info !!}
    </article>
    <br>

    <div class="ui grid">
      @if (isset($college->reception->phone) || isset($college->reception->phone_2))
        <div class="six wide column">
              <h5 class="ui header">Телефон(-ы) приемной ком. </h5>
              @if (isset($college->reception->phone))
                  <div class="content">{{ $college->reception->phone }}</div>
              @endif
              @if (isset($college->reception->phone_2))
                  <div class="content">{{ $college->reception->phone_2 }}</div>
              @endif
        </div>
      @endif

      @if ($college->call_center)
          <div class="four wide column">
              <h5 class="ui header">Основн. телефон</h5>
              <div class="content">
                  {{ $college->call_center }}
              </div>
          </div>
      @else

          <div class="four wide column">
              <h5 class="ui header">Основн. телефон</h5>
              <div class="content">
                  Нет
              </div>
          </div>

      @endif

      @if (isset($college->reception->email))
          <div class="six wide column">
              <h5 class="ui header">Почта приемной ком.</h5>
              <div class="content">{{ $college->reception->email }}</div>
          </div>
      @endif

      @if ($college->address)
            <div class="six wide column">
                <h5 class="ui header">Адрес колледжа </h5>
                <div class="content">{{ $college->address }}</div>
            </div>
      @endif

      @if (isset($college->reception->address))
          <div class="six wide column">
              <h5 class="ui header">Адрес приемной ком. </h5>
              <div class="content">{{ $college->reception->address }}</div>
          </div>
      @endif

    </div>
  @endif
</div>
