@extends('layouts.app')
@section('content')
    <header class="flex justify-between items-center py-6">
        <p class="text-gray-700">
            <a href="/projects">My projects</a> / {{$project->title}}
        </p>
        <a href="{{$project->path()}}/tasks/create" class="button">Create new task</a>
    </header>

    <main>
        <div class="flex">
            <div class="w-3/4 mr-4">
                <div class="mb-8">
                    <h3 class="text-gray-700 text-lg mb-6">Tasks</h3>
                    @foreach($project->tasks as $task)
                    <div class="card mb-3">{{$task->text}}</div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{$project->path()}}/tasks" method="post">
                            @csrf
                            <input class="w-full" placeholder="Add new task..." name="text"/>
                        </form>
                    </div>
                </div>
                <div>
                    <h3 class="text-gray-700 text-lg mb-6">General notes</h3>
                    <textarea class="card w-full" style="min-height: 200px"></textarea>
                </div>
            </div>
            <div class="w-1/4">
                @include('layouts.card')
            </div>
        </div>
    </main>
@endsection