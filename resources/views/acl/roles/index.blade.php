@extends ('layouts.master')

@section ('title', 'Администрирование')

@section ('subnavigation')
    @include ('acl.roles.partials.navigation', ['pageTitle' => 'Роли'])
@endsection

@section ('content')
<div class="ui cards">
    @foreach ($roles as $role)
        <div class="ui card">
      <div class="image">
        <img src="/images/avatar/nan.jpg">
      </div>
      <div class="content">
        <a class="header">{{ $role->display_name }}</a>
        <div class="meta">
          <span class="date">Joined in 2013</span>
        </div>
        <div class="description">
          Kristy is an art director living in New York.
        </div>
      </div>
      <div class="extra content">
        <a>
          <i class="user icon"></i>
          22 Friends
        </a>
      </div>
    </div>
    @endforeach
</div>
@endsection