@extends('layouts.admin')
@section('content')

    <body class="text-gray-800 font-inter">
        <!-- start: Main -->
        <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main overflow-y-auto">
            <!-- Added overflow-y-auto here for scrolling -->
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
                        <div
                            class="msg-menu absolute right-0 mt-2 hidden max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                            <div class="px-4 pt-4 border-b border-b-gray-100">
                                <div class="text-gray-600 text-sm font-semibold mb-2">Messages</div>
                            </div>
                            <ul class="my-2 max-h-64 overflow-y-auto">
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <div
                                            class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                            <i class="ri-user-3-line"></i>
                                        </div>
                                        <div class="ml-2">
                                            <div
                                                class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                                John Doe</div>
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
                        <div
                            class="notif-menu absolute right-0 mt-2 hidden max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                            <div class="px-4 pt-4 border-b border-b-gray-100">
                                <div class="text-gray-600 text-sm font-semibold mb-2">Notifications</div>
                            </div>
                            <ul class="my-2 max-h-64 overflow-y-auto">
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <div
                                            class="w-8 h-8 bg-yellow-500 text-white flex items-center justify-center rounded-full">
                                            <i class="ri-checkbox-circle-line"></i>
                                        </div>
                                        <div class="ml-2">
                                            <div
                                                class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                                Tasks completed</div>
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
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Messages</h2>
                </div>

                <div class="h-screen flex flex-col">
                    <div class="bg-gray-200 flex-1 overflow-y-scroll">
                        <div class="px-4 py-2">
                            <div class="flex items-center mb-2">
                                <img class="w-8 h-8 rounded-full mr-2" src="https://picsum.photos/50/50" alt="User Avatar">
                                <div class="font-medium">John Doe</div>
                            </div>
                            <div class="bg-white rounded-lg p-2 shadow mb-2 max-w-sm">
                                Hi, how can I help you?
                            </div>
                            <div class="flex items-center justify-end">
                                <div class="bg-blue-500 text-white rounded-lg p-2 shadow mr-2 max-w-sm">
                                    Sure, I can help with that.
                                </div>
                                <img class="w-8 h-8 rounded-full" src="https://picsum.photos/50/50" alt="User Avatar">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 px-4 py-2">
                        <div class="flex items-center">
                            <input class="w-full border rounded-full py-2 px-4 mr-2" type="text"
                                placeholder="Type your message...">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-full">
                                Send
                            </button>
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