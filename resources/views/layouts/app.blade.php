<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <title>Locker Management</title>
    <style>
        .nav-link {
            @apply flex items-center justify-center p-2 text-gray-700 hover:bg-yellow-100 rounded transition duration-200;
        }

        .nav-link.active {
            @apply bg-yellow-600 text-white;
        }

        .transition-hidden {
            @apply opacity-0 invisible h-0 overflow-hidden;
        }

        .transition-visible {
            @apply opacity-100 visible h-auto;
        }

        .transition-opacity {
            @apply transition-all duration-500 ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col md:flex-row">
        <div class="bg-white text-black w-full md:w-1/5 p-4 flex flex-col">
            <div class="flex items-center justify-between md:flex-col md:items-center mb-4">
                <a href="{{ route('admin.dashboard') }}" class="block h-32 w-32 md:h-40 md:w-40 lg:h-48 lg:w-48 mb-4">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Smartbox Logo"
                        class="h-full w-full object-contain rounded-full">
                </a>
                <button class="md:hidden" onclick="toggleNav()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <ul id="nav-menu" class="hidden md:block text-center transition-opacity">
                @if (Auth::check())
                    <li class="relative mb-6">
                        <button onclick="toggleDropdown()"
                            class="flex items-center justify-center w-12 h-12 bg-yellow-600 rounded-full mx-auto">
                            <span class="sr-only">Admin</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10 11c2.21 0 4-1.79 4-4S12.21 3 10 3 6 4.79 6 7s1.79 4 4 4zm-6 7c0-3.31 2.69-6 6-6s6 2.69 6 6H4z" />
                            </svg>
                        </button>
                        <div id="dropdown"
                            class="hidden absolute bg-white text-black p-2 rounded shadow mt-2 transition-opacity">
                            <a href="{{ route('admin.change_password_form') }}"
                                class="block p-2 hover:bg-yellow-100">Change Password</a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="block p-2 text-left hover:bg-yellow-100">Logout</button>
                            </form>
                        </div>
                    </li>
                @endif
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="m15.583 15.917l1.648-10.78A11.294 11.294 0 0 0 15.584 5C9.553 5 4.666 9.888 4.666 15.917c0 6.03 4.888 10.917 10.917 10.917S26.5 21.946 26.5 15.917c0-.256-.02-.507-.038-.76l-10.88.76zm3.854-12.79l-1.648 10.78l10.878-.76a10.908 10.908 0 0 0-9.23-10.02" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                        </svg>
                        Users
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('lockers.index') }}"
                        class="nav-link {{ request()->is('lockers') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m0 2v16h8V4zm2 9h2v4h-2zm0-7h4v1.5h-4zm0 3h4v1.5h-4z" />
                        </svg>
                        Lockers
                    </a>
                </li>
            </ul>
        </div>
        <div class="w-full md:w-4/5 p-6">
            @yield('content')
        </div>
    </div>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('transition-opacity');
        }

        function toggleNav() {
            const navMenu = document.getElementById('nav-menu');
            navMenu.classList.toggle('hidden');
            navMenu.classList.toggle('block');
            navMenu.classList.toggle('transition-hidden');
            navMenu.classList.toggle('transition-visible');
        }
    </script>
</body>

</html>
