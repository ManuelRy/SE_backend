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
                        <path d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m0 2v16h8V4zm2 9h2v4h-2zm0-7h4v1.5h-4zm0 3h4v1.5h-4z" />
                    </svg>
                    <span class="mt-2 ml-4">{{ $locker->locker_number }}</span>
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
