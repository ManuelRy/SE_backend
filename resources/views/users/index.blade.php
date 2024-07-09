@extends('layouts.app')

@section('content')
    <div class="min-h-screen p-6" style="background-color: #FFEDD5;">
        <h1 class="text-3xl mb-6 text-yellow-600 font-bold">Users</h1>
        <div class="mb-6 flex space-x-4">
            <button onclick="filterUsers('delivery')"
                class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Delivery</button>
            <button onclick="filterUsers('storage')"
                class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Storage</button>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <table id="delivery-table" class="w-full">
                <thead class="bg-yellow-100 text-yellow-600">
                    <tr>
                        <th class="p-3 text-center">ID</th>
                        <th class="p-3 text-center">Receiver</th>
                        <th class="p-3 text-center">Package Size</th>
                        <th class="p-3 text-center">Locker PIN</th>
                        <th class="p-3 text-center">Locker Numbers</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveryUsers as $user)
                        <tr class="border-b border-gray-200">
                            <td class="p-3 text-center">{{ $user->id }}</td>
                            <td class="p-3 text-center">{{ $user->receiver }}</td>
                            <td class="p-3 text-center">{{ $user->package_size }}</td>
                            <td class="p-3 text-center">
                                <span class="locker-pin" onclick="promptPassword(this)" data-pin="{{ $user->pin_code }}">****</span>
                            </td>
                            <td class="p-3 text-center">{{ $user->locker_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table id="storage-table" class="w-full" style="display:none;">
                <thead class="bg-yellow-100 text-yellow-600">
                    <tr>
                        <th class="p-3 text-center">ID</th>
                        <th class="p-3 text-center">User</th>
                        <th class="p-3 text-center">Storage Size</th>
                        <th class="p-3 text-center">Locker PIN</th>
                        <th class="p-3 text-center">Locker Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storageUsers as $user)
                        <tr class="border-b border-gray-200">
                            <td class="p-3 text-center">{{ $user->id }}</td>
                            <td class="p-3 text-center">{{ $user->user }}</td>
                            <td class="p-3 text-center">{{ $user->storage_size }}</td>
                            <td class="p-3 text-center">
                                <span class="locker-pin" onclick="promptPassword(this)" data-pin="{{ $user->locker_pin }}">****</span>
                            </td>
                            <td class="p-3 text-center">{{ $user->locker_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Password Prompt Modal -->
    <div id="passwordModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl mb-4">Enter Admin Password</h2>
            <input type="password" id="adminPassword" class="w-full p-2 border rounded-lg mb-4" placeholder="Password">
            <button onclick="verifyPassword()" class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Submit</button>
            <button onclick="closeModal()" class="p-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">Cancel</button>
        </div>
    </div>

    <script>
        let currentElement;

        function filterUsers(type) {
            const deliveryTable = document.getElementById('delivery-table');
            const storageTable = document.getElementById('storage-table');

            if (type === 'delivery') {
                deliveryTable.style.display = '';
                storageTable.style.display = 'none';
            } else if (type === 'storage') {
                deliveryTable.style.display = 'none';
                storageTable.style.display = '';
            }
        }

        function promptPassword(element) {
            currentElement = element;
            document.getElementById('passwordModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('passwordModal').style.display = 'none';
        }

        function verifyPassword() {
            const password = document.getElementById('adminPassword').value;
            fetch('{{ route("admin.verifyPassword") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ password: password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentElement.innerText = currentElement.getAttribute('data-pin');
                } else {
                    alert('Incorrect password.');
                }
                closeModal();
            })
            .catch(error => console.error('Error:', error));
        }

        // Initially set to 'delivery' mode
        filterUsers('delivery');
    </script>

    <style>
        .locker-pin {
            cursor: pointer;
            color: #3182ce; /* blue */
        }
        .locker-pin:hover {
            text-decoration: underline;
        }
    </style>
@endsection
