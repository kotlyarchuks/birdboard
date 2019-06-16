@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-1/3" action="{{$project->path()}}" method="post">
            @method('PATCH')
            @include('projects._form', [
                'buttonText' => 'Update project'
            ])
        </form>
    </div>
@endsection