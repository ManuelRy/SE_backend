<!-- lockers/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen p-6" style="background-color: #FFEDD5;">
    <h1 class="text-3xl mb-6 text-yellow-600 font-bold">Lockers</h1>
    <div class="mb-6 flex space-x-4">
        <button onclick="filterLockers('Small')" class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Small</button>
        <button onclick="filterLockers('Medium')" class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Medium</button>
        <button onclick="filterLockers('Large')" class="p-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">Large</button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($lockers as $locker)
                <div class="flex flex-col items-center">
                    <svg class="w-16 h-16 {{ $locker->status == 'Rented' ? 'text-red-500' : 'text-green-500' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a6 6 0 00-6 6v4a6 6 0 00-1 11.94V20h14v-.06A6 6 0 0016 10V6a6 6 0 00-6-6zM9 18v-2h2v2H9zm2-4H9v-2h2v2zm2-4H7V6a4 4 0 018 0v4z" />
                    </svg>
                    <span class="mt-2">{{ $locker->locker_number }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function filterLockers(size) {
        window.location.href = '{{ route('lockers.index') }}' + '?size=' + size;
    }
</script>
@endsection
