<nav class="bg-white border-b shadow-sm">
    <div class="container mx-auto flex items-center justify-between px-4 py-3">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M12 0c-1.742 0-3.09 1.348-3.09 3.09 0 1.74 1.348 3.09 3.09 3.09s3.09-1.35 3.09-3.09c0-1.742-1.348-3.09-3.09-3.09zM12 4.242c-.796 0-1.515-.719-1.515-1.515s.719-1.515 1.515-1.515c.796 0 1.515.719 1.515 1.515s-.719 1.515-1.515 1.515z" />
            </svg>
            <span class="text-orange-500 font-bold text-lg">Robusta Caffe</span>
        </div>

        <!-- Navbar Links -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('showProduct') }}"
                class="{{ Route::currentRouteName() === 'showProduct' ? 'text-orange-500 font-semibold' : 'text-gray-600' }} hover:text-orange-600 transition">HOME</a>
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('products.index') }}"
                    class="{{ Route::currentRouteName() === 'products.index' ? 'text-orange-500 font-semibold' : 'text-gray-600' }} hover:text-orange-600 transition">PRODUCTS</a>
                <a href="{{ route('users.index') }}"
                    class="{{ Route::currentRouteName() === 'users.index' ? 'text-orange-500 font-semibold' : 'text-gray-600' }} hover:text-orange-600 transition">USERS</a>
                <a href="{{ route('orders.data') }}"
                    class="{{ Route::currentRouteName() === 'orders.data' ? 'text-orange-500 font-semibold' : 'text-gray-600' }} hover:text-orange-600 transition">PEMBELIAN</a>
            @else
                <a href="{{ route('orders.index') }}"
                    class="{{ Route::currentRouteName() === 'orders.index' ? 'text-orange-500 font-semibold' : 'text-gray-600' }} hover:text-orange-600 transition">PEMBELIAN</a>
            @endif
            <a href="{{ route('logout') }}" class="text-gray-600 hover:text-orange-500 transition">LOGOUT</a>
        </div>

        <!-- Mobile Menu Icon -->
        <button class="md:hidden" id="menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <!-- Mobile Dropdown -->
    <div class="md:hidden bg-white border-t hidden" id="mobile-menu">
        <a href="{{ route('showProduct') }}"
            class="{{ Route::currentRouteName() === 'showProduct' ? 'bg-orange-100' : 'text-gray-700' }} block px-4 py-2 hover:bg-orange-100">HOME</a>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('users.index') }}"
                class="{{ Route::currentRouteName() === 'users.index' ? 'bg-orange-100' : 'text-gray-700' }} block px-4 py-2 hover:bg-orange-100">USERS</a>
            <a href="{{ route('products.index') }}"
                class="{{ Route::currentRouteName() === 'products.index' ? 'bg-orange-100' : 'text-gray-700' }} block px-4 py-2 hover:bg-orange-100">PRODUCTS</a>
            <a href="{{ route('orders.data') }}"
                class="{{ Route::currentRouteName() === 'orders.data' ? 'bg-orange-100' : 'text-gray-700' }} block px-4 py-2 hover:bg-orange-100">PEMBELIAN</a>
        @else
            <a href="{{ route('orders.index') }}"
                class="{{ Route::currentRouteName() === 'orders.index' ? 'bg-orange-100' : 'text-gray-700' }} block px-4 py-2 hover:bg-orange-100">PEMBELIAN</a>
        @endif
        <a href="{{ route('logout') }}" class="text-gray-700 hover:bg-orange-100 block px-4 py-2">LOGOUT</a>
    </div>
</nav>

<script>
    // Toggle for mobile menu
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
