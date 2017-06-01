@extends('layouts.master')

@section('title', '{{ $user->getNameOrUsername() }}')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('users.partials.userblock')
            <hr>
            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class = 'button'>
                Edit
            </a>
        </div>
    </div>
@endsection