<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Profile ' . $users->name) }}

             @php
                $color = 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400';
                if ($users->status == 1) {
                    $color = 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400';
                }
            @endphp
            <span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $color }}">
                {{ $users->status == 1 ? 'Approved' : 'Pending Approval' }}
            </span>
        </h2>
        <form action="{{ route('seller.status', $users->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-primary-button>{{ __('Approve') }}</x-primary-button>
        </form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form action="{{ route('seller.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Role')" />
                            <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', 'seller')" readonly/>
                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $users->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="id_number" :value="__('ID Number')" />
                            <x-text-input id="id_number" name="id_number" type="text" class="mt-1 block w-full" :value="old('id_number', $users->id_number)" required autofocus autocomplete="id_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('id_number')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $users->email)" required autofocus autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $users->phone)" required autofocus autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>{{ __('Update Info') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
