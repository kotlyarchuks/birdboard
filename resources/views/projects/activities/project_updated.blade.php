@if(count($activity->changes['after']) === 1)
    <span class="text-gray-700">{{$activity->author->name}} updated the {{key($activity->changes['after'])}}</span>
@else
    <span class="text-gray-700">{{$activity->author->name}} updated the project</span>
@endif
