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

    <nav class="bg-white py-7 px-6 md:px-20 flex items-center justify-between relative">
        <!-- Logo -->
        <a class="flex items-center text-2xl font-black" href="/">
            <span class="mr-2 text-3xl text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 64 64" width="1em"
                    height="1em">
                    <path d="M2 32c7 0 7-12 14-12s7 12 14 12 7-12 14-12 7 12 14 12" stroke="currentColor"
                        stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M2 40c7 0 7 12 14 12s7-12 14-12 7 12 14 12 7-12 14-12" stroke="currentColor"
                        stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <span class="font-extrabold text-orange-600">TEKFLOW</span>
        </a>

        <!-- Hamburger (shown only on small screens) -->
        <input type="checkbox" id="menu-toggle" class="peer hidden" />
        <label for="menu-toggle" class="sm:hidden cursor-pointer text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 448 512" fill="currentColor">
                <path
                    d="M0 96c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zm0 160c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm416 192H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
            </svg>
        </label>

        <!-- Nav Links -->
        <div
            class="hidden peer-checked:flex flex-col sm:flex sm:flex-row gap-4 sm:gap-4 mt-4 sm:mt-0 absolute sm:static top-full right-6 sm:right-0 bg-white sm:bg-transparent p-4 sm:p-0 rounded-lg shadow sm:shadow-none z-10">
            <a class="rounded-xl border-2 border-orange-600 px-6 py-2 font-medium text-white bg-orange-600 hover:bg-white hover:text-orange-600"
            href="{{ route('login') }}">Login</a>
            <a class="rounded-xl border-2 border-orange-600 px-6 py-2 font-medium text-orange-600 bg-white hover:bg-orange-600 hover:text-white"
            href="{{ route('register') }}">Get Started</a>
        </div>
    </nav>


    
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

    
    <footer class="bg-gray-100 py-6 mt-10 flex justify-between items-center px-10">
        <span class="text-gray-500">&copy; {{ date('Y') }} Tekflow. All rights reserved.</span>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700 font-medium">Visit our website for more services</span>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=https://teknainc.com/" alt="QR Code"
                class="w-16 h-16">
        </div>
    </footer>

    <script>
        window.onload = function() {
            document.getElementById('loadingScreen').style.display = 'none';
        };
    </script>



</body>
</html>

