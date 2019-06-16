@csrf
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
        Title
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
           id="title" name="title" type="text" placeholder="" value="{{$project->title}}" required>
</div>
<div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Description
    </label>
    <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="description" name="description" placeholder="" required
            style="min-height: 100px">{{$project->description}}</textarea>
</div>
<div class="flex items-center justify-center mb-5">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-5 rounded focus:outline-none focus:shadow-outline"
            type="sumbit">
        {{$buttonText}}
    </button>
    <a href="/projects">Go back</a>
</div>

@if($errors->any())
<div>
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-sm text-red-700">{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif