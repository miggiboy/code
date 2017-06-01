@extends ('layouts.master')

@section ('title', 'Role')


@section ('subnavigation')
    @include('roles.partials.navigation')
@endsection

@section ('content')
    <div class="col-lg-10">
      <br>
        <div class="panel panel-primary">
        <div class="panel-heading">
          <h3>
              {{ $role->display_name}}
          </h3>
        </div>
          <div class="panel-body">
            @if ($role->perms)
              <h4>Permissions:</h4>
              <h3>
                  @foreach ($role->perms as $permission)
                      {{ $permission->display_name . ' | ' }}
                  @endforeach
              </h3>
            @endif
            </div>
        </div>
    </div>
@endsection
