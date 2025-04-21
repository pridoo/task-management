@extends('layouts.admin')
@section('content')

<body class="text-gray-800 font-inter">
    <!-- start: Main -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main overflow-y-auto"> <!-- Added overflow-y-auto here for scrolling -->
        <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Admin Dashboard</a>
                </li>
            </ul>
            <ul class="ml-auto flex items-center">

                <li class="relative">
                    <button type="button"
                        class="msg-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                        <i class="ri-chat-1-line"></i>
                    </button>
                    <div class="msg-menu absolute right-0 mt-2 hidden max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                        <div class="px-4 pt-4 border-b border-b-gray-100">
                            <div class="text-gray-600 text-sm font-semibold mb-2">Messages</div>
                        </div>
                        <ul class="my-2 max-h-64 overflow-y-auto">
                            <li>
                                <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                    <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                        <i class="ri-user-3-line"></i>
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">John Doe</div>
                                        <div class="text-[11px] text-gray-400">Hello there!</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="relative ml-4">
                    <button type="button"
                        class="notif-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                        <i class="ri-notification-4-line"></i>
                    </button>
                    <div class="notif-menu absolute right-0 mt-2 hidden max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                        <div class="px-4 pt-4 border-b border-b-gray-100">
                            <div class="text-gray-600 text-sm font-semibold mb-2">Notifications</div>
                        </div>
                        <ul class="my-2 max-h-64 overflow-y-auto">
                            <li>
                                <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                    <div class="w-8 h-8 bg-yellow-500 text-white flex items-center justify-center rounded-full">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">Tasks completed</div>
                                        <div class="text-[11px] text-gray-400">from a user</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-blue-500 rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1 text-white">10</div>
                            <div class="text-sm font-medium text-white">Total Tasks</div>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-white hover:text-gray-600"><i
                                    class="ri-more-fill"></i></button>
                            <ul
                                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href=""
                                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">View
                                        Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-green-500 rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold text-white">324</div>
                            </div>
                            <div class="text-sm font-medium text-white">Completed Tasks</div>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-white hover:text-gray-600"><i
                                    class="ri-more-fill"></i></button>
                            <ul
                                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">View
                                        Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-500 rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold text-white">324</div>
                            </div>
                            <div class="text-sm font-medium text-white">Tasks in Progress</div>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-white hover:text-gray-600"><i
                                    class="ri-more-fill"></i></button>
                            <ul
                                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">View
                                        Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-red-500 rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold text-white">324</div>
                            </div>
                            <div class="text-sm font-medium text-white">To Do</div>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-white hover:text-gray-600"><i
                                    class="ri-more-fill"></i></button>
                            <ul
                                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">View
                                        Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Reminder</h2>
                <button class="text-sm text-blue-500 hover:underline">View All</button>
            </div>

            <div class="overflow-x-auto rounded-md">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-500">
                        <tr>
                            <th scope="col" class="px-4 py-3 rounded-tl-md">Task</th>
                            <th scope="col" class="px-4 py-3">Assigned To</th>
                            <th scope="col" class="px-4 py-3">Priority</th>
                            <th scope="col" class="px-4 py-3">Stage</th>
                            <th scope="col" class="px-4 py-3">Deadline</th>
                            <th scope="col" class="px-4 py-3 rounded-tr-md">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Sample row -->
                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="px-4 py-3 font-medium text-gray-800">Things to create</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-1">
                                    <!-- Placeholder Avatars -->
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="text-gray-400 font-bold text-lg leading-none">+</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-xs font-medium text-yellow-500">Medium Priority</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">To do</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">Fri, 03 Jan 7:00 AM</td>
                            <td class="px-4 py-3 italic text-gray-500">Late</td>
                        </tr>

                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="px-4 py-3 font-medium text-gray-800">Things to create</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-1">
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="text-gray-400 font-bold text-lg leading-none">+</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-xs font-medium text-red-500">High Priority</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">To do</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">Fri, 03 Jan 7:00 AM</td>
                            <td class="px-4 py-3 italic text-gray-500">Pending</td>
                        </tr>

                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="px-4 py-3 font-medium text-gray-800">Things to create</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-1">
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="w-6 h-6 bg-gray-300 rounded-full inline-block"></span>
                                    <span class="text-gray-400 font-bold text-lg leading-none">+</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-xs font-medium text-blue-500">Low Priority</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-400 text-white">In progress</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">Fri, 03 Jan 7:00 AM</td>
                            <td class="px-4 py-3 italic text-gray-500">Late</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination (optional) -->
            <div class="flex justify-end mt-4 space-x-2">
                <button class="w-10 h-10 border rounded-md text-gray-500 hover:bg-gray-100">&lt;</button>
                <button class="w-10 h-10 border rounded-md text-gray-500 hover:bg-gray-100">&gt;</button>
            </div>
        </div>

        </div>
    </main>

    <!-- Inline JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const notifBtn = document.querySelector(".notif-btn");
            const notifMenu = document.querySelector(".notif-menu");

            const msgBtn = document.querySelector(".msg-btn");
            const msgMenu = document.querySelector(".msg-menu");

            notifBtn?.addEventListener("click", function (e) {
                e.stopPropagation();
                notifMenu.classList.toggle("hidden");
                msgMenu?.classList.add("hidden");
            });

            msgBtn?.addEventListener("click", function (e) {
                e.stopPropagation();
                msgMenu.classList.toggle("hidden");
                notifMenu?.classList.add("hidden");
            });

            // Hide menus when clicking outside
            document.addEventListener("click", function (e) {
                if (!notifMenu.contains(e.target) && !notifBtn.contains(e.target)) {
                    notifMenu.classList.add("hidden");
                }
                if (!msgMenu.contains(e.target) && !msgBtn.contains(e.target)) {
                    msgMenu.classList.add("hidden");
                }
            });
        });
    </script>
</body>

@endsection