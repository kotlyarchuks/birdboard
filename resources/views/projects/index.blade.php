@extends('layouts.app')
@section('content')
    <div class="flex">
        @forelse($projects as $project)
            <div class="bg-white mr-4 p-5 w-1/4 rounded shadow" style="height:200px">
                <h3 class="py-3 text-xl"><a href="{{$project->path()}}">{{$project->title}}</a></h3>

                <div class="text-gray-600">
                    {{\Illuminate\Support\Str::limit($project->description, 100)}}
                </div>
            </div>
        @empty
            <div>
                No projects yet!
            </div>
        @endforelse
    </div>

    <br>
    <a href="/projects/create">Create new project</a>
@endsection