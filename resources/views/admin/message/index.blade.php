@extends('layouts.admin')

@php
    use App\Helpers\AvatarHelper;
    use Illuminate\Support\Str;
@endphp

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

    <div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

        <!-- === HEADER: TOPBAR === -->
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

                <div class="relative mb-4 group">
                    <div
                        class="w-full h-[72px] bg-white border border-[#444]/40 rounded-[5px] flex items-center px-4 py-3 hover:bg-gray-50 transition">
                        <div class="flex flex-1 items-center h-full">
                            <a href="{{ route('admin.messages.show', $message->id) }}"
                                class="flex items-center no-underline text-inherit h-full">
                                <div
                                    class="w-[30px] h-[30px] {{ $bgColor }} rounded-full flex items-center justify-center text-white text-sm font-semibold mr-4">
                                    <span class="text-[14px] leading-[17px] font-semibold">{{ $initials }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[#444] text-[16px] leading-[19px] font-semibold">{{ $message->name }}</span>
                                    <span
                                        class="text-[#444] text-[13px] leading-[16px] font-light">{{ Str::limit($message->message, 80) }}</span>
                                </div>
                            </a>
                        </div>

                        <div class="ml-auto relative w-[90px] h-full flex justify-end items-center space-x-3">
                            <a href="{{ route('admin.messages.reply-form', $message->id) }}"
                                class="p-1 text-gray-500 hover:text-blue-600 inline-flex">
                                <i class="ri-reply-line"></i>
                            </a>
                            <button type="button" onclick="openDeleteModal({{ $message->id }})"
                                class="p-1 text-gray-500 hover:text-red-600">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </main>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold text-red-600 mb-2">Are you sure?</h2>
            <p class="text-sm text-gray-600 mb-6">This message will be permanently deleted.</p>

            <form id="deleteForm" method="POST" class="flex justify-center space-x-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Yes, Delete
                </button>
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    @if(session('success'))
        <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-green-600 mb-2">Success</h2>
                <p class="text-sm text-gray-700 mb-6">{{ session('success') }}</p>
                <button onclick="document.getElementById('successModal').classList.add('hidden')"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Close
                </button>
            </div>
        </div>
    @endif

    <!-- Script -->
    <script>
        function openDeleteModal(messageId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/admin/messages/${messageId}/delete`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>

@endsection