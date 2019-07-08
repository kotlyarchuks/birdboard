<div class="card flex flex-col" style="height:200px">
    <h3 class="py-3 -ml-5 pl-4 mb-3 text-xl border-l-4 border-blue-main"><a href="{{$project->path()}}">{{$project->title}}</a></h3>

    <div class="text-gray-600 flex-1">
        {{\Illuminate\Support\Str::limit($project->description, 100)}}
    </div>

    <div class="text-gray-300">
        <form action="{{$project->path()}}" method="post" class="text-right">
            @method('delete')
            @csrf
            <button type="submit" class="text-sm cursor-pointer hover:text-gray-600">Delete</button>
        </form>
    </div>
</div>