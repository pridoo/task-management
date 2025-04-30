@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100"
     x-data="{ open: false, editOpen: false, selectedUser: {} }"
     x-init="open = false; editOpen = false">

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
                                        <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                                            <i class="ri-user-3-line"></i>
                                        </div>
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">John Doe</div>
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
                                        <div class="w-8 h-8 bg-yellow-500 text-white flex items-center justify-center rounded-full">
                                            <i class="ri-checkbox-circle-line"></i>
                                        </div>
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">Tasks completed</div>
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
            <h2 class="text-2xl font-semibold text-gray-800">Approved Users</h2>
        </div>

        <!-- Legend -->
        <div class="mb-4 border border-gray-300 rounded-lg p-4 bg-white shadow-sm w-fit">
            <div class="flex space-x-4">
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    <span class="text-sm text-gray-700">Active Users</span>
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
                        @foreach($approvedUsers as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->role ?? 'Developer' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <form method="POST" action="{{ route('admin.unapprove-user',  ['userId' => $user->id]) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="ri-delete-bin-line text-lg"></i>
                                    </button>
                                </form>
                                <button 
                                    @click="editOpen = true; selectedUser = {{ $user->toJson() }}" 
                                    class="text-blue-500 hover:text-blue-700"
                                >
                                    <i class="ri-lock-unlock-line text-lg"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('status') && session('userName'))
    <script>
        let status = "{{ session('status') }}";
        let userName = "{{ session('userName') }}";

        if (status === 'unapproved') {
            Swal.fire({
                title: 'User Unapproved!',
                text: `${userName} has been removed from the approved list.`,
                icon: 'warning',
                confirmButtonText: 'Okay',
                customClass: {
                    popup: 'rounded-lg shadow-xl border border-gray-200',
                    title: 'text-lg font-semibold text-gray-800', 
                    content: 'text-gray-600 text-sm', 
                    confirmButton: 'bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full focus:outline-none', 
                },
                backdrop: true,
                showCloseButton: true,
                padding: '20px', 
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error!',
                text: `${userName} could not be found.`,
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
        }
    </script>
    @endif
    
    @if(session('status') && session('message'))
    <script>
        Swal.fire({
            title: "{{ session('status') == 'success' ? 'Success!' : 'Error!' }}",
            text: "{{ session('message') }}",
            icon: "{{ session('status') == 'success' ? 'success' : 'error' }}",
            confirmButtonText: 'Okay',
            customClass: {
                popup: 'rounded-lg shadow-xl border',
                title: 'text-lg font-semibold',
                content: 'text-gray-600 text-sm',
                confirmButton: 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full focus:outline-none',
            },
        });
    </script>
    @endif



    <div x-show="editOpen" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div @click.outside="editOpen = false" class="w-full max-w-lg bg-white p-6 rounded-xl shadow-xl border border-gray-200">
            @include('admin.tasks.modal.edit-password')
        </div>
    </div>

</div>


<script src="//unpkg.com/alpinejs" defer></script>

@endsection
