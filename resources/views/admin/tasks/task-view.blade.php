@extends('layouts.admin')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

    <div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

        <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
            <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
                <div class="flex justify-end items-center">
                    <ul class="flex items-center space-x-4">
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
                            @if($task->attachment)
                                @php
                                    $file = $task->attachment;
                                    $filename = basename($file);
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
                            @else
                                <p class="text-sm text-gray-500">No attachments uploaded.</p>
                            @endif
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
                </div>

                <!-- Comments Tab -->
                <div x-show="tab === 'comments'" x-cloak>
                    @include('admin.tasks.comments', ['task' => $task]) 
                </div>
            </div>
        </main>
    </div>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

@endsection
