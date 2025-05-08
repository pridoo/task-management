@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SWEETALERT2 -->

    <div class="min-h-screen bg-gray-100" x-data="{ 
                             open: false, 
                             editOpen: false, 
                             showCreated: {{ session()->pull('task_created') ? 'true' : 'false' }},
                             showDeleted: {{ session()->pull('task_deleted') ? 'true' : 'false' }}
                         }" x-init="
                             if (showCreated) {
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'Task Created Successfully!',
                                     text: '{{ session('task_created') }}',
                                     confirmButtonColor: '#22c55e',
                                     timer: 2000,
                                     timerProgressBar: true,
                                     showConfirmButton: false
                                 });
                             }
                             if (showDeleted) {
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'Deleted Successfully!',
                                     text: '{{ session('task_deleted') }}',
                                     confirmButtonColor: '#22c55e',
                                     timer: 2000,
                                     timerProgressBar: true,
                                     showConfirmButton: false
                                 });
                             }
                         ">


        <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
            <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
                <div class="flex justify-end items-center">
                    <ul class="flex items-center space-x-4">


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

        <main class="pt-24 px-6 ml-64">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Tasks</h2>
            <button @click="open = true" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                + Create Task
            </button>
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

        <!-- Task List -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($tasks as $task)
                <div class="bg-white shadow rounded-lg p-4 border relative">
                    <div class="absolute top-2 right-2" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" x-cloak @click.outside="dropdownOpen = false"
                            class="absolute top-full right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg z-50 py-2">
                            <a href="{{route('admin.tasks.user.tasks.show', $task->id) }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="ri-eye-line mr-2 text-lg text-gray-500"></i> Open
                            </a>

<<<<<<< HEAD
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @foreach ($tasks as $task)
                    <div class="bg-white shadow rounded-lg p-4 border relative">
                        <div class="absolute top-2 right-2" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z" />
                                </svg>
                            </button>
                            <div x-show="dropdownOpen" x-cloak @click.outside="dropdownOpen = false"
                                class="absolute top-full right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg z-50 py-2">
                                <a href="{{route('admin.tasks.tasks.show', $task->id) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="ri-eye-line mr-2 text-lg text-gray-500"></i> Open
                                </a>

                                <a href="#" @click.prevent="editOpen = true; $dispatch('open-edit-modal', { task: @js($task) })"
                                    class="flex items-center px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">
                                    <i class="ri-edit-line mr-2 text-lg"></i> Edit
                                </a>
=======
                            <a href="#"
                            onclick="openEditModal({{ $task->id }}, '{{ addslashes($task->title) }}', '{{ addslashes($task->content) }}', '{{ $task->start_date }}', '{{ $task->end_date }}', '{{ json_encode($assignedUsers[$task->id]) }}')"
                            class="flex items-center px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">
                                <i class="ri-edit-line mr-2 text-lg"></i> Edit
                            </a>
