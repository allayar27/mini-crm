<x-app-layout>
    <x-slot name="header">
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a href="/"><span class="navbar-brand mb-0 h1">{{ __('Leads') }}</span></a>
                <a href="{{ route('leads.create') }}">
                    <x-primary-button>{{ __('add lead') }}</x-primary-button>
                </a>
            </div>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form method="GET" action="{{ route('leads.index') }}" class="mb-6">
                    <div class="flex flex-wrap gap-4 items-end">

                        <div class="w-full md:w-1/3">
                            <x-input-label value="Search" />
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Name or phone"
                                class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >
                        </div>
                        <div class="w-full md:w-1/4">
                            <x-input-label value="Status" />
                            <select
                                name="status"
                                class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">All statuses</option>
                                @foreach(\App\Enums\LeadStatus::cases() as $status)
                                    <option
                                        value="{{ $status->value }}"
                                        @selected(request('status') === $status->value)
                                    >
                                        {{ $status->getLabel() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full md:w-1/4">
                            <x-input-label value="Sort by date" />
                            <select
                                name="sort"
                                class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="desc" @selected(request('sort', 'desc') === 'desc')>
                                    desc
                                </option>
                                <option value="asc" @selected(request('sort') === 'asc')>
                                    asc
                                </option>
                            </select>
                        </div>

                        <div>
                            <x-primary-button>
                                Apply
                            </x-primary-button>
                        </div>

                    </div>
                </form>
            <div class="min-w-full border-b border-gray-200 shadow">
                <table class="table border-b-2">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" width="2%">#</th>
                        <th scope="col" width="7%">{{ __('full name') }}</th>
                        <th scope="col" width="7%">{{ __('phone') }}</th>
                        <th scope="col" width="7%">{{ __('status') }}</th>
                        <th scope="col" width="7%">{{ __('assigned to') }}</th>
                        <th scope="col" width="7%">{{ __('created at') }}</th>
                        <th scope="col" width="1%" colspan="3">{{ __('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $lead->full_name }}</td>
                            <td>{{ $lead->phone }}</td>
                            <td>{{ $lead->status->getLabel() }}</td>
                            <td>{{ $lead->user->name }}</td>
                            <td>{{ $lead->created_at }}</td>
                            <td>
                                <a href="{{ route('leads.edit', $lead->id) }}" >
                                    <i class="bi bi-pencil-square" style="font-size: 1rem; color: blue;"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('leads.show', $lead->id) }}" type="submit">
                                    <i class="bi bi-info-circle" style="font-size: 1rem; color: blue;"></i>
                                </a>
                            </td>
                            <form action="{{ route('leads.destroy', $lead->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <td>
                                    <button type="submit">
                                        <i class="bi bi-trash" style="font-size: 1rem; color: red;"></i>
                                    </button>
                                </td>
                            </form>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center"
                                class="px-6 py-4 whitespace-no-wrap text-sm leading">
                                {{ __('data not found') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
