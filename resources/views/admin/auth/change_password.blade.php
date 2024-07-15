<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .background-images {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/assets/images/logo_background_light_new.png') center center / cover no-repeat;
            animation: fadeIn 2s ease-in-out forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .form-container {
            animation: slideIn 1s ease-in-out forwards;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(100px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
    <title>Change Password</title>
</head>

<body class="bg-yellow-100 flex justify-center items-center h-screen relative">
    <div class="background-images"></div>
    <div class="bg-white p-6 rounded shadow-md relative z-10 form-container flex flex-col items-center justify-center w-full sm:w-4/5 md:w-3/5 lg:w-2/5 xl:w-1/3">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Smartbox Logo" class="h-20 sm:h-24 md:h-32 lg:h-40 w-auto mb-4 rounded-full">
        <h2 class="text-2xl mb-4 font-bold text-center text-yellow-700">Change Password</h2>
        <form method="POST" action="{{ route('admin.change_password') }}" class="w-full px-4">
            @csrf
            @if ($errors->any())
            <div class="mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="mb-4">
                <label class="block mb-1 font-bold text-yellow-700" for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-bold text-yellow-700" for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-bold text-yellow-700" for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-yellow-700 text-white font-bold px-4 py-2 rounded hover:bg-yellow-800 transition-colors duration-300">Change Password</button>
            </div>
        </form>
    </div>
</body>

</html>
