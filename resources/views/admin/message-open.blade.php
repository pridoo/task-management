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
                </li>
            </ul>
        </div>

        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Messages</h2>
            </div>

            <div class="h-screen flex flex-col">
                <div class="bg-gray-200 flex-1 overflow-y-scroll">
                    <div class="px-6 py-4">
                        <!-- Conversation Header -->
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Conversation with John Doe</h3>
                                <p class="text-sm text-gray-500">Subject: How can I assist you?</p>
                            </div>
                            <button class="bg-blue-500 text-white rounded-md px-4 py-2 text-sm">Mark as Read</button>
                        </div>

                        <!-- Messages List -->
                        <div class="flex flex-col space-y-4">
                            <!-- Received Message -->
                            <div class="flex items-start">
                                <img class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/50/50" alt="User Avatar">
                                <div class="bg-white p-4 rounded-lg shadow-md max-w-xs">
                                    <p class="text-gray-600">Hi, how can I help you?</p>
                                    <span class="text-xs text-gray-400">Sent at 2:30 PM</span>
                                </div>
                            </div>

                            <!-- Sent Message -->
                            <div class="flex items-start justify-end">
                                <div class="bg-blue-100 p-4 rounded-lg shadow-md max-w-xs">
                                    <p class="text-gray-600">Sure, I can help with that.</p>
                                    <span class="text-xs text-gray-400">Sent at 2:32 PM</span>
                                </div>
                                <img class="w-10 h-10 rounded-full ml-3" src="https://picsum.photos/50/50" alt="User Avatar">
                            </div>

                            <!-- Another Received Message -->
                            <div class="flex items-start">
                                <img class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/50/50" alt="User Avatar">
                                <div class="bg-white p-4 rounded-lg shadow-md max-w-xs">
                                    <p class="text-gray-600">Is there anything else you need?</p>
                                    <span class="text-xs text-gray-400">Sent at 2:35 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message Input Field -->
                <div class="bg-gray-100 px-6 py-4">
                    <div class="flex items-center">
                        <input class="w-full border border-gray-300 rounded-lg py-2 px-4 mr-2 focus:ring-blue-500 focus:border-blue-500"
                            type="text" placeholder="Type your message..." />
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg">
                            Send
                        </button>
                    </div>
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
