@extends('layouts.admin')

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
                                @foreach($messages->take(5) as $msg)
                                    <li>
                                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                            <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                                <i class="ri-user-3-line"></i>
                                            </div>
                                            <div class="ml-2">
                                                <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                                    {{ $msg->name }}
                                                </div>
                                                <div class="text-[11px] text-gray-400">
                                                    {{ Str::limit($msg->message, 40) }}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                                <li class="border-t border-gray-100">
                                    <a href="{{ route('admin.messages.index') }}"
                                    class="block text-center text-sm text-blue-600 py-2 hover:underline">
                                        View all messages
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

    <main class="pt-28 pl-[310px] pr-6">
        <div class="w-[95%] mx-auto"> 

            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Settings</h2>

            <div class="bg-white border border-gray-300 rounded-lg shadow overflow-hidden w-full">
                
                <a href="{{ url ('admin/settings/profile') }}">
                    <div class="flex items-center justify-between px-6 py-6 hover:bg-gray-50 cursor-pointer border-b border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="text-gray-500 text-xl">
                                <i class="ri-user-3-line"></i>
                            </div>
                            <span class="text-base text-gray-700 font-medium">Profile</span>
                        </div>
                        <div class="text-gray-400">
                            <i class="ri-arrow-right-s-line text-2xl"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ url ('admin/settings/password') }}">
                    <div class="flex items-center justify-between px-6 py-6 hover:bg-gray-50 cursor-pointer">
                        <div class="flex items-center space-x-3">
                            <div class="text-gray-500 text-xl">
                                <i class="ri-shield-keyhole-line"></i>
                            </div>
                            <span class="text-base text-gray-700 font-medium">Password</span>
                        </div>
                        <div class="text-gray-400">
                            <i class="ri-arrow-right-s-line text-2xl"></i>
                        </div>
                    </div>
                </a>
                
            </div>

        </div>
    </main>
</div>

@endsection
