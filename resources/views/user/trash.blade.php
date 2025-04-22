@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100"
     x-data="{ open: false, editOpen: false }"
     x-init="open = false; editOpen = false">

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

    <main class="pt-24 px-6 ml-64">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Archived</h2>
            <button @click="open = true" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm">
                + Delete All
            </button>
        </div>

        <div class="bg-white shadow rounded-md border border-gray-200 p-4">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-3"><input type="checkbox"></th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Priority</th>
                        <th class="px-4 py-3">Stage</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><input type="checkbox"></td>
                        <td class="px-4 py-3">Things to create</td>
                        <td class="px-4 py-3">Medium Priority</td>
                        <td class="px-4 py-3">
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Completed</span>
                        </td>
                        <td class="px-4 py-3">Fri, 03 Jan 7:00 AM</td>
                        <td class="px-4 py-3 flex space-x-2">
                            <button class="text-gray-500 hover:text-black"><i class="ri-refresh-line"></i></button>
                            <button class="text-red-500 hover:text-red-700"><i class="ri-delete-bin-line"></i></button>
                        </td>
                    </tr>

                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><input type="checkbox"></td>
                        <td class="px-4 py-3">Things to create</td>
                        <td class="px-4 py-3">High Priority</td>
                        <td class="px-4 py-3">
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">To do</span>
                        </td>
                        <td class="px-4 py-3">Fri, 03 Jan 7:00 AM</td>
                        <td class="px-4 py-3 flex space-x-2">
                            <button class="text-gray-500 hover:text-black"><i class="ri-refresh-line"></i></button>
                            <button class="text-red-500 hover:text-red-700"><i class="ri-delete-bin-line"></i></button>
                        </td>
                    </tr>

                    <tr class="bg-white hover:bg-gray-50">
                        <td class="px-4 py-3"><input type="checkbox"></td>
                        <td class="px-4 py-3">Things to create</td>
                        <td class="px-4 py-3">Low Priority</td>
                        <td class="px-4 py-3">
                            <span class="bg-yellow-400 text-white text-xs px-2 py-1 rounded-full">In progress</span>
                        </td>
                        <td class="px-4 py-3">Fri, 03 Jan 7:00 AM</td>
                        <td class="px-4 py-3 flex space-x-2">
                            <button class="text-gray-500 hover:text-black"><i class="ri-refresh-line"></i></button>
                            <button class="text-red-500 hover:text-red-700"><i class="ri-delete-bin-line"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection
