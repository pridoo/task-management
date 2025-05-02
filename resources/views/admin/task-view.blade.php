@extends('layouts.admin')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

    <div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

        <!-- Header -->
        <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
            <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
                <div class="flex justify-end items-center">
                    <ul class="flex items-center space-x-4">

                        <!-- Messages -->
                        <li class="relative" x-data="{ open: false }" x-init="open = false">
                            <button @click="open = !open"
                                class="msg-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                                <i class="ri-chat-1-line"></i>
                            </button>
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                                <div class="px-4 pt-4 border-b border-gray-100">
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

                        <!-- Notifications -->
                        <li class="relative" x-data="{ open: false }" x-init="open = false">
                            <button @click="open = !open"
                                class="notif-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                                <i class="ri-notification-4-line"></i>
                            </button>
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                                <div class="px-4 pt-4 border-b border-gray-100">
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
            </div>
        </header>

        <main class="pt-24 px-6 ml-64">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Task View</h2>
            </div>

            <!-- Adapted Responsive Container -->
            <div class="mx-auto max-w-[90%] md:max-w-[1050px] p-6 bg-white border border-[#4444] rounded-lg">

                <div class="text-[#444] text-base font-bold mb-4 flex items-center gap-2">
                    <a href="#" class="hover:text-blue-600">
                        <i class="bi bi-arrow-left w-4 h-4 text-[#444]"></i>
                    </a>
                </div>

                <!-- Title -->
                <div class="text-[#444] text-base font-bold flex items-center gap-2">
                    <span class="mt-2">Task Title Example</span>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <div class="flex justify-between items-center">
                    <!-- Status -->
                    <button class="mb-4 px-6 py-2 text-white text-xs rounded-lg bg-yellow-400">
                        In-progress
                    </button>

                    <!-- Priority -->
                    <span class="text-[11px] flex items-center gap-1 text-yellow-500">
                        🟡
                        <span>Medium Priority</span>
                    </span>
                </div>

                <!-- Start and End Dates -->
                <div class="flex flex-wrap items-center gap-x-8 text-sm text-[#444] mb-4">
                    <div class="flex gap-1 font-semibold">
                        <span>Start Date:</span>
                        <span class="font-light">Monday, April 28, 2025 09:00 AM</span>
                    </div>
                    <div class="flex gap-1 font-semibold">
                        <span>End Date:</span>
                        <span class="font-light">Friday, May 2, 2025 05:00 PM</span>
                    </div>
                </div>

                <!-- Content -->
                <div class="bg-[#6C757D23] rounded-lg p-4 mb-6">
                    <div class="text-sm text-[#444] font-light">
                        This is the task description. You can include any relevant information here.
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Attachments -->
                <div class="mb-2 text-[#444] font-bold text-base">Attachments</div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                    <a href="#" target="_blank"
                        class="flex items-center justify-between border border-gray-300 rounded-lg p-3 shadow-sm hover:bg-gray-50 transition">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="font-semibold text-sm text-gray-800 truncate max-w-[180px]">document.pdf</p>
                                <p class="text-xs text-gray-500">1.2 MB</p>
                            </div>
                        </div>
                    </a>
                    <!-- Add more attachment items here as needed -->
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Assignees -->
                <div class="mt-6">
                    <span class="text-[#444] text-[12px] font-semibold">
                        Assigned to:
                    </span>

                    <div class="mt-2 flex flex-col space-y-2">
                        <div class="flex items-center space-x-2">
                            <div
                                class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-xs text-gray-700">
                                JD
                            </div>
                            <span class="text-xs text-gray-700">John Doe</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div
                                class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-xs text-gray-700">
                                AB
                            </div>
                            <span class="text-xs text-gray-700">Alice Brown</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

@endsection