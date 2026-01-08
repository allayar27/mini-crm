<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Add task for lead: {{ $lead->full_name }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('tasks.store', $lead) }}">
            @csrf

            <div class="mb-4">
                <x-input-label value="Title" />
                <x-text-input name="title" class="w-full" />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div class="mb-4">
                <x-input-label value="Deadline" />
                <x-text-input type="datetime-local" name="due_at" />
            </div>

            <x-primary-button>
                Save task
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