>>>>>>> origin/alfred

        
                            <form method="POST" action="{{ route('admin.tasks.destroy', $task->id) }}"
                                    onsubmit="return confirmArchive(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="ri-archive-line mr-2 text-lg"></i> Archived
                                    </button>
                                </form>
                        </div>
                        
                    </div>

                    <div class="text-xs font-semibold text-gray-500 uppercase mb-1">{{ $task->title }}</div>
                    <hr class="mb-2 border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        <span class="bg-{{ $task->status == 'To do' ? 'red' : ($task->status == 'In-progress' ? 'yellow' : 'green') }}-500 text-white px-2 py-0.5 rounded-full text-[11px]">{{ $task->status }}</span>
                        <span class="text-xs font-semibold text-{{ $task->priority === 'High' ? 'red' : ($task->priority === 'Medium' ? 'yellow' : 'green') }}-500">
                            {{ $task->priority ? ucfirst($task->priority) : 'No Priority' }} Priority
                        </span>
                    </div>
                    <div class="text-xs text-gray-500 mb-2">
                        📅 {{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('D, d M Y h:i A') : 'No End Date' }}
                    </div>
                    <p class="text-sm text-gray-700 mb-3">{{ $task->content }}</p>

                    <div class="mt-4">
                        <span class="text-xs text-gray-500">Assigned To:</span>
                        <div class="flex items-center mt-1 space-x-2">
                            @foreach($task->users as $user)
                                @php
                                    $initial = strtoupper(substr($user->name, 0, 1));
                                    $colors = ['red', 'green', 'blue', 'indigo', 'purple', 'yellow', 'pink'];
                                    $bg = $colors[crc32($user->name) % count($colors)];
                                @endphp
                                <div class="relative group" title="{{ $user->name }}">
                                    <div class="w-7 h-7 flex items-center justify-center text-white text-xs font-semibold rounded-full bg-{{ $bg }}-500">
                                        {{ $initial }}
                                    </div>
                                    <!-- Optional tooltip on hover using pure CSS (in case title doesn't work well) -->
                                    <div class="absolute bottom-full mb-1 px-2 py-1 bg-gray-800 text-white text-[10px] rounded shadow opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-50">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Edit Modal -->
        <div id="editTaskModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden">
            <div class="w-[90%] sm:w-[480px] max-h-[90vh] overflow-hidden bg-white rounded-xl shadow-xl border border-gray-200">
                <div class="p-6 overflow-y-auto max-h-[80vh] modal-scroll">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Edit Task</h2>
                        <button onclick="closeEditModal()" class="text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</button>
                    </div>

                    <!-- Edit Task Form -->
                    <form method="POST" id="editTaskForm" enctype="multipart/form-data" class="space-y-4 text-sm" action="">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label class="block font-medium text-gray-600 mb-1">Title</label>
                            <input type="text" name="title" id="editTaskTitle" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block font-medium text-gray-600 mb-1">Description</label>
                            <textarea name="content" id="editTaskContent" rows="3" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
                        </div>

                        <!-- Start and End Dates -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-gray-600 mb-1">Start Date</label>
                                <input type="datetime-local" name="start_date" id="editTaskStartDate" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>
                            <div>
                                <label class="block font-medium text-gray-600 mb-1">End Date</label>
                                <input type="datetime-local" name="end_date" id="editTaskEndDate" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block font-medium text-gray-600 mb-1">Status</label>
                            <select name="status" id="editTaskStatus" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="To do">To Do</option>
                                <option value="In-progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <!-- Assigned Users -->
                        <div>
                            <label class="block font-medium text-gray-600 mb-1">Assigned To</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto border border-gray-200 rounded-lg p-2">
                            <label class="flex items-center justify-between">
                                <span>Select All</span>
                                <input type="checkbox" id="editSelectAll" class="editUserCheckbox">
                            </label>
                                @foreach ($users as $user)
                                    <label class="flex items-center justify-between">
                                        <span>{{ $user->name }}</span>
                                        <input type="checkbox" name="assigned_to[]" value="{{ $user->id }}" class="editUserCheckbox">
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Priority & Attachment -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-gray-600 mb-1">Priority</label>
                                <select name="priority" id="editTaskPriority" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium text-gray-600 mb-1">Replace Attachment</label>
                                <input type="file" name="attachment"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div>
                            <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition">
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

        <!-- Create Task Modal -->
        <div x-show="open" x-cloak x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.outside="open = false"
                class="w-full max-w-lg bg-white p-6 rounded-xl shadow-xl border border-gray-200">
                @include('admin.tasks.modal.create-tasks')
            </div>
        </div>



    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmArchive(event) {
            event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "This task will be archived.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, archive it!',
            cancelButtonText: 'Cancel',
            customClass: {
                popup: 'rounded-lg shadow-xl border border-gray-200', 
                title: 'text-lg font-semibold text-gray-800', 
                content: 'text-gray-600 text-sm', 
                confirmButton: 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full focus:outline-none', 
                cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full focus:outline-none' 
            },
            backdrop: true, 
            showCloseButton: true, 
            padding: '20px',
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); 

                Swal.fire({
                    title: 'Archived!',
                    text: 'The task has been archived successfully.',
                    icon: 'success',
                    confirmButtonColor: '#22c55e',
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
            }
        });

        return false; 
    }

    document.addEventListener('DOMContentLoaded', function () {
        
        const dropdownButton = document.getElementById('editDropdownButton');
        const dropdownMenu = document.getElementById('editDropdownMenu');
        const selectAll = document.getElementById('editSelectAll');

        if (dropdownButton && dropdownMenu) {
            dropdownButton.addEventListener('click', function () {
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!dropdownMenu.contains(event.target) && event.target !== dropdownButton) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }

        if (selectAll) {
            selectAll.addEventListener('change', function () {
                const checkboxes = document.querySelectorAll('.editUserCheckbox');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }
    });

    function openEditModal(taskId, title, content, startDate, endDate, assignedUsers) {
        const form = document.getElementById('editTaskForm');

        form.action = `/admin/tasks/${taskId}/update`;

        // Set form fields
        document.getElementById('editTaskTitle').value = title;
        document.getElementById('editTaskContent').value = content;
        document.getElementById('editTaskStartDate').value = startDate;
        document.getElementById('editTaskEndDate').value = endDate;

     
        let assignedUserIds = JSON.parse(assignedUsers);
        document.querySelectorAll('.editUserCheckbox').forEach(checkbox => {
            checkbox.checked = assignedUserIds.includes(parseInt(checkbox.value));
        });

        document.getElementById('editTaskModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editTaskModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                title: 'Task Updated!',
                text: '{{ session('task_updated') }}',
                icon: 'success',
                confirmButtonColor: '#22c55e',
                customClass: {
                    popup: 'rounded-xl shadow-lg border border-green-300',
                    title: 'text-xl font-semibold text-green-700',
                    content: 'text-sm text-green-600',
                    confirmButton: 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full focus:outline-none'
                },
                timer: 2500,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>



@endsection