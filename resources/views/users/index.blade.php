

@foreach ($users as $user)
    <p>
        {{ $user->name }} - {{ $user->email }}

        <a href="/users/{{ $user->id }}/edit">Edit</a>

        <form method="POST" action="/users/{{ $user->id }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
@endforeach