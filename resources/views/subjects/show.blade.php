@extends ('layouts.app')

@section ('title')
    {{ $subject->title }}
@endsection

@section ('subnavigation')
    @include ('subjects/partials/_navigation', ['heading' => $subject->title])
@endsection

@section ('head')
  <style>
    .ui.card {
      margin-left: 55px !important;
      margin-bottom: 40px !important;
    }
    .ui.cards {
        margin-top: 45px;
    }
  </style>
@endsection

@section ('content')
    <div class="ui cards">
        <a class="ui card" href="{{ route('subjects.media.index', $subject) }}">
          <div class="content">
            <h5 class="ui icon header">
              <i class="teal file icon"></i>
              <div class="content" style="color: #444;">
                Файлы
              </div>
            </h5>
            <div class="meta">
              <p></p>
            </div>
            <div class="description">
              <p></p>
            </div>
          </div>
          <div class="extra content">
            <div class="left floated author">
              <i class="file text outline icon"></i>
              Файлов: {{ count($subject->media) }}
            </div>
          </div>
        </a>

        @if ($subject->is_profile)
          <a class="ui card" href="{{ route('subjects.specialties.index', $subject) }}">
            <div class="content">
              <h5 class="ui icon header">
                <i class="teal student icon"></i>
                <div class="content" style="color: #444;">
                  Специальности
                </div>
              </h5>
              <div class="meta">
                <p></p>
              </div>
              <div class="description">
                <p></p>
              </div>
            </div>
            <div class="extra content">
              <div class="left floated author">
                <i class="file text outline icon"></i>
                  Специальностей:  {{ $subject->getSpecialties()->count() }}
              </div>
            </div>
          </a>
        @endif

        <a class="ui card" href="#" onclick="event.preventDefault(); alert("Тесты еще не добавлены")">
          <div class="content">
            <h5 class="ui icon header">
              <i class="teal checkmark box icon"></i>
              <div class="content" style="color: #444;">
                Тесты
              </div>
            </h5>
            <div class="meta">
              <p></p>
            </div>
            <div class="description">
              <p></p>
            </div>
          </div>
          <div class="extra content">
            <div class="left floated author">
              <i class="file text outline icon"></i>
                Тестов: {{ count($subject->quizzes) }}
            </div>
          </div>
        </a>
    </div>
@endsection
