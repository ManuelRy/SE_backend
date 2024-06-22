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
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .form-container {
            animation: slideIn 1s ease-in-out forwards;
            width: 70%; /* Adjust width here */
            height: 70%; /* Adjust height here */
        }

        @keyframes slideIn {
            0% { transform: translateY(100px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
    </style>
    
    <title>Change Password</title>
</head>
<body class="bg-yellow-100 flex justify-center items-center h-screen relative">
    <div class="background-images"></div>
    <div class="w-full max-w-5xl relative z-10 form-container bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Smartbox Logo" class="h-50 w-50 mb-4 rounded-full">
        <h2 class="text-2xl mb-4 text-center text-yellow-700">Change Password</h2>
        <form method="POST" action="{{ route('admin.change_password') }}" class="w-full max-w-lg">
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="current_password">
                    Current Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="current_password" type="password" name="current_password" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">
                    New Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="new_password" type="password" name="new_password" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password_confirmation">
                    Confirm New Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="new_password_confirmation" type="password" name="new_password_confirmation" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Change Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>
