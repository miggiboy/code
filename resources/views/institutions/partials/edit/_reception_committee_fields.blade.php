<div class="ui horizontal divider">
    <i class="teal call icon"></i> Приемная комиссия
</div>
<br>

<div class="fields">

    @php
      $hasReception = $institution->hasReception();
    @endphp

    <div class="four wide field">
        <label for="reception[phone]">Телефон</label>
        <input type="text"
               name="reception[phone]"
               value = "{{ old('reception.phone') ?: ($hasReception ? $institution->reception->phone : '') }}"
               id="reception[phone]"
               placeholder="Телефон приемной ком.">
    </div>

    <div class="four wide field">
        <label for="reception[phone_2]">Доп. телефон</label>
        <input type="text"
               name="reception[phone_2]"
               value = "{{ old('reception.phone_2') ?: ($hasReception ? $institution->reception->phone_2 : '') }}"
               id="reception[phone2]"
               placeholder="Телефон приемной ком.">
    </div>

      <div class="four wide field{{ $errors->has('reception.email') ? ' error' : '' }}">
          <label for="reception[email]">Email</label>
          <input type="email"
                 name="reception[email]"
                 value="{{ old('reception.email') ?: ($hasReception ? $institution->reception->email : '') }}"
                 id="reception[email]"
                 placeholder="Email">
      </div>

    <div class="four wide field{{ $errors->has('reception[address]') ? ' error' : '' }}">
        <label for="reception[address]">Адрес</label>
        <input type="text"
               name="reception[address]"
               value="{{ old('reception.address') ?: ($hasReception ? $institution->reception->address : '') }}"
               id="reception[address]"
               placeholder="Адрес приемной ком.">
    </div>

  </div>

  <div class="field">
    <label for="reception[info]">Информация по приемной комиссии</label>
    <textarea name="reception[info]" id="reception[info]">{!! old('reception.info') ?: ($hasReception ? $institution->reception->info : '') !!}
    </textarea>
 </div>
 <br>
