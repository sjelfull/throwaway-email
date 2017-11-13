@extends('layout')

@section('content')
    <aside class="sidebar">
        <h2 class="sidebar__name">{{ $address->email }}</h2>
        <span class="sidebar__count">{{ $address->messageCount  }} messages</span>
    </aside>
    <div class="messages">
        @foreach($address->messages as $message)
            <div class="message">
                <a class="message__link" href="{{ url("{$address->name}/{$message->id}") }}">
                    <div class="message__info">
                        <h2 class="message__subject">{{ $message->subject ?? 'No subject' }}</h2>
                        <p class="message__from">{{ $message->from }}</p>
                    </div>

                    <div class="message__meta">
                        <date class="message__date"
                              title="{{ $message->created_at }}">{{ $message->relativeDate }}</date>
                    </div>
                </a>

                @if($selectedMessage and $selectedMessage->id == $message->id )
                    <div class="message-view">
                        <iframe src="{{ url("/messages/{$message->id}") }}" frameborder="0"></iframe>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection