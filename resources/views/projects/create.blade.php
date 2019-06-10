@extends('layouts.app')
@section('content')
<form action="/projects" method="post">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input id="title" name="title" type="text" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <input id="description" name="description" type="text" required>
    </div>
    <button type="submit">Create</button>
</form>

<a href="/projects">Go back</a>
@endsection