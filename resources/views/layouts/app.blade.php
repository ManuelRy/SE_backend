<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <title>Locker Management</title>
    <style>
        .nav-link {
            @apply flex items-center justify-center md:justify-start p-2 text-gray-700 hover:bg-yellow-100 rounded transition duration-200;
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

        .compact-navbar {
            max-height: 12rem;
        }

        .hidden-sidebar {
            @apply hidden;
        }

        .show-sidebar {
            @apply flex;
        }

        .expanded-content {
            width: 100% !important;
        }

        .toggle-button {
            @apply p-2 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none transition duration-300 ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-white text-black w-full md:w-1/5 p-2 flex flex-col transition-all duration-300 ease-in-out">
            <div class="flex items-center justify-between md:flex-col md:items-center mb-2">
                <a href="{{ route('admin.dashboard') }}" class="block h-32 w-32 md:h-40 md:w-40 lg:h-48 lg:w-48 mb-2">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Smartbox Logo" class="h-full w-full object-contain rounded-full">
                </a>
                <button class="md:hidden toggle-button" onclick="toggleNav()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div id="profile-settings" class="relative mb-4 text-center hidden md:block">
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
            </div>
            <ul id="nav-menu" class="hidden md:block text-center transition-opacity">
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 32 32">
                            <path fill="currentColor" d="m15.583 15.917l1.648-10.78A11.294 11.294 0 0 0 15.584 5C9.553 5 4.666 9.888 4.666 15.917c0 6.03 4.888 10.917 10.917 10.917S26.5 21.946 26.5 15.917c0-.256-.02-.507-.038-.76l-10.88.76zm3.854-12.79l-1.648 10.78l10.878-.76a10.908 10.908 0 0 0-9.23-10.02" />
                        </svg>
                        <span class="md:hidden lg:inline">Dashboard</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                        </svg>
                        <span class="md:hidden lg:inline">Users</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('lockers.index') }}" class="nav-link {{ request()->is('lockers') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m0 2v16h8V4zm2 9h2v4h-2zm0-7h4v1.5h-4zm0 3h4v1.5h-4z" />
                        </svg>
                        <span class="md:hidden lg:inline">Lockers</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Main content -->
        <div id="main-content" class="w-full md:w-4/5 p-6 transition-all duration-300 ease-in-out">
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
            const profileSettings = document.getElementById('profile-settings');
            navMenu.classList.toggle('hidden');
            navMenu.classList.toggle('block');
            navMenu.classList.toggle('transition-hidden');
            navMenu.classList.toggle('transition-visible');
            profileSettings.classList.toggle('hidden');
            profileSettings.classList.toggle('transition-hidden');
            profileSettings.classList.toggle('transition-visible');
            navMenu.classList.toggle('compact-navbar');
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const profileSettings = document.getElementById('profile-settings');
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('expanded-content');

            if (sidebar.classList.contains('hidden')) {
                profileSettings.classList.add('hidden');
            } else {
                profileSettings.classList.remove('hidden');
            }

            mainContent.classList.add('transition-all');
            mainContent.classList.add('duration-300');
            mainContent.classList.add('ease-in-out');
        }

        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const navMenu = document.getElementById('nav-menu');
            const profileSettings = document.getElementById('profile-settings');

            if (window.innerWidth >= 768) {
                sidebar.classList.remove('hidden');
                mainContent.classList.remove('expanded-content');
                navMenu.classList.remove('hidden');
                profileSettings.classList.remove('hidden');
            } else {
                if (!sidebar.classList.contains('hidden')) {
                    mainContent.classList.add('expanded-content');
                }
                navMenu.classList.add('hidden');
                profileSettings.classList.add('hidden');
            }
        }

        window.addEventListener('resize', handleResize);

        document.addEventListener("DOMContentLoaded", function () {
            handleResize();
        });
    </script>
</body>

</html>
