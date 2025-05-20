@extends('layouts.admin')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

    <div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

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
                <h2 class="text-2xl font-semibold text-gray-800">Pending Users</h2>
            </div>

            <!-- Legend -->
            <div class="mb-4 border border-gray-300 rounded-lg p-4 bg-white shadow-sm w-fit">
                <div class="flex space-x-4">
                    <div class="flex items-center space-x-1">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                        <span class="text-sm text-gray-700">Pending Users</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow border border-gray-200 mt-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left">Fullname</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Role</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($pendingUsers as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->role ?? 'Developer' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">

                                        <form method="POST" action="{{ route('admin.reject-user', $user->id) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="ri-close-line text-xl"></i>
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.approve-user', $user->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-green-600 hover:text-green-800">
                                                <i class="ri-check-line text-xl"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('status') && session('userName'))
        <script>
            let status = "{{ session('status') }}";
            let userName = "{{ session('userName') }}";

            if (status === 'approved') {
                Swal.fire({
                    title: 'User Approved!',
                    text: `${userName} has been approved successfully.`,
                    icon: 'success',
                    confirmButtonText: 'Okay',
                    customClass: {
                        popup: 'rounded-lg shadow-xl border border-green-500',
                        title: 'text-lg font-semibold text-green-700',
                        content: 'text-green-600 text-sm',
                        confirmButton: 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full focus:outline-none',
                    },
                    backdrop: true,
                    showCloseButton: true,
                    padding: '20px',
                });
            } else if (status === 'rejected') {
                Swal.fire({
                    title: 'User Rejected!',
                    text: `${userName} has been rejected successfully.`,
                    icon: 'error',
                    confirmButtonText: 'Okay',
                    customClass: {
                        popup: 'rounded-lg shadow-xl border border-red-500',
                        title: 'text-lg font-semibold text-red-700',
                        content: 'text-red-600 text-sm',
                        confirmButton: 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full focus:outline-none',
                    },
                    backdrop: true,
                    showCloseButton: true,
                    padding: '20px',
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: `An error occurred. ${userName}`,
                    icon: 'error',
                    confirmButtonText: 'Okay',
                    customClass: {
                        popup: 'rounded-lg shadow-xl border border-gray-500',
                        title: 'text-lg font-semibold text-gray-800',
                        content: 'text-gray-600 text-sm',
                        confirmButton: 'bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full focus:outline-none',
                    },
                    backdrop: true,
                    showCloseButton: true,
                    padding: '20px',
                });
            }
        </script>
    @endif


@endsection