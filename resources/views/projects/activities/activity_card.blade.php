<div class="card mt-3">
    @forelse($project->activities as $activity)
        <div class="text-sm text-muted">
            @include("projects.activities.{$activity->description}")
            -
            <span class="text-gray-500">
                                {{$activity->created_at->diffForHumans(null, true)}}
                            </span>
        </div>
    @empty
        <div class="text-sm text-muted">There is no activity yet</div>
    @endforelse
</div>