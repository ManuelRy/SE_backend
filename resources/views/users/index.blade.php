@extends('layouts.app')

@section('content')
    <div class="min-h-screen p-6" style="background-color: #FFEDD5;">
        <h1 class="text-3xl mb-6 text-yellow-600 font-bold">Users</h1>
        <div class="mb-6 flex space-x-4">
            <button id="delivery-btn" onclick="filterUsers('delivery')"
                class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Delivery</button>
            <button id="storage-btn" onclick="filterUsers('storage')"
                class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Storage</button>
        </div>

        <!-- New Search Form Design -->
        <form method="GET" action="{{ route('users.index') }}" class="max-w-md mb-6">
            <input type="hidden" id="section" name="section" value="{{ $section }}">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="query"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                    placeholder="Search users..." value="{{ request('query') }}" />
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Search</button>
            </div>
        </form>

        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <div id="delivery-container">
                <table id="delivery-table" class="w-full">
                    <thead class="bg-yellow-100 text-yellow-600">
                        <tr>
                            <th class="p-3 text-center">Receiver</th>
                            <th class="p-3 text-center">Package Size</th>
                            <th class="p-3 text-center">Locker PIN</th>
                            <th class="p-3 text-center">Locker Numbers</th>
                            <th class="p-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveryUsers as $user)
                            <tr class="border-b border-gray-200">
                                <td class="p-3 text-center">{{ $user->receiver }}</td>
                                <td class="p-3 text-center">{{ $user->package_size }}</td>
                                <td class="p-3 text-center">{{ $user->pin_code }}</td>
                                <td class="p-3 text-center">{{ $user->locker_number }}</td>
                                <td class="p-3 text-center">
                                    @if ($user->is_used)
                                        <span class="status received">Received</span>
                                    @else
                                        <span class="status stored">Stored</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    @if (empty($query))
                        {{ $deliveryUsers->appends(['query' => request('query'), 'section' => 'delivery', 'page_storage' => request('page_storage')])->links() }}
                    @endif
                </div>
            </div>

            <div id="storage-container" style="display:none;">
                <table id="storage-table" class="w-full">
                    <thead class="bg-yellow-100 text-yellow-600">
                        <tr>
                            <th class="p-3 text-center">User</th>
                            <th class="p-3 text-center">Storage Size</th>
                            <th class="p-3 text-center">Storage PIN</th>
                            <th class="p-3 text-center">Locker Number</th>
                            <th class="p-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storageUsers as $user)
                            <tr class="border-b border-gray-200">
                                <td class="p-3 text-center">{{ $user->user }}</td>
                                <td class="p-3 text-center">{{ $user->storage_size }}</td>
                                <td class="p-3 text-center">{{ $user->locker_pin }}</td>
                                
                                <td class="p-3 text-center">{{ $user->locker_number }}</td>
                                <td class="p-3 text-center">
                                    @if ($user->is_used)
                                        <span class="status taken-out">Taken Out</span>
                                    @else
                                        <span class="status stored">Stored</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    @if (empty($query))
                        {{ $storageUsers->appends(['query' => request('query'), 'section' => 'storage', 'page_delivery' => request('page_delivery')])->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Password Prompt Modal -->
    <div id="passwordModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl mb-4">Enter Admin Password</h2>
            <input type="password" id="adminPassword" class="w-full p-2 border rounded-lg mb-4" placeholder="Password"
                onkeydown="handleKeyDown(event)">
            <button onclick="verifyPassword()"
                class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Submit</button>
            <button onclick="closeModal()"
                class="p-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">Cancel</button>
        </div>
    </div>

    <script>
        let currentElement;

        function filterUsers(type) {
            const deliveryContainer = document.getElementById('delivery-container');
            const storageContainer = document.getElementById('storage-container');
            const deliveryBtn = document.getElementById('delivery-btn');
            const storageBtn = document.getElementById('storage-btn');
            const sectionInput = document.getElementById('section');

            if (type === 'delivery') {
                deliveryContainer.style.display = '';
                storageContainer.style.display = 'none';
                deliveryBtn.classList.add('bg-yellow-600');
                storageBtn.classList.remove('bg-yellow-600');
                sectionInput.value = 'delivery';
            } else if (type === 'storage') {
                deliveryContainer.style.display = 'none';
                storageContainer.style.display = '';
                storageBtn.classList.add('bg-yellow-600');
                deliveryBtn.classList.remove('bg-yellow-600');
                sectionInput.value = 'storage';
            }
        }

        function promptPassword(element) {
            currentElement = element;
            document.getElementById('passwordModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('passwordModal').style.display = 'none';
        }

        function handleKeyDown(event) {
            if (event.key === 'Enter') {
                verifyPassword();
            }
        }

        // Initially set to the appropriate section
        document.addEventListener('DOMContentLoaded', function() {
            const section = '{{ request('section', 'delivery') }}';
            filterUsers(section);
        });
    </script>

    <style>
        .locker-pin {
            cursor: pointer;
            color: #3182ce;
            /* blue */
        }

        .locker-pin:hover {
            text-decoration: underline;
        }

        /* Active button styles */
        .bg-yellow-600 {
            background-color: #D97706;
        }

        /* Responsive styles for status */
        .status {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-align: center;
        }

        .status.received, .status.taken-out {
            background-color: #16a34a;
            color: #ffffff;
        }

        .status.stored {
            background-color: #dc2626;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .status {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }

            td, th {
                padding: 0.5rem;
            }
        }
    </style>
@endsection
