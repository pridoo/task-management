@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<div class="min-h-screen bg-gray-100" x-data="{ open: false, editOpen: false }" x-init="open = false; editOpen = false">

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

    <main class="pt-28 pl-[310px] pr-6 bg-gray-50 min-h-screen">
        <div class="w-full max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Profile</h2>

            <div class="flex justify-center">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-xl p-8 w-full max-w-md transition-all hover:shadow-2xl">
                    <div class="flex flex-col items-center space-y-5">

                        <!-- Profile Picture Section -->
                        <form action="{{ route('user.settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="w-full space-y-4 mt-4" id="profileForm">
                            @csrf


                            <div class="relative group mb-18 flex justify-center">
                                <div class="relative">
                                    <div class="relative w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center text-5xl text-gray-400 border-4 border-white shadow-inner ml-5">
                                        <img id="profilePicPreview" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('css/pictures/default.png') }}" alt="Profile Picture" class="w-40 h-60 rounded-full object-contain">
                                    
                                        <button type="button" id="editProfilePicBtn" class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full text-xs opacity-0 group-hover:opacity-100 transition hover:bg-blue-700 shadow">
                                            <i class="ri-edit-2-line text-sm"></i>
                                        </button>
                                    </div>
                                    <input type="file" id="profilePicInput" name="profile_picture" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" />
                                    <h3 class="text-xl font-semibold text-gray-700 text-center">{{ $user->name }}</h3>
                                </div>
                            </div>
                            <!-- Name -->
                            <div>
                                <label class="text-sm text-gray-600 font-medium">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="text-sm text-gray-600 font-medium">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
                            </div>

                            <!-- ID Number -->
                            <div>
                                <label class="text-sm text-gray-600 font-medium">ID Number</label>
                                <input type="text" name="id_number" value="{{ old('id_number', $user->id_number) }}"
                                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
                            </div>
                            <!-- Submit Button -->
                            <div class="flex justify-center mt-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-full shadow hover:shadow-md transition-all">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

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
            confirmButtonColor: '#22c55e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!',
            customClass: {
                popup: 'rounded-lg shadow-xl border border-blue-500',
                title: 'text-lg font-semibold text-blue-700',
                content: 'text-blue-600 text-sm',
                confirmButton: 'bg-orange-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full focus:outline-none',
                cancelButton: 'bg-red-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full focus:outline-none' 
            },
            backdrop: true,
            showCloseButton: true,
            padding: '20px',
        }).then((result) => {
            if (result.isConfirmed) {
             
                this.submit();

        
                Swal.fire({
                    title: 'Success!',
                    text: 'Your changes have been saved.',
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
</script>

@endsection
