@extends('layouts.app')

@section('title', {{ $user->getNameOrUsername() }})

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('users.partials.userblock')
            <hr>
            <a href="{{ route('users.edit', $user) }}" class = 'button'>
                Edit
            </a>
        </div>
    </div>
@endsection
