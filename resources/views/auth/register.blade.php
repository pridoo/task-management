@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="px-2 py-2 bg-white md:px-0 dark:bg-gray-900">
    <div class="container items-center max-w-6xl px-3 mx-auto xl:px-5">
        <div class="flex flex-wrap items-center sm:-mx-3">
            <div class="w-full px-4 md:w-1/2 md:px-6">
                <div class="w-full pb-6 space-y-6 sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl md:pb-0">
                    <h1 class="flex items-center text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl md:text-5xl lg:text-6xl">
                        <span class="text-orange-700 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 64 64" class="w-10 h-10 md:w-12 md:h-12">
                                <path d="M2 32c7 0 7-12 14-12s7 12 14 12 7-12 14-12 7 12 14 12" stroke="currentColor" stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2 40c7 0 7 12 14 12s7-12 14-12 7 12 14 12 7-12 14-12" stroke="currentColor" stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="text-orange-600">TEKFLOW</span>
                    </h1>

                    <p class="text-sm text-gray-500 sm:text-base md:text-lg lg:text-xl">
                        Tekflow simplifies task management for teams and professionals
                    </p>
                </div>
            </div>

            <div class="w-full md:w-1/2">
                <section class="bg-gray-50 dark:bg-gray-900">
                    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <h1 class="text-3xl font-extrabold leading-tight tracking-tight text-orange-600 md:text-2xl dark:text-white text-center">
                                    Create an account
                                </h1>

                                @if ($errors->any())
                                    <div class="mb-4 text-red-600 bg-red-100 border border-red-400 rounded p-4">
                                        <ul class="list-disc list-inside text-sm">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form id="registrationForm" method="POST" class="space-y-4 md:space-y-6" action="{{ route('auth.register.store') }}">
                                    @csrf

                                    <!-- Name Input -->
                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name" class="rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Name" value="{{ old('name') }}" required>
                                    </div>

                                    <!-- Email Input -->
                                    <div>
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email" id="email" class="rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Email" value="{{ old('email') }}" required>
                                    </div>

                                    <!-- ID Number Input -->
                                    <div>
                                        <label for="id_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Number</label>
                                        <input type="text" name="id_number" id="id_number" class="rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="ID Number" value="{{ old('id_number') }}" required>
                                    </div>

                                    <!-- Password Input -->
                                    <div>
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                        <input type="password" name="password" id="password" class="rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Password" required>
                                    </div>

                                    <!-- Password Confirmation Input -->
                                    <div>
                                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Confirm Password" required>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit"
                                        class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold shadow-lg hover:bg-orange-600 transition-all duration-300">
                                        Create an account
                                    </button>

                                    <!-- Login Link -->
                                    <p class="text-center text-sm font-light text-gray-500 dark:text-gray-400">
                                        Already have an account? <a href="{{ route('login') }}"
                                            class="font-medium text-primary-600 hover:underline hover:text-orange-600 dark:text-primary-500">Login
                                            here</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        setTimeout(function() {
            Swal.fire({
                title: 'Your account is pending approval',
                text: "Hang tight! We're reviewing your details. You'll be notified once you're approved.",
                icon: 'info',
                confirmButtonText: 'Okay / Got it',
                customClass: {
                    popup: 'rounded-lg shadow-xl border border-blue-500',
                    title: 'text-lg font-semibold text-blue-700',
                    content: 'text-blue-600 text-sm',
                    confirmButton: 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full focus:outline-none',
                },
                backdrop: true,
                showCloseButton: true,
                padding: '20px',
            }).then(() => {
                event.target.submit();
            });
        }, 500);
    });
</script>


@endsection
