@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gray-100"  x-data="{ open: false, editOpen: false }">

    <!-- Header -->
    <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
            <div class="flex justify-end items-center">
                <ul class="flex items-center space-x-4">
                    <!-- Messages -->
                    <li class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="msg-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                            <i class="ri-chat-1-line"></i>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="msg-menu absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
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

                    <!-- Notifications -->
                    <li class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="notif-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                            <i class="ri-notification-4-line"></i>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="notif-menu absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
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
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 px-6 ml-64">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Tasks</h2>
            <button @click="open = true" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                + Create Task
            </button>
        </div>

        <!-- Legend -->
        <div class="mb-4 border border-gray-300 rounded-lg p-4 bg-white shadow-sm w-fit">
            <div class="flex space-x-4">
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                    <span class="text-sm text-gray-700">To do</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    <span class="text-sm text-gray-700">Completed</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                    <span class="text-sm text-gray-700">In-progress</span>
                </div>
            </div>
        </div>

        <!-- Tasks -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @for ($i = 0; $i < 6; $i++)
            <div class="bg-white shadow rounded-lg p-4 border relative">
                <!-- Dropdown -->
                <div class="absolute top-2 right-2" x-data="{ open: false }">
                    <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" class="absolute top-full right-0 mt-2 w-40 bg-white border border-gray-200 rounded-xl shadow-lg z-50 py-2">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="ri-eye-line mr-2 text-lg text-gray-500"></i> Open
                        </a>
                        <a href="#" @click.prevent="editOpen = true" class="flex items-center px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">
                            <i class="ri-edit-line mr-2 text-lg"></i> Edit
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-yellow-600 hover:bg-yellow-50">
                            <i class="ri-file-copy-line mr-2 text-lg"></i> Duplicate
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="ri-delete-bin-line mr-2 text-lg"></i> Delete
                        </a>
                    </div>
                </div>

                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Title</div>
                <hr class="mb-2 border-gray-200">
                <div class="flex justify-between items-center mb-2">
                    <span class="bg-red-500 text-white px-2 py-0.5 rounded-full text-[11px]">To do</span>
                    <span class="text-xs text-red-500 font-semibold">High Priority</span>
                </div>
                <div class="text-xs text-gray-500 mb-2">📅 Fri, 03 Jan 7:00 AM</div>
                <p class="text-sm text-gray-700 mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="text-xs text-gray-600 mb-1">Assigned to:</div>
                <div class="flex space-x-1">
                    <div class="w-6 h-6 rounded-full bg-gray-300"></div>
                    <div class="w-6 h-6 rounded-full bg-gray-300"></div>
                    <div class="w-6 h-6 rounded-full bg-gray-300"></div>
                </div>
            </div>
            @endfor
        </div>
    </main>

@include('admin.tasks.modal.create-tasks')

@include('admin.tasks.modal.edit-tasks')


<!-- AlpineJS -->
<script src="//unpkg.com/alpinejs" defer></script>

@endsection
