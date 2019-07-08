@extends('layouts.app')
@section('content')
    <header class="flex justify-between items-center py-6">
        <p class="text-gray-700">
            <a href="/projects">My projects</a> / {{$project->title}}
        </p>
        <div class="flex items-center">
            @foreach($project->members as $member)
                <img src="{{gravatar_url($member->email)}}" alt="" class="rounded-full w-8 mr-2">
            @endforeach
                <img src="{{gravatar_url($project->owner->email)}}" alt="" class="rounded-full w-8 mr-2">
                <a href="{{$project->path()}}/edit" class="button ml-5">Edit project</a>
        </div>
    </header>

    <main>
        <div class="flex">
            <div class="w-3/4 mr-4">
                <div class="mb-8">
                    <h3 class="text-gray-700 text-lg mb-6">Tasks</h3>
                    @foreach($project->tasks as $task)
                    <div class="card mb-3">
                        <form action="{{$task->path()}}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="flex">
                                <input class="w-full {{$task->completed ? 'text-gray-500' : ''}}" type="text" value="{{$task->text}}" name="text" />
                                <input type="checkbox" onchange="this.form.submit()" name="completed" {{$task->completed ? 'checked' : ''}}/>
                            </div>
                        </form>
                    </div>
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
                    <form action="{{$project->path()}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <textarea class="card w-full mb-4" style="min-height: 200px" placeholder="Your thoughts..." name="notes">{{$project->notes}}</textarea>
                        @include('layouts.errors')
                        <button type="submit" class="button">Save</button>
                    </form>
                </div>
            </div>
            <div class="w-1/4">
                @include('layouts.card')
                @include('projects.activities.activity_card')
                @can('own', $project)
                    @include('projects.invite')
                @endcan
            </div>
        </div>
    </main>
@endsection