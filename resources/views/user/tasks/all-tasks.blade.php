@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

    <!-- Header -->
    <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
            <div class="flex justify-end items-center">
                <ul class="flex items-center space-x-4">

                    <!-- Notifications -->
                    <li class="relative" x-data="{ open: false }" x-init="open = false">
                        <button @click="open = !open" class="notif-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                            <i class="ri-notification-4-line"></i>
                        </button>
                        <div x-show="open" x-cloak @click.outside="open = false"
                             class="absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-md border border-gray-100 shadow-md z-30">
                            <div class="px-4 pt-4 border-b border-gray-100">
                                <div class="text-gray-600 text-sm font-semibold mb-2">Notifications</div>
                            </div>
                            <ul class="my-2 max-h-64 overflow-y-auto">
                                @forelse ($notifications as $notification)
                                    <li>
                                        <a href="{{ route('user.notifications.read', $notification->id) }}" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                            <div class="w-10 h-10 bg-yellow-500 text-white flex items-center justify-center rounded-full">
                            
                                                <i class="ri-checkbox-circle-line text-lg"></i>  
                                            </div>
                                            <div class="ml-2">
                                    
                                                <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                                    {{ $notification->message }}  
                                                </div>

          
                                                <div class="text-[10px] text-gray-600 font-medium mt-1">
                                                    <strong>{{ $notification->task_title }}</strong>  
                                                </div>


                                                <div class="text-[11px] text-gray-400">
                                                    {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li>No new notifications</li>
                                @endforelse
                            </ul>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 px-6 ml-64">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">My Tasks</h2>
        </div>

        <!-- Legend -->
        <div class="mb-4 border border-gray-300 rounded-lg p-4 bg-white shadow-sm w-fit">
            <div class="flex space-x-4">
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                    <span class="text-sm text-gray-700">To do</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                    <span class="text-sm text-gray-700">In-progress</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    <span class="text-sm text-gray-700">Completed</span>
                </div>
            </div>
        </div>

        <!-- Task Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse ($tasks as $task)
                <div class="bg-white shadow rounded-lg p-4 border relative">
                    <div class="absolute top-2 right-2" x-data="{ dropdownOpen: false }" x-init="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" x-cloak x-transition.opacity @click.outside="dropdownOpen = false"
                             class="absolute top-full right-0 mt-2 w-40 bg-white border border-gray-200 rounded-xl shadow-lg z-50 py-2">
                            <a href="{{ route('user.tasks.show', $task->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="ri-eye-line mr-2 text-lg text-gray-500"></i> Open
                            </a>
                        </div>
                    </div>

                    <div class="text-xs font-semibold text-gray-500 uppercase mb-1">{{ $task->title }}</div>
                    <hr class="mb-2 border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        @php
                            $badgeColor = match($task->status) {
                                'To do' => 'bg-red-500',
                                'In-progress' => 'bg-yellow-400',
                                'Completed' => 'bg-green-500',
                                default => 'bg-gray-300',
                            };

                            $priorityColor = match(strtolower($task->priority)) {
                                'low' => 'text-green-600 bg-green-100',
                                'medium' => 'text-yellow-600 bg-yellow-100',
                                'high' => 'text-red-600 bg-red-100',
                                default => 'text-gray-600 bg-gray-100',
                            };
                        @endphp
                        <span class="{{ $badgeColor }} text-white px-2 py-0.5 rounded-full text-[11px]">{{ $task->status }}</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $priorityColor }}">
                            {{ ucfirst($task->priority) }} Priority
                        </span>
                    </div>
                    <div class="text-xs text-gray-500 mb-2">
                        📅 {{ \Carbon\Carbon::parse($task->start_date)->format('D, d M h:i A') }}
                    </div>
                    <p class="text-sm text-gray-700 mb-3">{{ \Illuminate\Support\Str::limit($task->content, 100) }}</p>
                    <div class="mt-4">
                        <span class="text-xs text-gray-500">Assigned To:</span>
                        <div class="flex items-center mt-1 flex-wrap gap-2">
                            @foreach($task->users as $user)
                                @php
                                    $initial = strtoupper(substr($user->name, 0, 1));
                                    $colors = ['red', 'green', 'blue', 'indigo', 'purple', 'yellow', 'pink'];
                                    $bg = $colors[crc32($user->name) % count($colors)];
                                @endphp
                                <div class="relative group" title="{{ $user->name }}">
                                    <div class="w-8 h-8 flex items-center justify-center text-white text-xs font-semibold rounded-full bg-{{ $bg }}-500">
                                        {{ $initial }}
                                    </div>
                                    <div class="absolute bottom-full mb-1 px-2 py-1 bg-gray-800 text-white text-[10px] rounded shadow opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-50">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 text-sm">
                    No tasks assigned to you.
                </div>
            @endforelse
        </div>
    </main>
</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection
