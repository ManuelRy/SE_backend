
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl mb-4">Dashboard</h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl">Users</h2>
            <p class="text-4xl">{{ $userCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl">Lockers</h2>
            <p class="text-4xl">{{ $lockerCount }}</p>
        </div>
    </div>
@endsection
