<x-app-layout>
    <x-slot name="header">
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a href="/"><span class="navbar-brand mb-0 h1">{{ __('lead editing') }}</span></a>
                <a href="{{ route('leads.index') }}"><x-danger-button>{{__('cancel') }}</x-danger-button></a>
            </div>
        </nav>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                        <form class="mt-6 space-y-6" action="{{ route('leads.update', $lead->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                    <div class="form-group">
                                        <x-input-label for="" :value="__('Full name')" />
                                        <x-text-input id="full_name" name="full_name" value="{{ $lead->full_name }}" type="text" class="mt-1 block w-full"/>
                                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="" :value="__('Phone')" />
                                        <x-text-input id="phone" name="phone" value="{{ $lead->phone }}" type="text" class="mt-1 block w-full"/>
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                <div>
                                    <x-input-label for="" :value="__('Status')" />
                                    <select name="status" class="custom-select">
                                        @foreach(\App\Enums\LeadStatus::cases() as $status)
                                            <option value="{{ $status->value }}" @selected($lead->status === $status)>{{ $status->getLabel() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label value="Note" />
                                    <x-textarea name="note" :value="$lead->note" rows="4" />
                                </div>

                                <div class="col-12">
                                    <hr class="my-2 mb-3">
                                </div>

                                <div class="col-12">
                                    <x-primary-button type="submit">{{ __('submit') }}</x-primary-button>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
