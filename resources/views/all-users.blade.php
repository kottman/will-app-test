@extends('layout')

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <table class="user-details-container">
            @foreach($users as $user)
                <tr>
                    <td>[{{ $user->logins_count }}]</td>
                    <td><img style="width: 24px; height: 24px" class="picture" src="{{ $user->picture }}" /><br></td>
                    <td>{{ $user->name }}</td>
                    <td>({{ $user->email }})</td>
                    <td>{{ $user->last_login }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection