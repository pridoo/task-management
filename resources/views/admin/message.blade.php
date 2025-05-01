@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100"
     x-data="{ open: false, editOpen: false }"
     x-init="open = false; editOpen = false">

    <!-- === HEADER: TOPBAR === -->
    <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
            <div class="flex justify-end items-center">
                <ul class="flex items-center space-x-4">

                    <!-- Messages Dropdown -->
                    <li class="relative" x-data="{ open: false }">
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

                    <!-- Notifications Dropdown -->
                    <li class="relative" x-data="{ open: false }">
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

    <!-- === MAIN: Message Card Content === -->
    <main class="pt-24 px-6 ml-64">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Inboxes</h2>
        </div>

        <!-- Message Card -->
        <div class="relative mb-4" x-data="{ open: false }" @click.outside="open = false">
            <div class="w-full h-[73px] bg-white border border-[#444]/40 rounded-[5px] flex items-center px-4 group hover:bg-gray-50 transition">

                <!-- Clickable Message -->
                <a href="{{ url('admin/message-open') }}" class="flex flex-1 items-center no-underline text-inherit">
                    <div class="w-[29px] h-[30px] bg-blue-500/70 rounded-full flex items-center justify-center text-white text-sm font-semibold mr-4">
                        <span class="text-[14px] leading-[17px] font-semibold">JV</span>
                    </div>
                    <div class="flex flex-col mr-auto">
                        <span class="text-[#444] text-[16px] leading-[19px] font-semibold">Jhavot Vee</span>
                        <span class="text-[#444] text-[11px] leading-[13px] font-extralight">5 minutes ago</span>
                    </div>
                    <div class="relative w-[17px] h-[16px] bg-red-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-[11px] leading-[13px] font-semibold">2</span>
                    </div>
                </a>

                <!-- Menu Dots -->
                <button class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none" @click.stop="open = !open">
                    <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="5" cy="12" r="2" />
                        <circle cx="12" cy="12" r="2" />
                        <circle cx="19" cy="12" r="2" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-cloak x-transition>
                    @include('admin.tasks.modal.message-menu')
                </div>
            </div>
        </div>
    </main>

</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection
