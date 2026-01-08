<x-app-layout>
    <x-slot name="header">
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a href="#"><span class="navbar-brand mb-0 h1">{{ __('lead info') }}</span></a>
                <a href="{{ route('leads.index') }}"><x-danger-button>{{__('back') }}</x-danger-button></a>
            </div>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Lead details</h2>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-4">
                    <div class="font-medium">Full name</div>
                    <div class="sm:col-span-2 text-gray-600">{{ $lead->full_name }}</div>

                    <div class="font-medium">Phone</div>
                    <div class="sm:col-span-2 text-gray-600">{{ $lead->phone }}</div>

                    <div class="font-medium">Status</div>
                    <div class="sm:col-span-2 text-gray-600">
                        {{ $lead->status->getLabel() }}
                    </div>

                    <div class="font-medium">Assigned to</div>
                    <div class="sm:col-span-2 text-gray-600">{{ $lead->user->name }}</div>

                    <div class="font-medium">Note</div>
                    <div class="sm:col-span-2 text-gray-600">
                        {{ $lead->note ?? '—' }}
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Tasks</h2>

                    <a href="{{ route('tasks.create', $lead) }}"
                       class="text-sm text-indigo-600 hover:underline">
                        + Add task
                    </a>
                </div>

                @if($lead->tasks->isEmpty())
                    <p class="text-gray-500 text-sm">No tasks yet.</p>
                @else
                    <div class="space-y-3">
                        @foreach($lead->tasks as $task)

                            <div class="border rounded p-4 flex justify-between items-center">
                                <div>
                                    <p class="font-medium">{{ $task->title }}</p>

                                    @if($task->due_at)
                                        <p class="text-sm text-gray-500">
                                            Due: {{ $task->due_at->format('d.m.Y H:i') }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3">
                                    <span class="px-2 py-1 text-xs rounded
                                        {{ $task->is_done
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $task->is_done ? 'Done' : 'Pending' }}
                                    </span>

                                    <a href="{{ route('tasks.edit', [$lead, $task]) }}"
                                       class="text-sm text-indigo-600 hover:underline">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('tasks.destroy', [$lead, $task]) }}"
                                          onsubmit="return confirm('Delete this task?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-sm text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif
            </div>

        </div>
</div>

</x-app-layout>
