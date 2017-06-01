@extends ('layouts.master')

@section ('title', 'Предметы')

@section ('subnavigation')
    @include ('subjects.partials.navigation', ['pageTitle' => ''])
@endsection

@section ('styles')
  <style>
      .centered.header{
        text-align: center;
        margin-top: -30px;
        margin-bottom: 100px;
      }

      .ui.custom.container {
        width: 1000px;
        margin: 0 auto;
      }

      .ui.card {
        margin-left: 35px !important;
        margin-bottom: 30px !important;
      }

    </style>
@endsection

@section ('content')
    <div class="centered header">
      <h1>Предметы</h1>
    </div>
    
    <div class="ui custom container">
      @if($subjects->count())
        <div class="ui cards">
          @foreach ($subjects as $subject)
            <div class="three wide column">
              <a class="ui card" href="{{ route('subject.show', $subject) }}">
                <div class="content">
                  <h5 class="ui header">
                    <div class="content" style="color: #444;">
                      {{ str_limit($subject->title, 26) }}
                    </div>
                  </h5>
                  <div class="meta">
                    <p></p>
                  </div>
                  <div class="description">
                    <p></p>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      @else
        <p>Предметы еще не добавлены</p>
      @endif
    </div>
    <br>
    <br>
    <br>
  </div>

@endsection
