@extends('layouts.app')
@section('content')
    <header class="flex justify-between items-center py-6">
        <h4 class="text-gray-700">My projects</h4>
        <a href="/projects/create" class="button">Create new project</a>
    </header>

    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/4 px-3 pb-6">
                @include('layouts.card')
            </div>
        @empty
            <div>
                No projects yet!
            </div>
        @endforelse
    </div>

    <modal name="hello-world" classes="bg-white p-10 rounded" height="auto">
        <h3 class="text-2xl text-center mb-12">Let's Start Something New</h3>
        <div class="flex">
            <div class="flex-1 mr-4">
                <div class="mb-4">
                    <label for="title" class="block mb-2">Title</label>
                    <input type="text" name="title" id="title" class="w-full block border border-gray-400 rounded p-2">
                </div>

                <div class="mb-4">
                    <label for="description" class="block mb-2">Description</label>
                    <textarea rows="5" name="description" id="description" class="w-full block border border-gray-400 rounded p-2"></textarea>
                </div>

            </div>

            <div class="flex-1 ml-4">
                <div class="mb-4">
                    <label for="task" class="block mb-2">Need Some Tasks?</label>
                    <input type="text" name="task" id="task" class="w-full block border border-gray-400 rounded p-2" placeholder="Task 1">
                </div>

                <button class="inline-flex items-center">
                    <svg class="mr-2" viewbox="0 0 18 18" height="18" width="18">
                        <g fill="#000" fill-rule="evenodd" opacity=".307">
                            <path fill="#000" d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                        </g>
                    </svg>
                    <span class="text-sm">Add New Task Field</span>
                </button>
            </div>
        </div>

        <footer class="flex justify-end">
            <button class="button is-outlined mr-4">Cancel</button>
            <button class="button">Create Project</button>
        </footer>
    </modal>

    <a href="" @click.prevent="$modal.show('hello-world')">Show modal</a>
@endsection