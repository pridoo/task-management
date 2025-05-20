@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100" x-data="{ open: false }" x-init="open = false">

    <!-- Header -->
    <header class="fixed top-0 left-[310px] w-[calc(100%-340px)] px-4 z-50">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-md border border-gray-200 px-6 py-4">
            <div class="flex justify-end items-center">
                <ul class="flex items-center space-x-4">
                    <!-- Messages -->
                    <li class="relative" x-data="{ open: false }" x-init="open = false">
                        <button @click="open = !open" class="msg-btn text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
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
                                                <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">{{ $msg->name }}</div>
                                                <div class="text-[11px] text-gray-400">{{ Str::limit($msg->message, 40) }}</div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                                <li class="border-t border-gray-100">
                                    <a href="{{ route('admin.messages.index') }}" class="block text-center text-sm text-blue-600 py-2 hover:underline">
                                        View all messages
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

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
                                                        {{ $activity->task->title ?? 'No Task' }}
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

    <!-- Main Content -->
    <main class="pt-28 pl-[310px] pr-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Admin Profile</h2>

            <div class="profile-form">
                <form action="{{ route('admin.settings.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    <div class="flex flex-col md:flex-row items-center gap-8" style="display:flex; flex-direction:column;">

                        <!-- Profile Picture -->
                       <!-- Profile Picture -->
<div class="md:w-1/3 text-center relative">
   <!-- Circle Profile Image -->
<div class="relative w-40 h-40 rounded-full bg-gray-200 ring-4 ring-orange-500 overflow-hidden mx-auto group">
    <img id="profilePicPreview"
        src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('css/pictures/default.png') }}"
        class="absolute inset-0 w-full h-full object-cover object-center"
        alt="Profile Picture" style="width:100%;" />

    <input type="file" id="profilePicInput" name="profile_picture"
        class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" />
</div>


    <!-- Edit Button Outside the Circle -->
    <button type="button" id="editProfilePicBtn"
        class="absolute top-[calc(100%+-40px)] right-[calc(50%-80px)] bg-orange-600 text-white py-[3px] px-[7px] rounded-full shadow transition">
        <i class="ri-edit-2-line text-sm"></i>
    </button>
</div>


                        <!-- Profile Info -->
                        <div class="md:w-2/3 space-y-6 bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $admin->name) }}"
            class="w-full px-4 py-2 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200" />
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
        <input type="text" name="email" value="{{ old('email', $admin->email) }}"
            class="w-full px-4 py-2 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200" />
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">ID Number</label>
        <input type="text" name="id_number" value="{{ old('id_number', $admin->id_number) }}"
            class="w-full px-4 py-2 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200" />
    </div>

    <div class="text-center pt-4">
        <button type="submit"
            class="inline-block px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-full shadow-md transition duration-200">
            Save Changes
        </button>
    </div>
</div>

                    </div>
                </form>
            </div>

        </div>
    </main>
</div>

<!-- Profile Picture Preview & SweetAlert -->
<script>
    const profilePicInput = document.getElementById('profilePicInput');
    const profilePicPreview = document.getElementById('profilePicPreview');

    document.getElementById('editProfilePicBtn').addEventListener('click', () => {
        profilePicInput.click();
    });

    profilePicInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePicPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to save these changes?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
                Swal.fire({
                    title: 'Saved!',
                    text: 'Your changes have been updated.',
                    icon: 'success',
                    confirmButtonColor: '#10b981'
                });
            }
        });
    });
</script>

@endsection
