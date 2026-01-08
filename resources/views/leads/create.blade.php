<x-app-layout>
    <x-slot name="header">
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a href="/"><span class="navbar-brand mb-0 h1">{{ __('Add new Lead') }}</span></a>
                <a href="{{ route('leads.index') }}"><x-danger-button>{{__('back') }}</x-danger-button></a>
            </div>
        </nav>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xl">
                    <form class="mt-6 space-y-6" action="{{ route('leads.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="full_name" value="Full name" />
                            <x-text-input id="full_name" name="full_name" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input id="phone" name="phone" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label value="Status" />
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300">
                                @foreach(\App\Enums\LeadStatus::cases() as $status)
                                    <option value="{{ $status->value }}">
                                        {{ $status->getLabel() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Note" />
                            <x-textarea name="note" rows="4" />
                        </div>

                        <div class="md:col-span-2">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
