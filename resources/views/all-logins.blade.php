@extends('layout')

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <table class="user-details-container">
            @foreach($logins as $login)
                <tr>
                    <td>{{ $login->created_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
