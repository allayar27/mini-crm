<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit task for lead: {{ $lead->full_name }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('tasks.update', [$lead, $task]) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="title" value="Title" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                    :value="old('title', $task->title)"
                />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="due_at" value="Due date" />
                <x-text-input id="due_at" name="due_at" type="datetime-local" class="mt-1 block w-full" :value="old('due_at', $task->due_at?->format('Y-m-d\TH:i'))"/>
                <x-input-error :messages="$errors->get('due_at')" />
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_done" value="1" class="rounded border-gray-300"
                    {{ old('is_done', $task->is_done) ? 'checked' : '' }}
                >
                <span class="text-sm text-gray-700">Task completed</span>
            </div>

            <div class="flex justify-between">
                <x-primary-button>
                    Update task
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
