@extends('layouts.app')

@section('content')
    <div class="min-h-screen p-6" style="background-color: #FFEDD5;">
        <h1 class="text-3xl mb-6 text-yellow-600 font-bold">Lockers</h1>
        <div class="mb-6 flex space-x-4">
            <button onclick="filterLockers('Small')"
                class="p-3 text-white rounded-lg transition duration-200 {{ request('size') == 'Small' ? 'bg-yellow-600' : 'bg-yellow-500 hover:bg-yellow-600' }}">Small</button>
            <button onclick="filterLockers('Medium')"
                class="p-3 text-white rounded-lg transition duration-200 {{ request('size') == 'Medium' ? 'bg-yellow-600' : 'bg-yellow-500 hover:bg-yellow-600' }}">Medium</button>
            <button onclick="filterLockers('Large')"
                class="p-3 text-white rounded-lg transition duration-200 {{ request('size') == 'Large' ? 'bg-yellow-600' : 'bg-yellow-500 hover:bg-yellow-600' }}">Large</button>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach ($lockers as $locker)
                    <div class="relative flex flex-col items-center group transition-transform transform {{ $locker->status == 'Rented' ? 'hover:scale-110' : '' }}"
                        style="padding: 1rem;" onmouseover="{{ $locker->status == 'Rented' ? 'showInfo(this)' : '' }}"
                        onmouseleave="{{ $locker->status == 'Rented' ? 'hideInfo(this)' : '' }}">
                        <svg class="w-16 h-16 {{ $locker->status == 'Rented' ? 'text-red-500' : 'text-green-500' }} transition-transform transform"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m0 2v16h8V4zm2 9h2v4h-2zm0-7h4v1.5h-4zm0 3h4v1.5h-4z" />
                        </svg>
                        <span class="mt-2 ml-4">{{ $locker->locker_number }}</span>

                        <div
                            class="absolute z-10 p-4 bg-white border rounded-lg shadow-lg w-64 locker-info hidden transition-opacity duration-200 opacity-0 transform -translate-y-4">
                            <p><strong>Locker Number:</strong> {{ $locker->locker_number }}</p>
                            <p><strong>Type:</strong> {{ $locker->user_type }}</p>
                            <p><strong>User:</strong> {{ $locker->phone_number }}</p>
                            <p><strong>Status:</strong> {{ $locker->status }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function filterLockers(size) {
            window.location.href = '{{ route('lockers.index') }}' + '?size=' + size;
        }

        function showInfo(element) {
            const infoBox = element.querySelector('.locker-info');
            infoBox.classList.remove('hidden');
            infoBox.classList.remove('opacity-0');
            infoBox.classList.add('opacity-100');
            element.style.zIndex = 20;

            const rect = infoBox.getBoundingClientRect();
            if (rect.bottom > window.innerHeight) {
                infoBox.style.top = 'auto';
                infoBox.style.bottom = '100%';
                infoBox.style.transform = 'translateY(-0.5rem)';
            } else {
                infoBox.style.top = '100%';
                infoBox.style.bottom = 'auto';
                infoBox.style.transform = 'translateY(-0.5rem)';
            }
        }

        function hideInfo(element) {
            const infoBox = element.querySelector('.locker-info');
            infoBox.classList.add('opacity-0');
            infoBox.classList.remove('opacity-100');
            setTimeout(() => {
                infoBox.classList.add('hidden');
                element.style.zIndex = '';
            }, 200);
        }
    </script>
@endsection
