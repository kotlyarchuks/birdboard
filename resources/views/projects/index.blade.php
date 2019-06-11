@extends('layouts.app')
@section('content')
    <header class="flex justify-between items-center py-6">
        <h4 class="text-gray-700">My projects</h4>
        <a href="/projects/create" class="button">Create new project</a>
    </header>

    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/4 px-3 pb-6">
                <div class="bg-white p-5 rounded-lg shadow" style="height:200px">
                    <h3 class="py-3 -ml-5 pl-4 mb-3 text-xl border-l-4 border-blue-main"><a href="{{$project->path()}}">{{$project->title}}</a></h3>

                    <div class="text-gray-600">
                        {{\Illuminate\Support\Str::limit($project->description, 100)}}
                    </div>
                </div>
            </div>
        @empty
            <div>
                No projects yet!
            </div>
        @endforelse
    </div>
@endsection