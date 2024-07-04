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
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Smartbox Logo" class="h-full w-full object-contain rounded-full">
                </a>
                <button class="md:hidden" onclick="toggleNav()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <ul id="nav-menu" class="hidden md:block text-center transition-opacity">
                @if (Auth::check())
                <li class="relative mb-6">
                    <button onclick="toggleDropdown()" class="flex items-center justify-center w-12 h-12 bg-yellow-600 rounded-full mx-auto">
                        <span class="sr-only">Admin</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 11c2.21 0 4-1.79 4-4S12.21 3 10 3 6 4.79 6 7s1.79 4 4 4zm-6 7c0-3.31 2.69-6 6-6s6 2.69 6 6H4z" />
                        </svg>
                    </button>
                    <div id="dropdown" class="hidden absolute bg-white text-black p-2 rounded shadow mt-2 transition-opacity">
                        <a href="{{ route('admin.change_password_form') }}" class="block p-2 hover:bg-yellow-100">Change Password</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="block p-2 text-left hover:bg-yellow-100">Logout</button>
                        </form>
                    </div>
                </li>
                @endif
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9m0 0l9 9M4 10h16v10H4V10z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10-4a5 5 0 11-10 0 5 5 0 0110 0z" />
                        </svg>
                        Users
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('lockers.index') }}" class="nav-link {{ request()->is('lockers') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7a3 3 0 116 0v10a3 3 0 11-6 0z" />
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
            dropdown.classList.toggle('visible');
        }

        function toggleNav() {
            const navMenu = document.getElementById('nav-menu');
            navMenu.classList.toggle('transition-hidden');
            navMenu.classList.toggle('transition-visible');
        }
    </script>
</body>

</html>
