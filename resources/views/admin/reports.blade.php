@extends('layouts.admin')

@section('content')

<!-- === TOPBAR === -->
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
    </div>
</header>

<!-- === PAGE CONTENT === -->
<div class="px-6 pt-[90px] ml-[300px]"> 
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold ml-[-20px]">Report</h2>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-150">
            Export CSV
        </button>
    </div>

    <!-- Report Table -->
    <div class="bg-white rounded-md shadow border border-gray-200 overflow-x-auto w-[95%] ml-[-10px]"> 
        <div class="p-4">

            <div class="flex justify-between items-center mb-3">
                <div></div>
                <div class="relative w-72"> 
                    <input type="text" placeholder="Search Tasks"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <span class="absolute right-3 top-2.5 text-gray-400">
                        <i class="ri-search-line"></i>
                    </span>
                </div>
            </div>

            <table class="w-full table-auto text-sm text-left border-t border-gray-100"> <!-- Full width table -->
                <thead class="text-gray-700 font-semibold bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Task</th>
                        <th class="px-4 py-2">Assigned To</th>
                        <th class="px-4 py-2">Priority</th>
                        <th class="px-4 py-2">Stage</th>
                        <th class="px-4 py-2">Deadline</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    <tr class="border-t border-gray-100">
                        <td class="px-4 py-3 text-red-500">Things to create</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-1">
                                <div class="w-5 h-5 bg-gray-300 rounded-full"></div>
                                <div class="w-5 h-5 bg-gray-300 rounded-full"></div>
                                <div class="w-5 h-5 bg-gray-300 rounded-full"></div>
                                <span class="text-gray-400 text-xs">+</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-yellow-600">Medium Priority</td>
                        <td class="px-4 py-3">
                            <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full">To do</span>
                        </td>
                        <td class="px-4 py-3">Fri, 03 Jan 7:00 AM</td>
                        <td class="px-4 py-3 italic text-gray-500">Late</td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-start mt-4 space-x-2">
                <button class="px-3 py-1 border rounded hover:bg-gray-100">&lt;</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">&gt;</button>
            </div>
        </div>
    </div>
</div>

@endsection
