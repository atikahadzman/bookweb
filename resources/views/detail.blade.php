<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __($books->title, ['title' => $books->title]) }} 
             @php
                $statusText = 'Pending Approval';
                $color = 'text-yellow-600 dark:bg-yellow-500/15 dark:text-orange-400';
                if ($books->status !== null && $books->status == 10) {
                    $statusText = 'Approved at ' . $books->approved_at . ' by ' . $books->approver->name;
                    $color = 'text-green-600 dark:bg-green-500/15 dark:text-green-500';
                } elseif ($books->status !== null && $books->status == 11) {
                    $statusText = 'Rejected';
                    $color = 'text-red-600 dark:bg-red-500/15 dark:text-red-400';
                }
            @endphp
            <span class="inline-flex items-center px-2.5 py-0.5 justify-center gap-1 rounded-full font-medium capitalize text-sm bg-green-50 {{ $color }}">
                {{ $statusText }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

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

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col md:flex-row md:space-x-6">
                    <div class="md:w-1/3 flex-shrink-0 mb-6 md:mb-0">
                        @if($books->getFirstMediaUrl('cover_image'))
                            <img src="{{ $books->getFirstMediaUrl('cover_image') }}" 
                                class="w-full h-auto rounded-lg shadow-md object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-gray-500">No Cover Image</span>
                            </div>
                        @endif
                    </div>

                    <div class="md:w-2/3">
                        <div class="mt-4">
                            <x-input-label for="categories_id" :value="__('Category')" />
                            <select id="categories_id" name="categories_id" 
                                    class="mt-1 block w-full border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ $books->categories_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('categories_id')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" 
                                        :value="old('title', $books->title)" readonly autofocus autocomplete="title"/>
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" 
                                        :value="old('author', $books->author)" readonly autofocus autocomplete="author"/>
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="isbn" :value="__('ISBN')" />
                            <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" 
                                        :value="old('isbn', $books->isbn)" readonly autofocus autocomplete="isbn"/>
                            <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-gray-900"
                                    readonly autofocus autocomplete="description">{{ old('description', $books->description ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="mt-4 flex space-x-2">
                            <form action="{{ route('books.status', $books->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="10">
                                <x-primary-button type="submit">
                                    {{ __('Approve') }}
                                </x-primary-button>
                            </form>

                            <form action="{{ route('books.status', $books->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="11">
                                <x-danger-button type="submit">
                                    {{ __('Reject') }}
                                </x-danger-button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
