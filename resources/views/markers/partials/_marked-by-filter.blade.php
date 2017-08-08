<div class="ui dropdown" style="margin-top: 5px;">
  <input type="hidden" name="markers_of" value="{{ request('markers_of') }}">
  <i class="teal filter icon"></i> Отметки &nbsp;
  <span class="text"></span>
  <div class="menu">
    <div class="header">
      <i class="teal user icon"></i>
      Чьи отметки показать?
    </div>
    <div class="scrolling menu">
      <div class="item" data-value=" ">
        <i class="grey minus icon"></i> Снять фильтр
      </div>
      @foreach ($team as $member)
        <div class="item {{ request('markers_of') == $member->id ? 'active selected' : '' }}"
             data-value="{{ $member->id }}"
             title="{{ $member->getNameOrUsername() }}">
          <img class="ui avatar image" src="{{ $member->avatar_path }}">
          {{ str_limit($member->getNameOrUsername(), 12) }}
        </div>
      @endforeach
    </div>
  </div>
</div>
