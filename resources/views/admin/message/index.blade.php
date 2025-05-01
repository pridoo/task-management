@extends('layouts.admin')

@php
    use App\Helpers\AvatarHelper;
    use Illuminate\Support\Str;
@endphp

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

        @foreach ($messages as $message)
        @php
            $initials = AvatarHelper::getInitials($message->name);
            $bgColor = AvatarHelper::getColorClass($message->name);
        @endphp

        <div class="relative mb-4 group" x-data="{ open: false }" @click.outside="open = false">
            <div class="w-full h-[72px] bg-white border border-[#444]/40 rounded-[5px] flex items-center px-4 py-3 hover:bg-gray-50 transition">
                <div class="flex flex-1 items-center h-full">
                    <a href="{{ route('admin.messages.show', $message->id) }}" class="flex items-center no-underline text-inherit h-full">
                        <div class="w-[30px] h-[30px] {{ $bgColor }} rounded-full flex items-center justify-center text-white text-sm font-semibold mr-4">
                            <span class="text-[14px] leading-[17px] font-semibold">{{ $initials }}</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-[#444] text-[16px] leading-[19px] font-semibold">{{ $message->name }}</span>
                            <span class="text-[#444] text-[13px] leading-[16px] font-light">{{ Str::limit($message->message, 80) }}</span>
                        </div>
                    </a>
                </div>

                <div class="ml-auto relative w-[90px] h-full flex justify-end items-center">
                    <span class="text-[#444] text-[12px] leading-[14px] font-light group-hover:hidden transition-opacity duration-200">
                        {{ \Carbon\Carbon::parse($message->sent_at)->format('M d') }}
                    </span>

                    <div class="absolute right-0 top-1/2 transform -translate-y-1/2 flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <div class="relative group/icon">
                            <a href="{{ url('admin/message-reply') }}" class="p-1 text-gray-500 hover:text-blue-600 inline-flex">
                                <i class="ri-reply-line"></i>
                            </a>
                        </div>
                        <div class="relative group/icon">
                            <button @click.stop class="p-1 text-gray-500 hover:text-red-600">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                        <div class="relative group/icon">
                            <button @click.stop="open = !open" class="p-1 text-gray-500 hover:text-gray-700">
                                <i class="ri-more-2-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="open" x-cloak x-transition>
                @include('admin.tasks.modal.message-menu')
            </div>
        </div>
        @endforeach

    </main>
</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection
