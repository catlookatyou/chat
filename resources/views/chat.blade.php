@extends('layouts.app')

    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script>var roomId = {{ $room_id }};</script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-chat-scroll/dist/vue-chat-scroll.min.js"></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">start chatting!</div>

                <div class="card-body">
                    <chatbox :roomId = roomId></chatbox>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection