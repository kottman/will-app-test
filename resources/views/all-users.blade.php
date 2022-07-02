@extends('layout')

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <table class="user-details-container">
            @foreach($users as $user)
                <tr>
                    <td>[{{ $user->logins_count }}]</td>
                    <td><img class="picture" src="{{ $user->picture }}" /></td>
                    <td>{{ $user->name }}</td>
                    <td>({{ $user->email }})</td>
                    <td>{{ $user->last_login }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="5" class="pagination-navigation-container">{{ $users->links() }}</td>
                </tr>
        </table>
    </div>
@endsection
