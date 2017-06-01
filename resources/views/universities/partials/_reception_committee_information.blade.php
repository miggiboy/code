<div class="ui vertical segment">
  @if ($university->reception)
    <h3 class="header">Приемная коммиссия</h3>
    <article>
      {!! $university->reception->info !!}
    </article>
    <br>

    <div class="ui grid">
      @if (isset($university->reception->phone) || isset($university->reception->phone_2))
        <div class="six wide column">
              <h5 class="ui header">Телефон(-ы) приемной ком. </h5>
              @if (isset($university->reception->phone))
                  <div class="content">{{ $university->reception->phone }}</div>
              @endif
              @if (isset($university->reception->phone_2))
                  <div class="content">{{ $university->reception->phone_2 }}</div>
              @endif
        </div>
      @endif

      @if ($university->call_center)
          <div class="four wide column">
              <h5 class="ui header">Колл-центр </h5>
              <div class="content">
                  {{ $university->call_center }}
              </div>
          </div>
      @endif

      @if (isset($university->reception->email))
          <div class="six wide column">
              <h5 class="ui header">Почта приемной ком.</h5>
              <div class="content">{{ $university->reception->email }}</div>
          </div>
      @endif

      @if ($university->address)
            <div class="six wide column">
                <h5 class="ui header">Адрес университета </h5>
                <div class="content">
                    {{ $university->address }}
                </div>
            </div>
      @endif

      @if (isset($university->reception->address))
          <div class="six wide column">
              <h5 class="ui header">Адрес приемной ком. </h5>
              <div class="content">{{ $university->reception->address }}</div>
          </div>
      @endif

    </div>
  @endif
</div>
