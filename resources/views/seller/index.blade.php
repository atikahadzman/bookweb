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

                <!-- Form Section -->
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900 mb-6 border-b-2 border-gray-300 pb-2">Add New Seller</h1>
                    <form action="{{ route('seller.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <input type="hidden" name="role" value="seller" />

                        <div class="mt-4">
                            <x-input-label for="id_number" :value="__('ID Number')" />
                            <x-text-input id="id_number" name="id_number" type="text" class="mt-1 block w-full" required autofocus autocomplete="id_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('id_number')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" required autofocus autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" required autofocus autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        
                        <div class="mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900 mb-6 border-b-2 border-gray-300 pb-2">List of Seller</h1>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th> -->
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $color = 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400';
                                        if ($user->status == 1) {
                                            $color = 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400';
                                        }
                                    @endphp
                                    <span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $color }}">
                                        {{ $user->status == 1 ? 'Approve' : 'Pending Approval' }}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->id_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('seller.edit', $user->id) }}" title="Update">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('seller.remove', $user->id) }}" title="Remove">
                                           <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
