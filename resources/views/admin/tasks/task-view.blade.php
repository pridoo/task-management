@extends('layouts.admin')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

    <div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">


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

        <main class="pt-24 px-6 ml-64">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Task View</h2>
            </div>
            <div x-data="{ tab: 'details' }" class="mx-auto max-w-[90%] md:max-w-[1050px]">
                <!-- Tabs Navigation -->
                <div class="flex space-x-4 mb-6 border-b border-gray-200">
                    <button @click="tab = 'details'" :class="tab === 'details' ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500'" class="pb-2 font-semibold text-sm">
                        Task Details
                    </button>
                    <button @click="tab = 'comments'" :class="tab === 'comments' ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500'" class="pb-2 font-semibold text-sm">
                        Comments
                    </button>
                </div>
                <!-- Task Details Tab -->
                <div x-show="tab === 'details'" x-cloak>
                    <!-- Task Detail View -->
                    <div class="mx-auto max-w-[90%] md:max-w-[1050px] p-6 bg-white border border-[#4444] rounded-lg">

                        <div class="text-[#444] text-base font-bold mb-4 flex items-center gap-2">
                            <a href="{{ url()->previous() }}" class="hover:text-blue-600">
                                <i class="bi bi-arrow-left w-4 h-4 text-[#444]"></i>
                            </a>
                        </div>

                        <!-- Title -->
                        <div class="text-[#444] text-base font-bold flex items-center gap-2">
                            <span class="mt-2">{{ $task->title }}</span>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-4"></div>

                        <div class="flex justify-between items-center">
                            <!-- Status -->
                            <button
                                class="mb-4 px-6 py-2 text-white text-xs rounded-lg
                        {{ $task->status === 'To do' ? 'bg-red-500' : ($task->status === 'In-progress' ? 'bg-yellow-400' : 'bg-green-500') }}">
                                {{ $task->status }}
                            </button>

                            <!-- Priority -->
                            <span
                                class="text-[11px] flex items-center gap-1
                        {{ $task->priority === 'High' ? 'text-red-500' : ($task->priority === 'Medium' ? 'text-yellow-500' : 'text-green-500') }}">
                                {{ $task->priority === 'High' ? '🔴' : ($task->priority === 'Medium' ? '🟡' : '🟢') }}
                                <span>{{ ucfirst($task->priority) }} Priority</span>
                            </span>
                        </div>

                        <!-- Start and End Dates -->
                        <div class="flex flex-wrap items-center gap-x-8 text-sm text-[#444] mb-4">
                            <div class="flex gap-1 font-semibold">
                                <span>Start Date:</span>
                                <span
                                    class="font-light">{{ \Carbon\Carbon::parse($task->start_date)->format('l, F j, Y h:i A') }}</span>
                            </div>
                            <div class="flex gap-1 font-semibold">
                                <span>End Date:</span>
                                <span class="font-light">
                                    {{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('l, F j, Y h:i A') : 'No End Date' }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="bg-[#6C757D23] rounded-lg p-4 mb-6">
                            <div class="text-sm text-[#444] font-light">
                                {!! nl2br(e($task->content)) !!}
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Attachments -->
                        <div class="mb-2 text-[#444] font-bold text-base">Attachments</div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                            @forelse ($task->attachments ?? [] as $attachment)
                                @php
                                    $file = $attachment->path;
                                    $filename = $attachment->original_name ?? basename($file);
                                    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                                    $size = \Illuminate\Support\Facades\Storage::exists($file)
                                        ? round(\Illuminate\Support\Facades\Storage::size($file) / 1024 / 1024, 1) . ' MB'
                                        : 'Unknown size';
                                    $url = \Illuminate\Support\Facades\Storage::url($file);

                                    $iconMap = [
                                        'pdf' => 'pdf-icon.png',
                                        'doc' => 'word-icon.png',
                                        'docx' => 'word-icon.png',
                                        'xls' => 'excel-icon.png',
                                        'xlsx' => 'excel-icon.png',
                                        'png' => 'image-icon.png',
                                        'jpg' => 'image-icon.png',
                                        'jpeg' => 'image-icon.png',
                                        'txt' => 'text-icon.png',
                                        'zip' => 'zip-icon.png',
                                    ];

                                    $icon = asset('icons/' . ($iconMap[$extension] ?? 'file-icon.svg'));
                                @endphp

                                <a href="{{ $url }}" target="_blank"
                                    class="flex items-center justify-between border border-gray-300 rounded-lg p-3 shadow-sm hover:bg-gray-50 transition">
                                    <div class="flex items-center space-x-3">
                                        <!-- File Icon -->
                                        <img src="{{ $icon }}" alt="File icon" class="w-4 h-4" />

                                        <!-- File Info -->
                                        <div>
                                            <p class="font-semibold text-sm text-gray-800 truncate max-w-[180px]">
                                                {{ $filename }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $size }}</p>
                                        </div>
                                    </div>

                                    <!-- View Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-500 hover:text-gray-700"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </a>
                            @empty
                                <p class="text-sm text-gray-500">No attachments uploaded.</p>
                            @endforelse
                        </div>


                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Assignees -->
                        <div class="mt-6">
                            <span class="text-[#444] text-[12px] font-semibold">
                                Assigned to:
                            </span>

                            <div class="mt-2 flex flex-col space-y-2">
                                @forelse ($task->users as $user)
                                    <div class="flex items-center space-x-2">
                                        <div
                                            class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-xs text-gray-700">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="text-xs text-gray-700">{{ $user->name }}</span>
                                    </div>
                                @empty
                                    <span class="text-xs text-gray-500">No users assigned.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Comments Tab -->
                    <div x-show="tab === 'comments'" x-cloak>
                        <section
                            class="mx-auto max-w-[90%] md:max-w-[1050px] mt-10 p-6 bg-white border border-[#4444] rounded-lg">
                            <div class="container mx-auto px-4">
                                <h2 class="text-2xl font-bold mb-4">Comments</h2>

                                <div class="max-h-96 overflow-y-auto p-4 bg-gray-100 rounded-lg border">
                                    <div class="space-y-4">
                                        <!-- Comment 1 -->
                                        <div class="bg-white p-4 rounded-lg shadow border-2">
                                            <div class="flex items-center mb-2">
                                                <img src="https://via.placeholder.com/40" alt="User Avatar"
                                                    class="w-10 h-10 rounded-full mr-3">
                                                <div>
                                                    <h3 class="font-semibold">John Doe</h3>
                                                    <p class="text-sm text-gray-500">Thursday, April 3, 2025 05:31 PM</p>
                                                </div>
                                            </div>
                                            <p class="text-gray-700">Great product! I've been using it for a week now and
                                                I'm very
                                                satisfied with its performance.</p>
                                            <div class="flex items-center mt-2">
                                                <button class="text-blue-500 hover:text-blue-600 mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                    </svg>
                                                    Like
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-600">Reply</button>
                                            </div>
                                        </div>

                                        <!-- Comment 2 -->
                                        <div class="bg-white p-4 rounded-lg shadow border-2">
                                            <div class="flex items-center mb-2">
                                                <img src="https://via.placeholder.com/40" alt="User Avatar"
                                                    class="w-10 h-10 rounded-full mr-3">
                                                <div>
                                                    <h3 class="font-semibold">Jane Smith</h3>
                                                    <p class="text-sm text-gray-500">Thursday, April 3, 2025 05:31 PM</p>
                                                </div>
                                            </div>
                                            <p class="text-gray-700">The shipping was fast and the product arrived in
                                                perfect
                                                condition. Highly recommended!</p>
                                            <div class="flex items-center mt-2">
                                                <button class="text-blue-500 hover:text-blue-600 mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                    </svg>
                                                    Like
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-600">Reply</button>
                                            </div>
                                        </div>
                                        <!-- Comment 3 -->
                                        <div class="bg-white p-4 rounded-lg shadow border-2">
                                            <div class="flex items-center mb-2">
                                                <img src="https://via.placeholder.com/40" alt="User Avatar"
                                                    class="w-10 h-10 rounded-full mr-3">
                                                <div>
                                                    <h3 class="font-semibold">Jane Smith</h3>
                                                    <p class="text-sm text-gray-500">Thursday, April 3, 2025 05:31 PM</p>
                                                </div>
                                            </div>
                                            <p class="text-gray-700">The shipping was fast and the product arrived in
                                                perfect
                                                condition. Highly recommended!</p>
                                            <div class="flex items-center mt-2">
                                                <button class="text-blue-500 hover:text-blue-600 mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                    </svg>
                                                    Like
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-600">Reply</button>
                                            </div>
                                        </div>
                                        <!-- Comment 4 -->
                                        <div class="bg-white p-4 rounded-lg shadow border-2">
                                            <div class="flex items-center mb-2">
                                                <img src="https://via.placeholder.com/40" alt="User Avatar"
                                                    class="w-10 h-10 rounded-full mr-3">
                                                <div>
                                                    <h3 class="font-semibold">Jane Smith</h3>
                                                    <p class="text-sm text-gray-500">Thursday, April 3, 2025 05:31 PM</p>
                                                </div>
                                            </div>
                                            <p class="text-gray-700">The shipping was fast and the product arrived in
                                                perfect
                                                condition. Highly recommended!</p>
                                            <div class="flex items-center mt-2">
                                                <button class="text-blue-500 hover:text-blue-600 mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                    </svg>
                                                    Like
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-600">Reply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Add Comment Form -->
                                <form class="mt-8 bg-white p-4 rounded-lg shadow border-2">
                                    <div class="mb-4">
                                        <label for="comment" class="block text-gray-700 font-medium mb-2">Comment</label>
                                        <textarea id="comment" name="comment" rows="4"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required></textarea>
                                    </div>
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Post Comment
                                    </button>
                                </form>
                            </div>
                        </section>
                    </div>

                </div>
        </main>
    </div>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

@endsection
