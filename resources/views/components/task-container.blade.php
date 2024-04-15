<div class="tasks-container" data-tasktype="{{ $taskType }}">
    <div class="px-3 py-2 mb-2 d-flex justify-content-between align-items-center title-container to-do">
        <div>
            <p class="mb-1 tahoma task-count">{{ $tasks->count() }}</p>
            <p class="mb-0 tahoma bold task-type">{{ $taskType }}</p>
        </div>

        {{ $taskIcon }}
    </div>

    <ul id="{{ $taskType }}Sortable" class="p-0 task-list hiden" type="none">
        @if ($tasks->count())
            @foreach ($tasks as $task)
                <x-task :task="$task" />
            @endforeach
        @endif
    </ul>
</div>

@section('links')
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
@endsection