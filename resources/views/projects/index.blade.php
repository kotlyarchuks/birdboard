@extends('layouts.app')
@section('content')
    <ul>
            @forelse($projects as $project)
            <li>
                <a href="{{$project->path()}}">{{$project->title}}</a>
            </li>
            @empty
                No projects yet!
            @endforelse
    </ul>
    <br>
    <a href="/projects/create">Create new project</a>
@endsection