@extends('layout')

@section('content')
    <div class="addresses">
        @foreach($addresses as $address)
            <div class="address">
                <a class="address__link" href="/{{ $address->id  }}">
                    <h2 class="address__name">{{ $address->name }}</h2>
                </a>
            </div>
        @endforeach
    </div>
@endsection