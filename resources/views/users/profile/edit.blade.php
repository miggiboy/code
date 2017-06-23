@extends ('layouts.app')

@section ('title', 'Profile edit')

@section ('content')
    <h2>Изменение профиля</h2>
        <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('profile') }}" method="post"class="form-vertical">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="first_name" class="control-label">Ваше имя</label>
                            <input type="text" value="{{ request()->old('first_name') ?: auth()->user()->first_name }}" name="first_name" id="first_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="last_name" class="control-label">Ваша фамилия</label>
                            <input type="text" value="{{ request()->old('last_name') ?: auth()->user()->last_name }}" name="last_name" id="last_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="location" class="control-label">Родной город</label>
                    <input type="text" value="{{ request()->old('location') ?: auth()->user()->location }}" name="location" id="location" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-default">
                        Обновить
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
