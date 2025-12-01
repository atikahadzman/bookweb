<!-- Dashboard, Books, Categories, and Seller Management -->
<div class="w-64 bg-gray-800 min-h-screen text-white p-6">
    <h2 class="text-2xl font-bold mb-6">Books & Coffee</h2>
    <nav class="space-y-2">
        <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>
        @if (Auth::user()?->role === 'admin' 
            || (Auth::user()?->role === 'seller' && Auth::user()?->status == 1))
        <a href="{{ url('/books') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Books</a>
        @endif
        
        @if (Auth::user()?->role === 'admin')
        <a href="{{ url('/categories') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Categories</a>
            <a href="{{ url('/seller') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Seller Management</a>
        @endif
    </nav>
</div>
