@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-1/3" action="{{$project->path()}}/tasks" method="post">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="text">
                    Task
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="text" name="text" type="text" placeholder="">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-5 rounded focus:outline-none focus:shadow-outline"
                        type="sumbit">
                    Create
                </button>
                <a href="/projects">Go back</a>
            </div>
        </form>
    </div>
@endsection