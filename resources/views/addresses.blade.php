@extends('layout')

@section('content')
    <div class="addresses">
        @foreach($addresses as $address)
            <div class="address">
                <a class="address__link" href="/{{ $address->name  }}">
                    <h2 class="address__name">{{ $address->email }}</h2>
                    <span class="address__message-count">{{ $address->messageCount  }}</span>
                </a>
            </div>
        @endforeach
    </div>
@endsection