@extends('layouts.app')
@section('content')

    <!-- Hero Section -->
    <section class="px-2 py-32 bg-white md:px-0">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div
                        class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h1
                            class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl md:text-3xl lg:text-5xl xl:text-6xl">
                            <span
                                class="block xl:inline text-gray-700 font-extrabold text-3xl sm:text-3xl md:text-3xl lg:text-3xl xl:text-5xl md:max-w-3xl">
                                One tool for smooth task management flow
                            </span>
                        </h1>

                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">Tekflow simplifies
                            task
                            management for teams and professionals</p>
                        <div class="relative flex flex-col sm:flex-row sm:space-x-4">
                            <a href="{{ route('register') }}"
                                class="flex items-center w-full px-6 py-3 mb-3 rounded-xl border-2 border-orange-600 font-medium text-orange-600 hover:bg-orange-600 hover:text-white sm:w-auto">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
                        <img src="{{ asset('css/pictures/page2 (1).png') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Section-->
    <section class="px-2 py-12 bg-gray-200 md:px-0">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Title -->
            <h2 class="text-center text-gray-700 font-extrabold text-3xl sm:text-3xl md:text-4xl lg:text-4xl mb-12">
                <span class="block xl:inline text-gray-700 font-extrabold text-3xl">
                    Centralized, straightforward task management software for teams
                </span>
            </h2>
        </div>
        <div class="max-w-2xl mx-auto px-4">
            <div id="default-carousel" class="relative rounded-lg overflow-hidden shadow-lg" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-0 md:h-96" data-carousel-inner>
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('css/pictures/page2 (1).png') }}" class="object-cover w-full h-full" alt="Slide 1">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('css/pictures/page2 (1).png') }}" class="object-cover w-full h-full" alt="Slide 2">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('css/pictures/page2 (1).png') }}" class="object-cover w-full h-full" alt="Slide 3">
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 -translate-x-1/2 space-x-2" data-carousel-indicators>
                    <button type="button"
                        class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition"></button>
                    <button type="button"
                        class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition"></button>
                    <button type="button"
                        class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition"></button>
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="flex absolute top-1/2 left-3 z-40 items-center justify-center w-10 h-10 bg-gray-200/50 rounded-full hover:bg-gray-300 focus:outline-none transition"
                    data-carousel-prev>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button type="button"
                    class="flex absolute top-1/2 right-3 z-40 items-center justify-center w-10 h-10 bg-gray-200/50 rounded-full hover:bg-gray-300 focus:outline-none transition"
                    data-carousel-next>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

        </div>
    </section>

    <!-- Tools Section-->
    <section class="px-2 py-12 bg-white md:px-0">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Title -->
            <h2 class="text-center text-gray-700 font-extrabold text-xl sm:text-2xl md:text-4xl lg:text-4xl mb-10">
                <span class="block xl:inline text-gray-700 font-extrabold text-xl sm:text-3xl">
                    🚀 A Tool That’s Easy to Onboard, Adopt, and Love
                </span>
            </h2>
        </div>
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="-mx-4 flex flex-wrap p-8">

                    <!-- Card 1 -->
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div
                            class="group mb-9 rounded-xl py-8 px-7 border border-gray-300 shadow-md transition-all duration-300 transform hover:shadow-orange-400 hover:scale-105 hover:bg-gradient-to-br from-orange-100 to-white hover:border-orange-400 sm:p-9">
                            <div
                                class="mx-auto mb-7 inline-block text-orange-500 group-hover:text-orange-600 transition-all duration-300 animate-none group-hover:animate-bounce">
                                <i class="bi bi-card-list text-4xl mb-4"></i>
                            </div>
                            <div>
                                <h3
                                    class="mb-4 text-xl font-bold text-gray-700 sm:text-2xl lg:text-xl xl:text-2xl group-hover:text-orange-600">
                                    Free to Get Started
                                </h3>
                                <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                                    Easily visualize and organize tasks.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div
                            class="group mb-9 rounded-xl py-8 px-7 border  border-gray-300 shadow-md transition-all duration-300 transform hover:shadow-orange-300 hover:scale-105 hover:bg-gradient-to-br from-orange-100 to-white hover:border-orange-400 sm:p-9">
                            <div
                                class="mx-auto mb-7 inline-block text-orange-500 group-hover:text-orange-600 transition-all duration-300 animate-none group-hover:animate-bounce">
                                <i class="bi bi-flag text-4xl mb-4"></i>
                            </div>
                            <div>
                                <h3
                                    class="mb-4 text-xl font-bold text-gray-700 sm:text-2xl lg:text-xl xl:text-2xl group-hover:text-orange-600">
                                    Free to Get Started
                                </h3>
                                <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                                    Assign priority levels to tasks for better workflow efficiency.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div
                            class="group mb-9 rounded-xl py-8 px-7 border  border-gray-300 shadow-md transition-all duration-300 transform hover:shadow-orange-300 hover:scale-105 hover:bg-gradient-to-br from-orange-100 to-white hover:border-orange-400 sm:p-9">
                            <div
                                class="mx-auto mb-7 inline-block text-orange-500 group-hover:text-orange-600 transition-all duration-300 animate-none group-hover:animate-bounce">
                                <i class="bi bi-person-fill text-4xl mb-4"></i>
                            </div>
                            <div>
                                <h3
                                    class="mb-4 text-xl font-bold text-gray-700 sm:text-2xl lg:text-xl xl:text-2xl group-hover:text-orange-600">
                                    Free to Get Started
                                </h3>
                                <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                                    Assign tasks to specific team members.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div
                            class="group mb-9 rounded-xl py-8 px-7 border border-gray-300 shadow-md transition-all duration-300 transform hover:shadow-orange-300 hover:scale-105 hover:bg-gradient-to-br from-orange-100 to-white hover:border-orange-400 sm:p-9">
                            <div
                                class="mx-auto mb-7 inline-block text-orange-500 group-hover:text-orange-600 transition-all duration-300 animate-none group-hover:animate-bounce">
                                <i class="bi bi-chat-left-text text-4xl mb-4"></i>
                            </div>
                            <div>
                                <h3
                                    class="mb-4 text-xl font-bold text-gray-700 sm:text-2xl lg:text-xl xl:text-2xl group-hover:text-orange-600">
                                    Free to Get Started
                                </h3>
                                <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                                    Collaborate directly within tasks by adding feedback.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div
                            class="group mb-9 rounded-xl py-8 px-7 border  border-gray-300 shadow-md transition-all duration-300 transform hover:shadow-orange-300 hover:scale-105 hover:bg-gradient-to-br from-orange-100 to-white hover:border-orange-400 sm:p-9">
                            <div
                                class="mx-auto mb-7 inline-block text-orange-500 group-hover:text-orange-600 transition-all duration-300 animate-none group-hover:animate-bounce">
                                <i class="bi bi-tag text-4xl mb-4"></i>
                            </div>
                            <div>
                                <h3
                                    class="mb-4 text-xl font-bold text-gray-700 sm:text-2xl lg:text-xl xl:text-2xl group-hover:text-orange-600">
                                    Free to Get Started
                                </h3>
                                <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                                    Tag teammates and get instant updates.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--Card 6 -->
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div
                            class="group mb-9 rounded-xl py-8 px-7 border  border-gray-300 shadow-md transition-all duration-300 transform hover:shadow-orange-300 hover:scale-105 hover:bg-gradient-to-br from-orange-100 to-white hover:border-orange-400 sm:p-9">
                            <div
                                class="mx-auto mb-7 inline-block text-orange-500 group-hover:text-orange-600 transition-all duration-300 animate-none group-hover:animate-bounce">
                                <i class="bi bi-clock text-4xl mb-4"></i>
                            </div>
                            <div>
                                <h3
                                    class="mb-4 text-xl font-bold text-gray-700 sm:text-2xl lg:text-xl xl:text-2xl group-hover:text-orange-600">
                                    Free to Get Started
                                </h3>
                                <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                                    Track time spent on tasks and improve productivity.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--Security Section -->
    <section class="px-2 py-10 bg-orange-500 md:px-0">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div
                        class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-8 text-white">
                            Enterprise-Grade Security 🔒
                        </h2>

                        <div class="flex flex-col space-y-6">
                            <div class="flex items-center space-x-3 bg-white/10 px-6 py-4 rounded-lg shadow-md">
                                <i class="bi bi-lock text-2xl sm:text-3xl text-white"></i>
                                <span class="text-base sm:text-lg text-white">Role-Based Access Control</span>
                            </div>
                            <div class="flex items-center space-x-3 bg-white/10 px-6 py-4 rounded-lg shadow-md">
                                <i class="bi bi-shield-lock text-2xl sm:text-3xl text-white"></i>
                                <span class="text-base sm:text-lg text-white">Secure Transactions</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div>
                        <img src="{{ asset('css/pictures/security2.png')  }}" alt="Security Illustration"
                            class="mx-auto w-60 mr-9">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--Contact Section -->
    <section class="px-2 py-20 bg-white md:px-0">
        <div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-700">
                Do you have question?
            </h2>
            <p class="mb-6 text-base sm:text-lg text-gray-500">
                Feel free to reach out our team
            </p>
        </div>
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2">
                    <div class="rounded-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16888.08991951978!2d120.80377748450348!3d15.942087528656897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33912191ddc2950d%3A0x174eeec6bb4557ca!2sBarat%20Elementary%20School%2023%20Mak!5e0!3m2!1sen!2sus!4v1743941253822!5m2!1sen!2sus"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <form action="{{ route('admin.messages.submit') }}" method="POST" class="p-6 flex flex-col justify-center">
                        @csrf
                        <!-- Full Name Input -->
                        <div class="flex flex-col mt-4">
                            <label for="name" class="text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="name" placeholder="Full Name"
                                class="mt-2 py-3 px-3 rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <!-- Email Input -->
                        <div class="flex flex-col mt-4">
                            <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email"
                                class="mt-2 py-3 px-3 rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <!-- Message Textarea -->
                        <div class="flex flex-col mt-4">
                            <label for="message" class="text-sm font-medium text-gray-700">Message</label>
                            <textarea name="message" id="message" placeholder="How can our team help you?"
                                class="mt-2 py-3 px-3 rounded-lg bg-gray-100 border dark:border-gray-700 text-sm font-light text-gray-500 focus:border-orange-500 focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" rows="4" required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="md:w-32 rounded-xl border-2 border-orange-600 px-6 py-2 text-sm sm:text-base font-medium text-white bg-orange-600 hover:bg-white hover:text-orange-600 mt-6">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection