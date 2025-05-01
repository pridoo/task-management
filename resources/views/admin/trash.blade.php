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
                <h2 class="text-2xl font-semibold text-gray-800"> Archived Tasks</h2>
                <form action="{{ route('admin.trash.deleteAll') }}" method="POST" id="deleteAllForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm">
                        + Delete All
                    </button>
                </form>
            </div>
            <div class="bg-white shadow rounded-md border border-gray-200 p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-[700px] w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3"><input type="checkbox"></th>
                                <th class="px-4 py-3">Title</th>
                                <th class="px-4 py-3">Priority</th>
                                <th class="px-4 py-3">Stage</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3"><input type="checkbox"></td>
                                    <td class="px-4 py-3">{{ $task->title }}</td>
                                    <td class="px-4 py-3">{{ $task->priority }}</td>
                                    <td class="px-4 py-3">
                                        <div class="relative w-[127px] h-4">
                                            <div class="absolute left-0 top-0 w-[11px] h-[10px] {{ $task->status == 'Completed' ? 'bg-green-500' : ($task->status == 'To do' ? 'bg-red-500' : 'bg-yellow-500') }} rounded-full">
                                            </div>
                                            <span
                                                class="absolute left-4 top-0 w-[110px] h-4 text-[12px] leading-[15px] font-light text-[#444444]">
                                                {{ $task->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($task->end_date)->format('D, d M Y h:i A') }}</td>
                                    <td class="px-4 py-3 flex space-x-2">
                                        <!-- Permanently delete task -->
                                        <form action="{{ route('admin.trash.destroy', $task->id) }}" method="POST" class="deleteTaskForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700"><i class="ri-delete-bin-line"></i> Delete Permanently</button>
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

<script>
    document.getElementById('deleteAllForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete all archived tasks!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete all!',
            customClass: {
                popup: 'rounded-lg shadow-xl border border-gray-200',
                title: 'text-lg font-semibold text-gray-800',
                content: 'text-gray-600 text-sm',
                confirmButton: 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full focus:outline-none',
                cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full focus:outline-none'
            },
            backdrop: true,
            showCloseButton: true,
            padding: '20px',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
                Swal.fire({
                    title: 'Deleted!',
                    text: 'All archived tasks have been deleted.',
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
    });

    document.querySelectorAll('.deleteTaskForm').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete this task!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    popup: 'rounded-lg shadow-xl border border-gray-200',
                    title: 'text-lg font-semibold text-gray-800',
                    content: 'text-gray-600 text-sm',
                    confirmButton: 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full focus:outline-none',
                    cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full focus:outline-none'
                },
                backdrop: true,
                showCloseButton: true,
                padding: '20px',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'The task has been deleted.',
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
        });
    });
</script>

@endsection
