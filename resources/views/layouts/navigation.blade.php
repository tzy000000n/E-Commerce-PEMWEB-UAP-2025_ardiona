<nav x-data="{ open: false, searchOpen: false }" id="navbar" class="fixed w-full transition-all duration-300"
    style="top: 0; left: 0; right: 0; background: {{ request()->routeIs('home') ? 'transparent' : 'white' }}; z-index: 9999; border-bottom: {{ request()->routeIs('home') ? 'none' : '1px solid #e5e7eb' }}; box-shadow: {{ request()->routeIs('home') ? 'none' : '0 2px 8px rgba(0, 0, 0, 0.1)' }};">
    <style>
        /* Navbar semi-transparent di awal (home only), putih solid saat scroll */
        #navbar {
            transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, backdrop-filter 0.3s ease;
        }

        #navbar.scrolled {
            background: white !important;
            backdrop-filter: none !important;
            border-bottom: 1px solid #e5e7eb !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
        }

        /* Text color - putih di transparent (home only), gray di page lain atau saat scrolled */
        nav a {
            color:
                {{ request()->routeIs('home') ? 'white' : '#374151' }}
                !important;
            transition: color 0.3s ease;
        }

        #navbar.scrolled a {
            color: #374151 !important;
        }

        nav a:hover {
            background-color:
                {{ request()->routeIs('home') ? 'rgba(255, 255, 255, 0.1)' : '#f3f4f6' }}
                !important;
            border-radius: 8px;
        }

        #navbar.scrolled a:hover {
            background-color: #f3f4f6 !important;
        }

        /* SVG icons */
        nav svg {
            fill:
                {{ request()->routeIs('home') ? 'white' : '#374151' }}
                !important;
            transition: fill 0.3s ease;
        }

        #navbar.scrolled svg {
            fill: #374151 !important;
        }

        /* User dropdown button */
        nav button.inline-flex {
            background:
                {{ request()->routeIs('home') ? 'transparent' : 'white' }}
                !important;
            color:
                {{ request()->routeIs('home') ? 'white' : '#667eea' }}
                !important;
            border: 2px solid
                {{ request()->routeIs('home') ? 'white' : '#667eea' }}
                !important;
            transition: all 0.3s ease;
        }

        #navbar.scrolled button.inline-flex {
            background: white !important;
            color: #667eea !important;
            border: 2px solid #667eea !important;
        }

        nav button.inline-flex:hover {
            background:
                {{ request()->routeIs('home') ? 'rgba(255, 255, 255, 0.2)' : '#f3f4f6' }}
                !important;
        }

        #navbar.scrolled button.inline-flex:hover {
            background: #f3f4f6 !important;
        }

        nav button.inline-flex svg {
            fill:
                {{ request()->routeIs('home') ? 'white' : '#667eea' }}
                !important;
        }

        #navbar.scrolled button.inline-flex svg {
            fill: #667eea !important;
        }

        /* Login/Register buttons */
        .btn-login {
            background: transparent !important;
            color:
                {{ request()->routeIs('home') ? 'white' : '#667eea' }}
                !important;
            border: 2px solid
                {{ request()->routeIs('home') ? 'white' : '#667eea' }}
                !important;
            transition: all 0.3s ease;
        }

        #navbar.scrolled .btn-login {
            color: #667eea !important;
            border: 2px solid #667eea !important;
        }

        .btn-login:hover {
            background:
                {{ request()->routeIs('home') ? 'rgba(255, 255, 255, 0.2)' : '#667eea' }}
                !important;
            color: white !important;
        }

        #navbar.scrolled .btn-login:hover {
            background: #667eea !important;
            color: white !important;
        }

        .btn-register {
            background:
                {{ request()->routeIs('home') ? 'white' : '#667eea' }}
                !important;
            color:
                {{ request()->routeIs('home') ? '#1a1a1a' : 'white' }}
                !important;
            border: 2px solid
                {{ request()->routeIs('home') ? 'white' : '#667eea' }}
                !important;
            transition: all 0.3s ease;
        }

        #navbar.scrolled .btn-register {
            background: #667eea !important;
            color: white !important;
            border: 2px solid #667eea !important;
        }

        .btn-register:hover {
            background:
                {{ request()->routeIs('home') ? '#f3f4f6' : '#764ba2' }}
                !important;
            transform: scale(1.05);
        }

        #navbar.scrolled .btn-register:hover {
            background: #764ba2 !important;
        }

        /* Search icon button */
        .search-icon-btn {
            background: transparent !important;
            color:
                {{ request()->routeIs('home') ? 'white' : '#374151' }}
                !important;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        #navbar.scrolled .search-icon-btn {
            color: #374151 !important;
        }

        .search-icon-btn:hover {
            background:
                {{ request()->routeIs('home') ? 'rgba(255, 255, 255, 0.1)' : '#f3f4f6' }}
                !important;
        }

        #navbar.scrolled .search-icon-btn:hover {
            background: #f3f4f6 !important;
            color: #667eea !important;
        }

        .search-icon-btn svg {
            stroke:
                {{ request()->routeIs('home') ? 'white' : '#374151' }}
                !important;
        }

        #navbar.scrolled .search-icon-btn svg {
            stroke: #374151 !important;
        }

        /* Language switcher button */
        .language-switcher-btn {
            background: transparent !important;
            transition: all 0.3s;
        }

        .language-switcher-btn:hover {
            background:
                {{ request()->routeIs('home') ? 'rgba(255, 255, 255, 0.1)' : '#f3f4f6' }}
                !important;
        }

        #navbar.scrolled .language-switcher-btn:hover {
            background: #f3f4f6 !important;
        }

        /* Dropdown menu content */
        nav [role="menu"] a,
        nav [role="menu"] button,
        nav .absolute a {
            color: #374151 !important;
            background: white;
        }

        nav [role="menu"] a:hover,
        nav .absolute a:hover {
            background: #f3f4f6 !important;
            color: #667eea !important;
        }

        /* Expandable search bar */
        .search-bar-expanded {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: white;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10000;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('navbar');
            const isHomePage = {{ request()->routeIs('home') ? 'true' : 'false' }};  // Only add scroll effect on home page
            if (isHomePage) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between" style="height: 60px;">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('app.home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                        {{ __('app.shop') }}
                    </x-nav-link>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.verification.index')" :active="request()->routeIs('admin.*')">
                                {{ __('app.admin') }}
                            </x-nav-link>
                        @elseif(auth()->user()->store)
                            <x-nav-link :href="route('seller.products.index')" :active="request()->routeIs('seller.*')">
                                {{ __('app.seller') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('wallet.topup')" :active="request()->routeIs('wallet.*')">
                                {{ __('app.wallet') }}
                            </x-nav-link>
                            <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.*')">
                                {{ __('app.history') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Language Switcher -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="language-switcher-btn inline-flex items-center px-2 py-2 border-0 text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                            @if(session('locale', 'id') === 'id')
                                <img src="https://flagcdn.com/w40/id.png" alt="Indonesia"
                                    style="width: 24px; height: 16px; object-fit: cover;">
                            @else
                                <img src="https://flagcdn.com/w40/gb.png" alt="English"
                                    style="width: 24px; height: 16px; object-fit: cover;">
                            @endif
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <a href="{{ route('language.switch', 'id') }}"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                            <img src="https://flagcdn.com/w40/id.png" alt="Indonesia"
                                style="width: 24px; height: 16px; object-fit: cover;">
                            <span>Bahasa Indonesia</span>
                        </a>
                        <a href="{{ route('language.switch', 'en') }}"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                            <img src="https://flagcdn.com/w40/gb.png" alt="English"
                                style="width: 24px; height: 16px; object-fit: cover;">
                            <span>English</span>
                        </a>
                    </x-slot>
                </x-dropdown>

                <!-- Search Icon Button -->
                <button @click="searchOpen = !searchOpen" class="search-icon-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" style="stroke: #374151;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('app.profile') }}
                            </x-dropdown-link>

                            @if(auth()->user()->role === 'member' && !auth()->user()->store)
                                <x-dropdown-link :href="route('wallet.topup')">
                                    {{ __('app.wallet') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('store.register')">
                                    {{ __('app.register_store') }}
                                </x-dropdown-link>
                            @elseif(auth()->user()->store)
                                <x-dropdown-link :href="route('seller.products.index')">
                                    Produk Saya
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('seller.orders.index')">
                                    Pesanan Masuk
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('seller.balance.index')">
                                    Keuangan
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                    {{ __('app.logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}"
                            class="btn-login px-5 py-2 text-sm font-semibold rounded-lg transition-all duration-300">
                            {{ __('app.login') }}
                        </a>
                        <a href="{{ route('register') }}"
                            class="btn-register px-5 py-2 text-sm font-semibold rounded-lg transition-all duration-300">
                            {{ __('app.register') }}
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('app.home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                {{ __('app.shop') }}
            </x-responsive-nav-link>
            @auth
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.verification.index')" :active="request()->routeIs('admin.*')">
                        {{ __('app.admin') }}
                    </x-responsive-nav-link>
                @elseif(auth()->user()->store)
                    <x-responsive-nav-link :href="route('seller.products.index')" :active="request()->routeIs('seller.*')">
                        {{ __('app.seller') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.*')">
                        {{ __('app.history') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('app.profile') }}
                    </x-responsive-nav-link>

                    @if(!auth()->user()->role === 'admin' && !auth()->user()->store)
                        <x-responsive-nav-link :href="route('wallet.topup')">
                            {{ __('app.wallet') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('store.register')">
                            {{ __('app.register_store') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                            {{ __('app.logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" class="block text-gray-700 hover:text-gray-900">{{ __('app.login') }}</a>
                    <a href="{{ route('register') }}"
                        class="block text-gray-700 hover:text-gray-900">{{ __('app.register') }}</a>
                </div>
            </div>
        @endauth
    </div>

    <!-- Expandable Search Bar -->
    <div x-show="searchOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="search-bar-expanded"
        style="display: none;">
        <div class="max-w-7xl mx-auto w-full">
            <form action="{{ route('shop') }}" method="GET" class="flex items-center gap-3 w-full">
                <input type="text" name="search" placeholder="{{ __('app.search_products') }}"
                    value="{{ request('search') }}"
                    class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                    style="color: #374151;">
                <select name="category"
                    class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                    style="color: #374151;">
                    <option value="">{{ __('app.all_categories') }}</option>
                    @php
                        $categories = \App\Models\ProductCategory::all();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-all">
                    {{ __('app.search') }}
                </button>
                <button type="button" @click="searchOpen = false"
                    class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all">
                    {{ __('app.close') }}
                </button>
            </form>
        </div>
    </div>
</nav>