<div class="ui vertical segment">
  @if ($institution->reception)
    <h3 class="header">Приемная коммиссия</h3>
    <article>
      {!! $institution->reception->info !!}
    </article>
    <br>

    <div class="ui grid">
      @if (isset($institution->reception->phone) || isset($institution->reception->phone_2))
        <div class="six wide column">
              <h5 class="ui header">Телефон(-ы) приемной ком. </h5>
              @if (isset($institution->reception->phone))
                  <div class="content">{{ $institution->reception->phone }}</div>
              @endif
              @if (isset($institution->reception->phone_2))
                  <div class="content">{{ $institution->reception->phone_2 }}</div>
              @endif
        </div>
      @endif

      @isset($institution->reception->email)
          <div class="five wide column">
              <h5 class="ui header">Почта приемной ком.</h5>
              <div class="content">{{ $institution->reception->email }}</div>
          </div>
      @endisset

      @if ($institution->address)
            <div class="five wide column">
                <h5 class="ui header">Адрес университета </h5>
                <div class="content">
                    {{ $institution->address }}
                </div>
            </div>
      @endif

      @isset($institution->reception->address)
          <div class="five wide column">
              <h5 class="ui header">Адрес приемной ком. </h5>
              <div class="content">{{ $institution->reception->address }}</div>
          </div>
      @endisset

    </div>
  @endif
</div>
