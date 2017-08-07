<div style="width: 320px; position: absolute; right: 55px; top: 230px;">
  <div class="ui piled segment" style="min-height: 200px;"> {{-- 'Related' segment --}}
    <h3 class="ui header" style="margin-bottom: 30px;">Связанные специальности</h3>

    <a href="{{ route('professions.specialties.create', $profession) }}"
    style="position: absolute; top: 10px; right: 15px;" title="Прикрепить / открепить специальности">
      <i class="circular plus icon link"></i>
    </a>

    <div class="ui very relaxed divided list">

      @if ($profession->specialties->count())
        @foreach ($profession->specialties as $specialty)
          <div class="item">

            <div class="ui right pointing right floated icon dropdown small basic button content">
              <i class="ellipsis vertical icon"></i>
              <div class="menu">
                <div class="header"><i class="tags icon"></i>  Опции </div>
                <div class="divider"></div>
                <a href="#" class="item"
                    onclick="event.preventDefault();
                    document.getElementById('profession-detach-specialty-{{ $specialty->id }}-form').submit();">
                  <i class="circle red delete icon"></i>Открепить
                </a>
              </div>
            </div>

            <i class="small teal student middle aligned icon"></i>
            <div class="content">
              <a href="{{ route('specialties.show', [$specialty->institution_type, $specialty]) }}"
                 class="header"
                 title="{{ $specialty->title }}">
                {{ str_limit($specialty->title, 25) }}
              </a>
            </div>

            <form action="{{ route('professions.specialties.destroy', [$profession, $specialty]) }}"
                method="post" id="profession-detach-specialty-{{ $specialty->id }}-form">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            </form>

          </div>
        @endforeach
      @else
        <div style="text-align: center;">
          <p>Тут пусто</p>
          <a href="{{ route('professions.specialties.create', $profession) }}" class="ui primary button">Добавить </a>
        </div>
      @endif
    </div>
  </div>
</div>
