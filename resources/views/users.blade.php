<div>
@foreach($users as $user)
    <a href="{{ route('chat', ['user_b_id' => $user->id]) }}">{{ $user->name }}</a>
@endforeach
</div>