@php use Illuminate\Support\Str; @endphp

<div>
    <h1 class="text-3xl font-semibold text-gray-900 mb-6 border-b-2 border-gray-300 pb-2">Add New Books</h1>
    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mt-4">
            <x-input-label for="categories_id" :value="__('Category')" />

            <select id="categories_id" name="categories_id" class="mt-1 block w-full border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" readonly>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('categories_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('categories_id')" />
        </div>

        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="author" :value="__('Author')" />
            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" required autofocus autocomplete="author" />
            <x-input-error class="mt-2" :messages="$errors->get('author')" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />

            <textarea
                id="description"
                name="description"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500 text-gray-900"
                required
                autofocus
                autocomplete="description">{{ old('description') }}</textarea>

            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>


        <div class="mt-4">
            <x-input-label for="cover_image" :value="__('Cover Image')" />
            <x-text-input 
                id="cover_image" 
                name="cover_image" 
                type="file" 
                class="mt-1 block w-full" 
                required 
                autofocus 
                autocomplete="cover_image" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('cover_image')" />
        </div>
        
        <div class="mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>

