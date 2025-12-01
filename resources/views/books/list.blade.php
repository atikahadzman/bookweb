<div>
    <h1 class="text-3xl font-semibold text-gray-900 mb-6 border-b-2 border-gray-300 pb-2">List of Books</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($books as $book)
                <tr>
                    <td>
                        @if($book->getFirstMediaUrl('cover_image'))
                            <img src="{{ $book->getFirstMediaUrl('cover_image') }}" 
                                width="60" height="80">
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap"> {{ $categories->firstWhere('id', $book->categories_id)->category ?? 'No Category' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $color = $book->approved_by !== null
                                ? 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400'
                                : 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400';
                        @endphp

                        <span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $color }}">
                            {{ $book->approved_by !== null ? 'Approved' : 'Pending Approval' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->isbn }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('books.edit', $book->id) }}" title="See Details">
                           <i class="fas fa-edit"></i>
                        </a>

                        <a href="{{ route('books.remove', $book->id) }}" title="Remove">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>