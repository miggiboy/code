<div class="panel panel-info">
    <div class="panel-heading">
    <form action="{{ route('quizzes.preview') }}" method="post">
      {{ csrf_field() }}
      <div class="input-group input-group-lg">
          <span class="input-group-addon" id="basic-addon1">@~"</span>
          <input type="text" class="form-control" name="title" placeholder="Введите название теста" aria-describedby="basic-addon1" required/>
            <select class="selectpicker" name="subject_id" required>
                <option value="empty" disabled="disabled">Выбор предмета</option>
                <option value="complex">Комплексный тест</option>
                @foreach ($subjects as $subject)
                  <option value="{{ $subject->id }}">
                    {{ $subject->title }}
                  </option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="panel-body">
        <textarea cols="110" rows="30" name="text" id="editor" class="form-control">
        </textarea>
      </div>
      <div class="panel-footer">
        <button class="btn btn-success btn-md" type="submit">Предварительный просмотр</button> 
      </div>
      </form>
</div>
