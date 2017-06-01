<div class="panel panel-default">
  <div class="panel-heading">
    <form action="{{ route('specialities.update', $specialty) }}" method="post" role = "form" class = "form-horizontal">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">;)</span>
        <input type="text" class="form-control" name="title" placeholder = "Название" aria-describedby="basic-addon1" value = "{{ $specialty->title }}">
      </div>
      <br>
      <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">#</span>
        <input type="text" class="form-control" name="code" placeholder = "Код" aria-describedby="basic-addon1" value = "{{ $specialty->code }}">
      </div>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <select class="" name="subject_1_id">
            <option selected="selected" value = "{{ $specialty->subjects[0]->id }}">
              {{ $specialty->subjects[0]->title }}
            </option>
            @foreach ($subjects as $subject)
              @if ($specialty->subjects[0]->id === $subject->id)
                @continue
              @else
                <option value="{{ $subject->id }}">
                  {{ $subject->title }}
                </option>
              @endif
            @endforeach
        </select>
        <select class="" name="subject_2_id">
            <option selected="selected" value = "{{ $specialty->subjects[0]->id }}">
              {{ $specialty->subjects[1]->title }}
            </option>
            @foreach ($subjects as $subject)
              @if ($specialty->subjects[1]->id === $subject->id)
                @continue
              @else
                <option value="{{ $subject->id }}">
                  {{ $subject->title }}
                </option>
              @endif
            @endforeach
        </select>
        <select class="" name="direction_id">
            <option selected="selected" value = "{{ $specialty->direction->id }}">
              {{ $specialty->direction->title }}
            </option>
            @foreach ($directions as $direction)
              @if ($specialty->direction->id === $direction->id)
                @continue
              @else
                <option value="{{ $direction->id }}">
                  {{ $direction->title }}
                </option>
              @endif
            @endforeach
        </select>
      </div>
      </div>
      <div class="panel-footer">
        <h4>Добавьте описание специальности</h4>
        <textarea name = "description" class = "form-control"></textarea>
        <br>
        <button class="btn btn-success btn-md" type="submit">
          Обновить специальность
        </button>
      </form>
  </div>
</div>
