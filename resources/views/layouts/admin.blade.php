<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Tekflow is a task management tool that simplifies task management for teams and professionals.">
    <meta name="keywords" content="task management, productivity, team collaboration, project management">
    <meta name="author" content="Tekflow Team">
    <title>@yield('title', 'Admin Page')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


</head>

<body class="overflow-x-hidden bg-gray-100">

    <div id="loadingScreen" class="fixed inset-0 flex items-center justify-center bg-white z-50">
        <div class="rotating-t text-orange-500">T</div>
    </div>

    <div class="fixed left-0 top-0 w-64 h-full bg-orange-500 p-4 z-50 sidebar-menu transition-transform">
        <a href="#" class="flex items-center pb-4 border-b border-b-white">
            <img src="{{ asset('css/pictures/username.png') }}" alt="ID Card" class="w-8 h-8 rounded ">
            <span class="text-lg font-bold text-white ml-3">Username</span>
        </a>
        <ul class="mt-4">
            <li class="mb-1 group">
                <a href="{{ url('admin/dashboard') }}" 
                class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md 
                {{ Request::is('admin/dashboard') ? 'bg-orange-700 text-white' : '' }}">
                    <img src="{{ asset('css/pictures/home.png') }}" alt="Home" class="w-8 h-8 rounded">
                    <span class="text-sm font-bold ml-3">Home</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="#"
                    class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md group-[.active]:text-white group-[.selected]:bg-orange-700 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <img src="{{ asset('css/pictures/Tasks.png') }}" alt="Tasks" class="w-8 h-8 rounded ">
                    <span class="text-sm font-bold text-white ml-3">Tasks</span>
                    <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                </a>
                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-1 group {{ Request::is('admin/tasks/all-tasks') ? 'active' : '' }}">
                    <a href="{{ url('admin/tasks/all-tasks') }}" class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md {{ Request::is('admin/tasks/all-tasks') ? 'bg-orange-700 text-gray-100' : '' }}">
                            <img src="{{ asset('css/pictures/Tasks.png') }}" alt="All Tasks" class="w-7 h-7 rounded ">
                            <span class="text-sm font-small text-white ml-3">All Tasks</span>
                        </a>
                    </li>
                    <li class="mb-1 group {{ Request::is('admin/tasks/to-do') ? 'active' : '' }}">
                        <a href="{{ url('admin/tasks/to-do') }}" class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md {{ Request::is('admin/tasks/to-do') ? 'bg-orange-700 text-gray-100' : '' }}">
                            <img src="{{ asset('css/pictures/To do (1).png') }}" alt="To do" class="w-7 h-7 rounded ">
                            <span class="text-sm font-small text-white ml-3">To do</span>
                        </a>
                    </li>
                    <li class="mb-1 group {{ Request::is('admin/tasks/in-progress') ? 'active' : '' }}">
                        <a href="{{ url('admin/tasks/in-progress') }}" class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md {{ Request::is('admin/tasks/in-progress') ? 'bg-orange-700 text-gray-100' : '' }}">
                            <img src="{{ asset('css/pictures/In progress.png') }}" alt="In progress" class="w-7 h-7 rounded ">
                            <span class="text-sm font-small text-white ml-3">In progress</span>
                        </a>
                    </li>
                    <li class="mb-1 group {{ Request::is('admin/tasks/completed') ? 'active' : '' }}">
                        <a href="{{ url('admin/tasks/completed') }}" class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md {{ Request::is('admin/tasks/completed') ? 'bg-orange-700 text-gray-100' : '' }}">
                            <img src="{{ asset('css/pictures/completed.png') }}" alt="Completed" class="w-7 h-7 rounded ">
                            <span class="text-sm font-small text-white ml-3">Completed</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="mb-1 group">
                <a href="#"
                    class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md group-[.active]:text-white group-[.selected]:bg-orange-700 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <img src="{{ asset('css/pictures/Users.png') }}" alt="Users" class="w-8 h-8 rounded ">
                    <span class="text-sm font-bold text-white ml-3">Users</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="#"
                    class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md group-[.active]:text-white group-[.selected]:bg-orange-700 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <img src="{{ asset('css/pictures/Settings.png') }}" alt="Settings" class="w-8 h-8 rounded ">
                    <span class="text-sm font-bold text-white ml-3">Settings</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="#"
                    class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md group-[.active]:text-white group-[.selected]:bg-orange-700 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <img src="{{ asset('css/pictures/Trash.png') }}" alt="Trash" class="w-8 h-8 rounded ">
                    <span class="text-sm font-bold text-white ml-3">Trash</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="#"
                    class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md group-[.active]:text-white group-[.selected]:bg-orange-700 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <img src="{{ asset('css/pictures/Report.png') }}" alt="Report" class="w-8 h-8 rounded ">
                    <span class="text-sm font-bold text-white ml-3">Report</span>
                </a>
            </li>
            <!-- Log Out -->
            <li class="mb-1 group">
                <form method="POST" action="">
                    @csrf
                    <button type="submit"
                        class="w-full text-left flex items-center py-2 px-4 text-gray-300 hover:bg-orange-700 hover:text-gray-100 rounded-md">
                        <img src="{{ asset('css/pictures/Log Out.png') }}" alt="Log Out" class="w-8 h-8 rounded">
                        <span class="text-sm font-bold text-white ml-3">Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- Main Content -->
    <main class="w-full min-h-screen">
        @yield('content')
    </main>
    
    <!-- Scripts -->

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: "success",
                title: "Login Successfully!",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif

    <!-- ✅ Dropdown Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Main dropdown (topbar)
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    closeAllDropdowns();
                    const menu = this.closest('.dropdown').querySelector('.dropdown-menu');
                    if (menu) menu.classList.toggle('hidden');
                });
            });

            // Sidebar submenu toggle
            const sidebarToggles = document.querySelectorAll('.sidebar-dropdown-toggle');
            sidebarToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    const parent = this.closest('.group');
                    parent.classList.toggle('selected');
                });
            });

            // Close on outside click
            window.addEventListener('click', () => {
                closeAllDropdowns();
            });

            function closeAllDropdowns() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }

            window.onload = function() {
                document.getElementById('loadingScreen').style.display = 'none';
            };
        });
    </script>
</body>

</html>
