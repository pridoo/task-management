@extends('layouts.admin')
@section('content')

<body class="text-gray-800 font-inter">
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main overflow-y-auto">
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
                    <button type="button" class="msg-btn text-gray-400 w-8 h-8 rounded hover:bg-gray-50 hover:text-gray-600">
                        <i class="ri-chat-1-line"></i>
                    </button>
                    <div class="msg-menu absolute right-0 mt-2 hidden max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                        <div class="px-4 pt-4 border-b border-b-gray-100">
                            <div class="text-gray-600 text-sm font-semibold mb-2">Messages</div>
                        </div>
                        <ul class="my-2 max-h-64 overflow-y-auto space-y-2">
                            @foreach($messages->take(5) as $msg)
                                <li>
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="py-2 px-4 flex items-start hover:bg-gray-50 group transition">
                                        <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                            <i class="ri-user-3-line"></i>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm text-gray-700 font-semibold truncate group-hover:text-blue-500">
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

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-blue-500 rounded-md border border-gray-100 p-6 shadow-md">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1 text-white">{{ $totalTasks }}</div>
                            <div class="text-sm font-medium text-white">Total Tasks</div>
                        </div>
                        <div class="dropdown">
                            <button class="dropdown-toggle text-white hover:text-gray-200"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu hidden py-1.5 rounded-md bg-white border border-gray-100 max-w-[140px]">
                                <li><a href="{{ url('admin/tasks/all-tasks') }}" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">View Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-green-500 rounded-md border border-gray-100 p-6 shadow-md">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1 text-white">{{ $completedTasks->count() }}</div>
                            <div class="text-sm font-medium text-white">Completed Tasks</div>
                        </div>
                        <div class="dropdown">
                            <button class="dropdown-toggle text-white hover:text-gray-200"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu hidden py-1.5 rounded-md bg-white border border-gray-100 max-w-[140px]">
                                <li><a href="{{ url('admin/tasks/completed') }}" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-green-500 hover:bg-gray-50">View Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-500 rounded-md border border-gray-100 p-6 shadow-md">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1 text-white">{{ $inProgressCount }}</div>
                            <div class="text-sm font-medium text-white">Tasks in Progress</div>
                        </div>
                        <div class="dropdown">
                            <button class="dropdown-toggle text-white hover:text-gray-200"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu hidden py-1.5 rounded-md bg-white border border-gray-100 max-w-[140px]">
                                <li><a href="{{ url('admin/tasks/in-progress') }}" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-yellow-500 hover:bg-gray-50">View Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-red-500 rounded-md border border-gray-100 p-6 shadow-md">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1 text-white">{{ $toDoCount }}</div>
                            <div class="text-sm font-medium text-white">To Do</div>
                        </div>
                        <div class="dropdown">
                            <button class="dropdown-toggle text-white hover:text-gray-200"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu hidden py-1.5 rounded-md bg-white border border-gray-100 max-w-[140px]">
                                <li><a href="{{ url('admin/tasks/to-do') }}" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-red-500 hover:bg-gray-50">View Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Task Overview</h2>
                    <a href="{{ url('admin/tasks/all-tasks') }}" class="text-sm text-blue-500 hover:underline">View All</a>
                </div>

                <div class="overflow-x-auto rounded-md">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs uppercase bg-gray-100 text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Task</th>
                                <th class="px-4 py-3">Assigned To</th>
                                <th class="px-4 py-3">Priority</th>
                                <th class="px-4 py-3">Stage</th>
                                <th class="px-4 py-3">Deadline</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($allTasks as $task)
                                <tr class="hover:bg-gray-50 transition-all">
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $task->content }}</td>
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
                                                    <div class="w-6 h-6 flex items-center justify-center text-white text-xs font-semibold rounded-full bg-{{ $bg }}-500">
                                                        {{ $initial }}
                                                    </div>
                                                    <div class="absolute bottom-full mb-1 px-2 py-1 bg-gray-800 text-white text-[10px] rounded shadow opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-50">
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
                                    <td class="px-4 py-3">
                                        <span class="text-xs font-medium text-yellow-500">{{ ucfirst($task->priority) }} Priority</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="relative w-[127px] h-4">
                                            <div class="absolute left-0 top-0 w-[11px] h-[10px] {{ $task->status_class }} rounded-full"></div>
                                            <span class="absolute left-4 top-0 w-[110px] h-4 text-[12px] leading-[15px] font-light text-[#444444]">
                                                {{ $task->status_label }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($task->end_date)->format('D, d M h:i A') }}
                                    </td>
                                    <td class="px-4 py-3 italic {{ $task->status_text_class }}">
                                        {{ $task->status_detail_label }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

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
@endsection
