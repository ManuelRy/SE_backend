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
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">First Name</th>
                    <th class="p-3 text-left">Last Name</th>
                    <th class="p-3 text-left">Phone Number</th>
                    <th class="p-3 text-left">User Type</th>
                    <th class="p-3 text-left">Receiver Phone Number</th>
                    <th class="p-3 text-left">Sender Phone Number</th>
                    <th class="p-3 text-left">Locker PIN</th>
                    <th class="p-3 text-left">Locker Numbers</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                @foreach($users as $user)
                    <tr class="border-b border-gray-200 user-row" data-user-type="{{ $user->user_type }}">
                        <td class="p-3">{{ $user->id }}</td>
                        <td class="p-3">{{ $user->first_name }}</td>
                        <td class="p-3">{{ $user->last_name }}</td>
                        <td class="p-3">{{ $user->phone_number }}</td>
                        <td class="p-3">{{ $user->user_type }}</td>
                        <td class="p-3">{{ $user->receiver_phone_number }}</td>
                        <td class="p-3">{{ $user->sender_phone_number }}</td>
                        <td class="p-3">{{ $user->locker_pin }}</td>
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
        rows.forEach(row => {
            if (type === 'all' || row.dataset.userType === type) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection
