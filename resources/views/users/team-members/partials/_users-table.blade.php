<table class="ui celled table" style="margin-bottom: 25px;">
  <thead>
    <tr>
      <th style="width: 680px;">{{ $table_heading . ': ' . $users->count() }}</th>
      <th>Регистрация</th>
      <th>Действия</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
      <tr>
        <td>
          <h4 class="ui image header">
            <img src="{{ $user->avatar_path }}" class="ui mini rounded image">
            <div class="content">
              {{ $user->getNameOrUsername() }}
              @if ($user->isNotActive())
                  <span style="color: red">Деактивированный аккаунт</span>
              @endif
              <div class="sub header">
              @foreach ($user->roles as $role)
                  {{ $role->display_name . ($loop->last ? '' : ', ') }}
              @endforeach
            </div>
          </div>
        </h4>
        </td>
        <td class="collapsing">
          {{ $user->created_at->diffForHumans() }}
        </td>
        <td class="collapsing">
          @include ('users/team-members/partials/_options')
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
