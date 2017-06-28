<div class="ui segment">
  <div class="eleven wide column"><h2 class="ui header" style="margin-bottom: 33px;">Связанные</h2></div>

  <div class="ui relaxed list">

    <div class="item">

      <div class="ui right pointing right floated icon dropdown small basic button content">
        <i class="ellipsis vertical icon"></i>
        <div class="menu">
          <div class="header"><i class="tags icon"></i>  Опции </div>
          <div class="divider"></div>
          <a href="{{ route('specialties.professions.create', $specialty) }}" class="item">
            <i class="circle green add icon"></i>Добавить</a>
        </div>
      </div>

      <i class="small teal travel middle aligned icon"></i>
      <div class="content">
      <a href="{{ route('specialties.professions.index', $specialty) }}"
        class="header">Профессии ({{ count($specialty->professions) }})</a>
      </div>
    </div>


    <div class="item">

      <i class="small teal university middle aligned icon"></i>
      <div class="content">
      <a href="{{ route('specialties.institutions.index', $specialty) }}"
        class="header">
          {{ Translator::get($institutionType, 'i', 'p', true) }} ({{ count($specialty->institutions_distinct) }})
      </a>
      </div>
    </div>


  </div>

</div>
<br>
