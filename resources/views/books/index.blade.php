@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main content -->
        <div class="flex-1 p-6 bg-gray-100">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">

                @if(session('success'))
                <div class="rounded-xl border p-4 border-green-500 bg-green-50 dark:border-green-500/30 dark:bg-green-500/15">
                    <div class="flex items-start gap-3">
                        <div class="-mt-0.5 text-green-500">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z" fill=""></path>
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h4 class="mb-1 text-sm font-semibold text-gray-800">
                                {{ session('success') }}
                            </h4>
                        </div>
                    </div>
                </div>
                @endif

                @if (Auth::user()?->role === 'seller')
                    @include('books.store')
                @endif

                <div class="flex gap-2 mb-6 justify-end">
                    <form action="{{ route('books.search') }}" method="GET">
                        <input 
                            type="text" 
                            name="query" 
                            placeholder="Search books..." 
                            value="{{ request('query') }}"
                            class="border px-3 py-2 rounded-lg w-full"
                        >
                        <x-primary-button>{{ __('Search') }}</x-primary-button>
                    </form>
                </div>

                @include('books.list')

            </div>
        </div>
    </div>
</x-app-layout>
