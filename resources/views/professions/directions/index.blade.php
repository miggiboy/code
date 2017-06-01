@extends ('layouts.master')

@section ('title', 'Проф-направления')

@section ('subnavigation')
    @include ('professions.partials.navigation', ['pageTitle' => 'Проф-направления'])
@endsection


@section ('content')

  @include ('layouts.form-errors')

  <form action="{{ route('prof-directions') }}" method="POST" class="ui form">
    
    {{ csrf_field() }}

    <div class="fields">
      <div class="eight wide field">
        <label>Название направления</label>
        <div class="ui left icon action input">
          <input type="text" name="title" placeholder="Название направления">
          <i class="marker icon"></i>
          <button class="ui teal right labeled icon button"><i class="checkmark icon"></i>
            Добавить 
           </button>
        </div>
      </div>
    </div>
    
  </form> 

  <br>

  @if (count($directions))
    <div class="ui items">
      @foreach ($directions as $profDirection)
        <div class="item">
          <div class="ui small image">
            <img src="/images/wireframe/image.png">
          </div>
          <div class="content">
            <div class="header">{{ $profDirection->title }}</div>
            <div class="meta">
              <span class="price">$1600</span>
              <span class="stay">6 Weeks</span>
            </div>
            <div class="description">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum accusamus magni blanditiis reiciendis, libero debitis laudantium illum placeat ipsa deserunt hic similique, eaque! Quam necessitatibus, impedit, neque distinctio est voluptatum!</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    @else
      <div class="ui segment">
        Проф-направления еще не добавлены
      </div>
    @endif
@endsection