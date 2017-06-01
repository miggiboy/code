@extends ('layouts.master')

@section ('title', 'Города')

@section ('subnavigation')
    @include ('universities.partials.navigation', ['pageTitle' => 'Города'])
@endsection

@section ('content')

    <form action="{{ route('cities') }}" method="POST" class="ui form">
      
      {{ csrf_field() }}

      <div class="fields">
        <div class="eight wide field">

          <label>Название города</label>
          <div class="ui left icon action input">
            <input type="text" name="title" placeholder="Название города">
            <i class="marker icon"></i>
            <button class="ui teal right labeled icon button"><i class="checkmark icon"></i>
              Добавить 
             </button>
          </div>

        </div>

      </div>
      
    </form> 

    <br>

    {{-- <div class="ui cards"> --}}
    <div class="ui relaxed divided list">
    @foreach ($cities as $city)

        <div class="item">
          <div class="right floated content">
            <button class="ui compact icon button">
              <i class="remove icon"></i>
            </button>
          </div>

          <i class="large teal marker middle aligned icon"></i>
          <div class="content">
            <h3 class="header">{{ $city->title }}</h3>
            <div class="description">
              <p>Университетов: {{ count($city->universities) }} / колледжей: {{ count($city->colleges) }}</p>
            </div>
          </div>

        </div>

        <div class="ui basic modal">
          <div class="ui icon header">
            <i class="archive icon"></i>
            Удалить город?
          </div>
          <div class="content">
            <p>Удаляйте города только если с ними не связаны колледжи или униерситеты.</p>
            <p>Иначе сначала измените город у этих университетов/колледжей, а потом удалите город</p>
          </div>
          <div class="actions">
            <div class="ui red basic cancel inverted button">
              <i class="remove icon"></i>
              Удалить
            </div>
            <div class="ui green ok inverted button">
              <i class="checkmark icon"></i>
              Отмена
            </div>
          </div>
        </div>

      {{-- <div class="card">
        <div class="content">
          <i class="right floated kz flag"></i>
          <div class="header">{{ $city->title }}</div>
          <div class="description">
            <p>Университетов: {{ count($city->universities) }}</p>
            <p>колледжей: {{ count($city->colleges) }}</p>
          </div>
        </div>
      </div> --}}
    @endforeach
  </div>
  <br><br>
@endsection