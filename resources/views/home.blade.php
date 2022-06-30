@extends('layout')

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <table class="user-details-container">
            @foreach($user as $key => $nameValue)
                <tr>
                    <td>{{ $nameValue['name'] }}</td>
                    <td>
                    @if ($key === 'picture')
                        <img class="picture" src="{{ $nameValue['value'] }}" /><br>
                        {{ $nameValue['value'] }}
                    @else
                        {{ $nameValue['value'] }}
                    @endif
                    </td>
                </tr>
           @endforeach
        </table>
    </div>
@endsection
