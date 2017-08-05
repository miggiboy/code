<div
  class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Действия </div>
    <div class="divider"></div>

    <div class="item">
      <i class="left teal dropdown icon"></i>
      <span class="text">
        {{ $user->isInTeam() ? 'Изменить' : 'Дать' }} роль
      </span>
      <div class="left menu">
        @foreach ($roles as $role)
          @if ($user->roles->contains($role))
              <a href="#"
                 class="item"
                 onclick="event.preventDefault();
                 document.getElementById('delete-user-{{ $user->id }}-role-{{ $role->id }}').submit();"
                 title="Отозвать роль">
                <i class="red circle icon"></i> {{ $role->display_name }}
              </a>

              <form action="{{ route('users.roles.destroy', [$user, $role]) }}"
                    method="post"
                    id="delete-user-{{ $user->id }}-role-{{ $role->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
          @else
            <a class="item"
                onclick="event.preventDefault();
                document.getElementById('store-user-{{ $user->id }}-role-{{ $role->id }}').submit();"
                title="Дать роль">
                <i class="blue circle icon"></i> {{ $role->display_name }}
              </a>

              <form action="{{ route('users.roles.store', $user) }}"
                    method="post"
                    id="store-user-{{ $user->id }}-role-{{ $role->id }}">
                {{ csrf_field() }}

                <input type="hidden" name="role" value="{{ $role->id }}">
              </form>
          @endif
        @endforeach
      </div>
    </div>

    <div class="divider"></div>

    <a class="item"
       onclick="event.preventDefault();
       document.getElementById('user-{{ $user->id }}-update-active-status').submit()">
      <i class="orange trash icon"></i> {{ $user->is_active ? 'Деактивировать' : 'Активировать' }}
    </a>

    <form action="{{ route('users.active-status.update', $user) }}"
          method="post"
          id="user-{{ $user->id }}-update-active-status">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
    </form>

    <a class="item"
       onclick="confirmDeletion('delete-user-{{ $user->id }}', '{{ $user->getNameOrUsername() }}');">
      <i class="red trash icon"></i> Удалить
    </a>

    <form action="{{ route('users.destroy', $user) }}"
          method="post"
          id="delete-user-{{ $user->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>

  </div>
</div>
