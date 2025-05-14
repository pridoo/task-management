@extends('layouts.admin')

@php
    use Carbon\Carbon;
@endphp

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

    <!-- Header -->
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
                                    <a href="{{ route('admin.messages.index') }}" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                            <i class="ri-user-3-line"></i>
                                        </div>
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">{{ $message->name }}</div>
                                            <div class="text-[11px] text-gray-400">{{ Str::limit($message->message, 40) }}</div>
                                        </div>
                                    </a>
                                </li>
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
                                @foreach($activities as $activity)
                                    @if (!$activity->is_read) 
                                        <li>
                                            <a href="{{ route('admin.tasks.tasks.markActivityAsRead', $activity->id) }}" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                                <div class="w-8 h-8 bg-yellow-500 text-white flex items-center justify-center rounded-full">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                           
                                                        @if($activity->task) 
                                                            {{ $activity->task->title }}
                                                        @else
                                                            No Task
                                                        @endif
                                                    </div>
                                                    <div class="text-[10px] text-gray-600 font-medium mt-1">
                                                        <strong>{{ $activity->activity_details }}</strong>
                                                    </div>
                                                    <div class="text-[11px] text-gray-400">
                                                        {{ Carbon::parse($activity->created_at)->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main class="pt-24 px-6 ml-64">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Message Details</h2>
        </div>

        <div class="w-full bg-white shadow-xl rounded-lg flex overflow-x-auto custom-scrollbar">
            <div class="flex-1 px-2">
                <div class="h-16 flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('admin.messages.index') }}"
                            class="flex items-center text-gray-700 px-2 py-1 space-x-0.5 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100"
                            title="Back">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-bold">Back</span>
                        </a>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                {{ strtoupper(substr($message->name, 0, 1)) }}
                            </div>
                            <div class="flex flex-col ml-2">
                                <span class="text-sm font-semibold">{{ $message->name }}</span>
                                <span class="text-xs text-gray-400">From: {{ $message->email }}</span>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">
                            {{ Carbon::parse($message->sent_at)->format('M d, Y h:i A') }}
                        </span>
                    </div>

                    <div class="py-6 pl-2 text-gray-700">
                        {!! nl2br(e($message->message)) !!}
                    </div>

                    <div class="mt-8 flex items-center space-x-4">
                        <a href="{{ route('admin.messages.reply-form', $message->id) }}"
                            class="w-32 flex items-center justify-center space-x-2 py-1.5 text-gray-600 border border-gray-400 rounded-lg hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Reply</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection
