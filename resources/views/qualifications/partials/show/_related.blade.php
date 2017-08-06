<div class="ui segment">
  <div class="eleven wide column">
    <h2 class="ui header" style="margin-bottom: 33px;">Связанные</h2>
  </div>

  <div class="ui relaxed list">
    <div class="item">
      <i class="small teal university middle aligned icon"></i>
      <div class="content">
      <a href="{{ route('qualifications.colleges.index', $qualification) }}"
         class="header">
        Колледжи ({{ count($qualification->institutions_distinct) }})
      </a>
      </div>
    </div>
  </div>
</div>
<br>
