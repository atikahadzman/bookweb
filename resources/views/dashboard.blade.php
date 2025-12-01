<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main content -->
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                @if(!empty($books))
                <div class="flex gap-2 mb-10 justify-end">
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

                @foreach($books as $book)
                <div class="p-4 border-t border-gray-100 sm:p-6">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">
                            <div class="flex flex-col gap-5 rounded-lg border border-gray-200 bg-white p-4 dark:bg-white/[0.03] sm:flex-row sm:items-center sm:gap-6">
                                <div class="flex-shrink-0 overflow-hidden rounded-lg">
                                    @if($book->getFirstMediaUrl('cover_image'))
                                    <a href="{{ route('detail', $book->id) }}">
                                        <img src="{{ $book->getFirstMediaUrl('cover_image') }}" 
                                            alt="{{ $book->title }}" 
                                            class="overflow-hidden rounded-lg"
                                            width="120" 
                                            height="160">
                                    </a>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <h4 class="mb-1 font-medium text-lg text-gray-800">
                                        {{ $book->title }}
                                    </h4>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $book->description }}</p>
                                   @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('detail', $book->id) }}" title="See Details" class="text-sm font-normal underline text-brand-500">
                                            See Details
                                        </a>
                                    @else
                                        <a href="{{ route('books.edit', $book->id) }}" title="Edit Book" class="text-sm font-normal underline text-brand-500">
                                            Edit Book
                                        </a>
                                    @endif

                                    </a> <i class="fa-solid fa-arrow-right-long"></i>
                                    
                                   @if (Auth::user()?->role === 'admin')
                                        @php
                                            $color = 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400';
                                            if ($book->status == 10) {
                                                $color = 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400';
                                            } elseif ($book->status == 11) {
                                                $color = 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-400';
                                            }

                                            $statusText = 'Pending Approval';
                                            if ($book->status !== null && $book->status == 10) {
                                                $statusText = 'Approved';
                                            } elseif ($book->status !== null && $book->status == 11) {
                                                $statusText = 'Rejected';
                                            }
                                        @endphp

                                        <span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $color }}">
                                            {{ $statusText }}
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
