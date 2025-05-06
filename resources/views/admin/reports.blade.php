@extends('layouts.admin')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

    <div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

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
<<<<<<< HEAD
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
=======
                        </li>
>>>>>>> origin/faye

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

        <main class="pt-24 px-6 ml-80">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Reports</h2>
                <a href="{{ route('admin.reports.export') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                    Export CSV
                </a>
            </div>

            <div class="bg-white rounded-md shadow border border-gray-200 w-[95%] ml-[-10px] sm:ml-0 overflow-x-auto">
                <div class="p-4">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 gap-2 sm:gap-0">
                        <div></div>
                        <div class="relative w-full sm:w-72">
                        </div>
                    </div>

                    <div class="overflow-x-auto flex justify-center">
                        <table class="w-full table-auto text-sm text-left border-t border-gray-100 min-w-[600px]">
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
                                @foreach($completedTasks as $task)
                                    <tr class="border-t border-gray-100">
                                        <!-- Task Content -->
                                        <td class="px-4 py-3 text-red-500">{{ $task->content }}</td>

                                        <!-- Assigned To (Placeholder profile pictures) -->
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-1">
                                                @foreach($task->users as $user)
                                                    <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                                                @endforeach
                                                <span class="text-gray-400 text-xs">+</span>
                                            </div>
                                        </td>

                                        <!-- Priority -->
                                        <td class="px-4 py-3 text-yellow-600">{{ $task->priority}} Priority</td>

                                        <!-- Stage (Always Completed) -->
                                        <td class="px-4 py-3">
                                            <div class="relative w-[127px] h-4">
                                                <div class="absolute left-0 top-0 w-[11px] h-[10px] bg-green-500 rounded-full">
                                                </div>
                                                <span
                                                    class="absolute left-4 top-0 w-[110px] h-4 text-[12px] leading-[15px] font-light text-[#444444]">Completed</span>
                                            </div>
                                        </td>

                                        <!-- Deadline -->
                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($task->end_date)->format('D, d M h:i A') }}</td>
                                        <td class="px-4 py-3 italic {{ $task->status_class }}">
                                            {{ $task->status_label }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-7 border-2 rounded shadow-none">
                        {{ $completedTasks->links('vendor.pagination.tailwind') }}
                    </div>

                </div>
            </div>
        </main>


    </div>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

@endsection