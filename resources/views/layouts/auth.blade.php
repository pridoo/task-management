<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Auth UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="bg-gray-100 min-h-screen overflow-x-hidden">

    
    <div id="loadingScreen" class="fixed inset-0 flex items-center justify-center bg-white z-50">
        <div class="rotating-t text-orange-500">T</div>
    </div>

    <nav class="bg-white py-7 px-6 md:px-20 flex justify-between items-center">
        <a href="/" class="text-orange-600 font-bold text-xl mr-auto no-underline hover:no-underline focus:no-underline active:no-underline">TEKFLOW</a>
        <div class="space-x-4 ml-auto">
            @auth
                <a href="{{ url('/dashboard') }}" class="border border-orange-500 text-orange-500 px-4 py-2 rounded-lg font-semibold transition-all duration-300 hover:bg-orange-500 hover:text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="border border-orange-500 text-orange-500 px-4 py-2 rounded-lg font-semibold transition-all duration-300 hover:bg-orange-500 hover:text-white">Login</a>
                <a href="{{ route('register') }}" class="unique-button px-4 py-2 rounded-lg font-semibold transition-all duration-300 hover:bg-orange-500 hover:text-white">Register</a>
            @endauth
        </div>
    </nav>

    
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

    
    <footer class="bg-gray-100 py-6 mt-10 flex justify-between items-center px-10">
        <span class="text-gray-500">&copy; {{ date('Y') }} Tekflow. All rights reserved.</span>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700 font-medium">Visit our website for more services</span>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=https://teknainc.com/" 
                alt="QR Code" class="w-16 h-16">
        </div>
    </footer>

    <script>
        window.onload = function() {
            document.getElementById('loadingScreen').style.display = 'none';
        };
    </script>



</body>
</html>

