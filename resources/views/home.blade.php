@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">index</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('chat', ['user_b_id' => 0]) }}">chat!</a>
                
                    <hr>
                    <h5>items for sale!</h5>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($items as $item)
                        <li>
                            <a>{{ $item->name }}</a>
                            <a>{{ $item->content }}</a>
                            <a>$ {{ $item->price }}</a>
                            <a href="{{ route('addcart', ['id' => $item->id]) }}"><button>add to cart</button></a>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
