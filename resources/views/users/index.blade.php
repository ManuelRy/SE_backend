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
                        {{-- <th class="p-3 text-center">Sender</th> --}}
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
                            {{-- <td class="p-3 text-center">{{ $user->user_type }}</td> --}}
                            <td class="p-3 text-center">{{ $user->package_size }}</td>
                            <td class="p-3 text-center">{{ $user->pin_code }}</td>
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
                            <td class="p-3 text-center">{{ $user->locker_pin }}</td>
                            <td class="p-3 text-center">{{ $user->locker_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
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

        // Initially set to 'delivery' mode
        filterUsers('delivery');
    </script>
@endsection
