<div class="card" style="height:200px">
    <h3 class="py-3 -ml-5 pl-4 mb-3 text-xl border-l-4 border-blue-main"><a href="{{$project->path()}}">{{$project->title}}</a></h3>

    <div class="text-gray-600">
        {{\Illuminate\Support\Str::limit($project->description, 100)}}
    </div>
</div>