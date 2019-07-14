@extends('layouts.app')
@section('content')
    <header class="flex justify-between items-center py-6">
        <h4 class="text-gray-700">My projects</h4>
        <a href="/projects/create" class="button" @click.prevent="$modal.show('create-project-modal')">Create new project</a>
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

    <create-project></create-project>
@endsection