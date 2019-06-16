@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-1/3" action="/projects" method="post">
            @include('projects._form', [
                'project' => new App\Project,
                'buttonText' => 'Create project'
            ])
        </form>
    </div>
@endsection