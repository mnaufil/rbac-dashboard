<h1>Edit User</h1>

<form method="POST" action="/users/{{ $user->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $user->name }}">
    <br><br>

    <input type="email" name="email" value="{{ $user->email }}">
    <br><br>

    <button type="submit">Update</button>
</form>