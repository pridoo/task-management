@extends('layouts.admin')

@section('content')


<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100"
     x-data="{ open: false, editOpen: false }"
     x-init="open = false; editOpen = false">

    <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-lg border border-gray-200 px-6 py-4">
            <div class="flex justify-end items-center">
                <ul class="flex items-center space-x-4">
                    <!-- Messages -->
                    <li class="relative" x-data="{ open: false }" x-init="open = false">
                        <button @click="open = !open"
                            class="msg-btn text-gray-400 w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                            <i class="ri-chat-1-line"></i>
                        </button>
                        <div x-show="open" x-cloak @click.outside="open = false"
                            class="absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-lg border border-gray-100 shadow-md z-30">
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
                                                        {{ $activity->activity_type }}
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

    <main class="pt-28 pl-[310px] pr-6 bg-gray-50 min-h-screen">
        <div class="w-full max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Change Password</h2>

            <div class="bg-white shadow-lg rounded-2xl p-8 max-w-md mx-auto transition-all hover:shadow-2xl">
                <form action="{{ route('admin.settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="old_password" class="block text-sm font-medium text-gray-700 mb-1">Old Password</label>
                        <input type="password" id="old_password" name="old_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <input type="password" id="new_password" name="new_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                    </div>
                    <div class="mb-6">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="bg-blue-500 text-white py-2 px-6 rounded-full hover:bg-blue-600 transition duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</div>

<script>
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
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
    @endif
</script>


@endsection

