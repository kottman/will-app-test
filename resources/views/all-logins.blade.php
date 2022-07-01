@extends('layout')

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <table class="user-details-container">
            <tr>
                <th>Login time</th>
                <th>Picture</th>
                <th>Name</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Domain</th>
                <th>Locale</th>
                <th>Email verified</th>
            </tr>
            @foreach($logins as $login)
                <tr>
                    <td>{{ $login->created_at }}</td>
                    <td><img style="width: 24px; height: 24px" class="picture" src="{{ $login->user->picture }}" /></td>
                    <td>{{ $login->user->name }}</td>
                    <td>({{ "{$login->user->family_name}, {$login->user->given_name}"  }})</td>
                    <td>{{ $login->user->email }}</td>
                    <td>{{ $login->user->hd }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            @if(true)
                <tr>
                    <td class="pagination-navigation-container">{{ $logins->links() }}</td>
                </tr>
            @endif
        </table>
    </div>
@endsection
