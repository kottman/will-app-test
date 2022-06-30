@extends('layout')

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <ul>
        <li><a href="{{ url('/all-users') }}">All users</a></li>
        <li><a href="{{ url('/all-logins') }}">All logins</a></li>
        </ul>
    </div>
@endsection
