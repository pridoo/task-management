@extends('layouts.admin')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

    <div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

        <!-- === TOPBAR === -->
        <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
            <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
                <div class="flex justify-end items-center">
                    <ul class="ml-auto flex items-center">
                        <!-- 💬 Messages Icon with Count -->
                        <li class="relative">
                            <button type="button"
                                class="msg-btn text-gray-400 w-8 h-8 rounded hover:bg-gray-50 hover:text-gray-600 relative">
                                <i class="ri-chat-1-line text-xl"></i>

                                @if($messages->count() > 0)
                                    <span
                                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                        {{ $messages->count() }}
                                    </span>
                                @endif
                            </button>

                            <!-- Messages Dropdown -->
                            <div
                                class="msg-menu absolute right-0 mt-2 hidden max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                                <div class="px-4 pt-4 border-b border-b-gray-100">
                                    <div class="text-gray-600 text-sm font-semibold mb-2">Messages</div>
                                </div>
                                <ul class="my-2 max-h-64 overflow-y-auto space-y-2">
                                    @foreach($messages->take(5) as $msg)
                                        <li>
                                            <a href="{{ route('admin.messages.show', $msg->id) }}"
                                                class="py-2 px-4 flex items-start hover:bg-gray-50 group transition">
                                                <div
                                                    class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                                    <i class="ri-user-3-line"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <div
                                                        class="text-sm text-gray-700 font-semibold truncate group-hover:text-blue-500">
                                                        {{ $msg->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ Str::limit($msg->message, 40) }}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach

                                    <li class="border-t border-gray-100 pt-2">
                                        <a href="{{ route('admin.messages.index') }}"
                                            class="block text-center text-sm text-blue-600 hover:underline">
                                            View all messages
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- 🔔 Notifications Icon with Count -->
                        <li class="relative" x-data="{ open: false }" x-init="open = false">
                            <button @click="open = !open"
                                class="notif-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600 relative">
                                <i class="ri-notification-4-line text-xl"></i>

                                @php
                                    $unreadCount = $activities->where('is_read', false)->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span
                                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </button>

                            <!-- Notifications Dropdown -->
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                                <div class="px-4 pt-4 border-b border-gray-100">
                                    <div class="text-gray-600 text-sm font-semibold mb-2">Notifications</div>
                                </div>
                                <ul class="my-2 max-h-64 overflow-y-auto">
                                    @foreach($activities as $activity)
                                        @if (!$activity->is_read)
                                            <li>
                                                <a href="{{ route('admin.tasks.tasks.markActivityAsRead', $activity->id) }}"
                                                    class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                                    <div
                                                        class="w-8 h-8 bg-yellow-500 text-white flex items-center justify-center rounded-full">
                                                        <i class="ri-checkbox-circle-line"></i>
                                                    </div>
                                                    <div class="ml-2">
                                                        <div
                                                            class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
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
                                                            {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
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
                <h2 class="text-2xl font-semibold text-gray-800">Reports</h2>
                <a href="{{ route('admin.reports.export') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                    Export CSV
                </a>
            </div>

            <div class="bg-white rounded-md shadow border border-gray-200 p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-[700px] w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">Task</th>
                                <th class="px-4 py-3">Assigned To</th>
                                <th class="px-4 py-3">Priority</th>
                                <th class="px-4 py-3">Stage</th>
                                <th class="px-4 py-3">Deadline</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedTasks as $task)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-red-500">{{ $task->content }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-2">
                                            @php
                                                $users = $task->users;
                                                $maxVisible = 3;
                                                $hiddenCount = $users->count() - $maxVisible; 
                                            @endphp

                                            @foreach($users->take($maxVisible) as $user)
                                                @php

                                                    $initial = strtoupper(substr($user->name, 0, 1));

                                                    $colors = ['red', 'green', 'blue', 'indigo', 'purple', 'yellow', 'pink'];

                                                    $bg = $colors[crc32($user->name) % count($colors)];
                                                @endphp
                                                <div class="relative group" title="{{ $user->name }}">
                                                    <div
                                                        class="w-6 h-6 flex items-center justify-center text-white text-xs font-semibold rounded-full bg-{{ $bg }}-500">
                                                        {{ $initial }}
                                                    </div>
                                                    <div
                                                        class="absolute bottom-full mb-1 px-2 py-1 bg-gray-800 text-white text-[10px] rounded shadow opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-50">
                                                        {{ $user->name }}
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if($hiddenCount > 0)
                                                <div class="w-6 h-6 flex items-center justify-center text-xs font-semibold text-gray-700 bg-gray-200 rounded-full"
                                                    title="+{{ $hiddenCount }} more">
                                                    +{{ $hiddenCount }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-yellow-600">{{ $task->priority}} Priority</td>
                                    <td class="px-4 py-3">
                                        <div class="relative w-[127px] h-4">
                                            <div class="absolute left-0 top-0 w-[11px] h-[10px] bg-green-500 rounded-full">
                                            </div>
                                            <span
                                                class="absolute left-4 top-0 w-[110px] h-4 text-[12px] leading-[15px] font-light text-[#444444]">Completed</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ \Carbon\Carbon::parse($task->end_date)->format('D, d M h:i A') }}
                                    </td>
                                    <td class="px-4 py-3 italic {{ $task->status_class }}">
                                        {{ $task->status_label }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </main>

    </div>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

@endsection