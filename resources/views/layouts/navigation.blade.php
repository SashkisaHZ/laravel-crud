<nav x-data="{ open: false }" class="custom-nav">
    <style>
        .custom-nav {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            height: 64px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left, .nav-right {
            display: flex;
            align-items: center;
        }

        .nav-left a {
            margin-right: 16px;
            text-decoration: none;
            font-weight: 500;
            color: #374151;
        }

        .nav-left a:hover {
            color: #2563eb;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
        }

        .brand:hover {
            color: #1d4ed8;
        }

        .dropdown-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: white;
            color: #4b5563;
            cursor: pointer;
        }

        .dropdown-btn:hover {
            border-color: #9ca3af;
            color: #1f2937;
        }

        .dropdown-icon {
            margin-left: 6px;
            width: 16px;
            height: 16px;
        }

        .responsive-menu {
            display: none;
            border-top: 1px solid #e5e7eb;
            background-color: white;
        }

        .responsive-menu.open {
            display: block;
        }

        .responsive-menu .user-info {
            padding: 16px;
        }

        .responsive-menu a {
            display: block;
            padding: 10px 16px;
            font-size: 16px;
            text-decoration: none;
            color: #374151;
            border-radius: 6px;
        }

        .responsive-menu a:hover {
            background-color: #f3f4f6;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
        }

        .hamburger svg {
            width: 24px;
            height: 24px;
            stroke: #4b5563;
        }

        @media (max-width: 640px) {
            .nav-right {
                display: none;
            }

            .hamburger {
                display: block;
            }
        }
    </style>

    <div class="nav-container">
        <!-- Left -->
        <div class="nav-left">
            <a href="/" class="brand">MyPosts</a>
            <a href="/posts">All Posts</a>
            <a href="/posts/create">Create</a>
        </div>

        <!-- Right (Dropdown) -->
        <div class="nav-right">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="dropdown-btn">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="dropdown-icon">
                            <svg class="fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Hamburger Menu Button -->
        <div class="hamburger">
            <button @click="open = ! open">
                <svg fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{ 'open': open }" class="responsive-menu">
        <div class="user-info">
            <div class="font-medium">{{ Auth::user()->name }}</div>
            <div class="font-small text-gray-500">{{ Auth::user()->email }}</div>
        </div>
        <div class="nav-links">
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>

            <a href="/posts">All Posts</a>
            <a href="/posts/create">Create</a>
        </div>
    </div>
</nav>
