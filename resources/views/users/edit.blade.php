@extends('layouts.master')

@section('title', 'Assigning roles')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('users.partials.userblock')
            <hr>
            <form action="{{ route('users.grant', ['id' => $user->id ]) }}" method = "POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                @foreach ($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                    {{ $role->display_name }}
                @endforeach
                <input type="submit" value="Задать Роль">
            </form>
        </div>
    </div>
@endsection