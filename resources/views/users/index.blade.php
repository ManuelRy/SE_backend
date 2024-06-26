@extends('layouts.app')

@section('content')
<div class="min-h-screen p-6" style="background-color: #FFEDD5;">
    <h1 class="text-3xl mb-6 text-yellow-600 font-bold">Users</h1>
    <div class="mb-6 flex space-x-4">
        <button onclick="filterUsers('delivery')" class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Delivery</button>
        <button onclick="filterUsers('storage')" class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Storage</button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <table class="w-full">
            <thead class="bg-yellow-100 text-yellow-600">
                <tr id="table-header">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left" id="sender-header">Sender</th>
                    <th class="p-3 text-left">User Type</th>
                    <th class="p-3 text-left" id="receiver-header">Receiver</th>
                    <th class="p-3 text-left" id="locker-pin-header">Locker PIN</th>
                    <th class="p-3 text-left">Locker Numbers</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                @foreach($users as $user)
                    <tr class="border-b border-gray-200 user-row" data-user-type="{{ $user->user_type }}">
                        <td class="p-3">{{ $user->id }}</td>
                        <td class="p-3 sender-cell">{{ $user->phone_number }}</td>
                        <td class="p-3">{{ $user->user_type }}</td>
                        <td class="p-3 receiver-cell">{{ $user->receiver_phone_number }}</td>
                        <td class="p-3 locker-pin-cell">{{ $user->locker_pin }}</td>
                        <td class="p-3">
                            @foreach($user->lockers as $locker)
                                {{ $locker->locker_number }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterUsers(type) {
        const rows = document.querySelectorAll('.user-row');
        const senderHeader = document.getElementById('sender-header');
        const receiverHeader = document.getElementById('receiver-header');
        const lockerPinHeader = document.getElementById('locker-pin-header');
        const lockerPinCells = document.querySelectorAll('.locker-pin-cell');
        const receiverCells = document.querySelectorAll('.receiver-cell');

        if (type === 'delivery') {
            senderHeader.textContent = 'Sender';
            receiverHeader.style.display = '';
            lockerPinHeader.style.display = 'none';
            receiverCells.forEach(cell => cell.style.display = '');
            lockerPinCells.forEach(cell => cell.style.display = 'none');
        } else if (type === 'storage') {
            senderHeader.textContent = 'User';
            receiverHeader.style.display = 'none';
            lockerPinHeader.style.display = '';
            receiverCells.forEach(cell => cell.style.display = 'none');
            lockerPinCells.forEach(cell => cell.style.display = '');
        }

        rows.forEach(row => {
            if (type === 'all' || row.dataset.userType === type) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Initially set to 'delivery' mode
    filterUsers('delivery');
</script>
@endsection
