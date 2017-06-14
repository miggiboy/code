<form action="{{ route('college.specialties', [$college, $studyForm]) }}"
    method="post" style="text-align: center;">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}

    <input type="hidden" name="category" value="{{ request('category') }}">

    <table class="ui celled table">
      <thead>
        <tr>
          <th class="collapsing"></th>
          <th style="width: 400px;">Специальность</th>
          <th style="width: 40px;">Цена за год</th>
          <th style="width: 280px;">Срок обучения</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td>
             <div class="ui input focus">
              <input type="text"
                     name="default-price"
                     value="{{ old('default-price', '') }}"
                     placeholder="Повторяющаяся цена"
                     id="default-price"
                     style="margin-bottom: 10px;">
            </div>
            <div class="ui checkbox">
              <input type="checkbox" tabindex="0" class="hidden" id="set-price-to-all">
              <label>Задать всем</label>
            </div>
          </td>
          <td>
            <div class="ui fluid input focus">
              <input type="text"
                     name="default-study-period"
                     value="{{ old('default-study-period', '') }}"
                     placeholder="Повторяющийся срок"
                     id="default-study-period">
            </div>
          </td>
        </tr>
        @foreach ($college->specialities as $specialty)
        <tr>
          <td>
            <div class="ui checkbox">
                <input type="checkbox"
                       tabindex="0"
                       class="hidden set-price"
                       id="specialty{{ $specialty->id }}">
                <label></label>
              </div>
          </td>
          <td>
            <h5 class="ui header">
              <div class="content">
                {{ $specialty->title }}
            </div>
          </h5></td>
          <td>
            <div class="ui{{ $errors->has('specialty_details.' . $specialty->id . '.price') ? ' error' : '' }} input">
              <input type="text"
                     name="specialty_details[{{ $specialty->id }}][price]"
                     value = "{{ old('specialty_details.' . $specialty->id . '.price', $specialty->pivot->study_price) }}"
                     placeholder="Цена за год"
                     class="price"
                     id="specialty{{ $specialty->id }}input">

            </div>
            @if ($errors->has('specialty_details.' . $specialty->id . '.price'))
                <span>
                    <p>{{ $errors->first('specialty_details.' . $specialty->id . '.price') }}</p>
                </span>
            @endif
          </td>
          <td>
            <div class="ui{{ $errors->has('specialty_details.' . $specialty->id . '.study_period') ? ' error' : '' }} fluid input">
              <input type="text"
                     name="specialty_details[{{ $specialty->id }}][study_period]"
                     value="{{ request()->old('specialty_details.' . $specialty->id . '.study_period', $specialty->pivot->study_period) }}"
                     placeholder="Период обучения"
                     class="study-period">
            </div>
            @if ($errors->has('specialty_details.' . $specialty->id . '.study_period'))
                <span>
                    <p>{{ $errors->first('specialty_details.' . $specialty->id . '.study_period') }}</p>
                </span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <br>
    <button type="submit" class="ui big teal button">Сохранить</button>
  </form>
