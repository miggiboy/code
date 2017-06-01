<div class="ui thirteen column left aligned very relaxed grid" style = "position: relative;">

  <div class="ten wide column">
    <h1>{{ $pageTitle }}</h1>
  </div>

  <div class="four wide column">
    <div class="ui small compact menu">
      <div class="ui dropdown item"><i class="teal browser icon"></i> Роли / Разрешения <i class="dropdown icon"></i>
      <div class="menu">
        <div class="header"><i class="teal tags icon"></i> Роли </div>
        <a href="{{ route('roles') }}" class="item"><i class="circle user icon"></i> Все роли</a>
        <a href="{{ route('roles.create') }}" class="item"><i class="circle add icon"></i> Добавить роль</a>
        <a href="{{ route('roles.assign') }}" class="item"><i class="lightning icon"></i> Дать роль юзеру </a>
        <div class="divider"></div>
        <div class="header"><i class="teal tags icon"></i> Разрешения </div>
        <a href="{{ route('directions') }}" class="item"><i class="unlock icon"></i> Все разрешения</a>
        <a href="{{ route('permissions.create') }}" class="item"><i class="circle add icon"></i> Добавить</a>
      </div>
    </div>
    </div>
  </div>

</div>
<br>
