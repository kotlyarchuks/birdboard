@extends('layouts.app')
@section('content')
    <h2 class="my-3">{{$project->title}}</h2>

    <p>{{$project->description}}</p>

    <a href="/projects">Go back</a>
@endsection