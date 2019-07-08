<div class="card flex flex-col mt-3">
    <h3 class="py-3 -ml-5 pl-4 mb-3 text-xl border-l-4 border-blue-main">Invite user</a></h3>

    <div class="">
        <form action="{{$project->path()}}/invitations" method="post">
            @csrf
            <input type="email" name="email" class="border border-gray-200 w-full rounded px-2 py-3 mb-2">
            <button type="submit" class="button">Invite</button>
        </form>
        @include('layouts.errors', ['bag' => 'invitations'])
    </div>


</div>