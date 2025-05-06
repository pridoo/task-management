@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100"
     x-data="{ open: false, editOpen: false, showModal: false }"
     x-init="open = false; editOpen = false">

    <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-lg border border-gray-200 px-6 py-4">
            <div class="flex justify-end items-center">
                <ul class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <li class="relative" x-data="{ open: false }" x-init="open = false">
                        <button @click="open = !open"
                            class="notif-btn text-gray-400 w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                            <i class="ri-notification-4-line"></i>
                        </button>
                        <div x-show="open" x-cloak @click.outside="open = false"
                            class="absolute right-0 mt-2 max-w-xs w-80 bg-white rounded-lg border border-gray-100 shadow-md z-30">
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

    <main class="pt-28 pl-[310px] pr-6 bg-gray-50 min-h-screen">
        <div class="w-full max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Change Password</h2>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg p-8 max-w-md mx-auto">
                <form id="passwordChangeForm" action="{{ route('user.settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="old_password" class="block text-sm font-medium text-gray-700 mb-1">Old Password</label>
                        <input type="password" id="old_password" name="old_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    </div>

                    <div class="mb-6">
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <input type="password" id="new_password" name="new_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    </div>

                    <div class="text-center">
                        <button type="button"
                            @click="showModal = true"
                            class="bg-blue-500 text-white py-2 px-6 rounded-full hover:bg-blue-600 transition duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

 
    <div x-show="showModal" x-cloak class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Confirm Password Change</h3>
            <p class="text-sm text-gray-600 mb-4">Are you sure you want to change your password?</p>
            <div class="flex justify-end space-x-2">
                <button @click="showModal = false"
                    class="bg-gray-300 text-gray-800 py-2 px-4 rounded-full">Cancel</button>
                <button @click="document.getElementById('passwordChangeForm').submit()"
                    class="bg-blue-500 text-white py-2 px-4 rounded-full">Yes, Change</button>
            </div>
        </div>
    </div>

</div>


<script>
    @if(session('success'))
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Password Changed!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Okay',
            customClass: {
                popup: 'rounded-xl shadow-lg',
                title: 'text-lg font-semibold text-green-700',
                content: 'text-green-600 text-sm',
                confirmButton: 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full',
            },
            backdrop: true,
            showCloseButton: true,
        });
    });
    @endif
</script>

@endsection
