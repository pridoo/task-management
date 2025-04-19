@extends('layouts.app')
@section('content')

    <!-- Large Screen Hero Section -->
    <section class="px-2 py-20 bg-white md:px-0 hidden md:block">
        <div class="container items-center max-w-8xl mx-auto xl:px-4">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 pl-9">
                    <div class="w-full pb-6 space-y-6 sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl md:pb-0">
                        <h1
                            class="flex items-center text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl md:text-5xl lg:text-6xl">
                            <span class="text-orange-700 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 64 64"
                                    class="w-10 h-10 md:w-12 md:h-12">
                                    <path d="M2 32c7 0 7-12 14-12s7 12 14 12 7-12 14-12 7 12 14 12" stroke="currentColor"
                                        stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M2 40c7 0 7 12 14 12s7-12 14-12 7 12 14 12 7-12 14-12" stroke="currentColor"
                                        stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span class="text-orange-600">TEKFLOW</span>
                        </h1>

                        <p class="text-sm text-gray-500 sm:text-base md:text-lg lg:text-xl">
                            Tekflow simplifies task management for teams and professionals
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 pr-9">
                    <div class="max-w-9xl bg-white rounded-2xl shadow-2xl flex overflow-hidden transform">
                        <!-- Left Side - Login -->
                        <div class="flex-1 basis-1/2 p-12 bg-gray-50 flex flex-col justify-center">
                            <h2 class="text-4xl font-extrabold text-orange-500 text-center mb-8">Log In</h2>
                            <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-5">
                                @csrf
                                <input type="text" name="id_number" placeholder="ID - number"
                                    class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <input type="password" name="password" placeholder="Password"
                                    class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <button type="submit"
                                    class="w-full bg-orange-500 text-white py-3 rounded-full font-semibold shadow-lg hover:bg-orange-600 transition-all duration-300">Login</button>
                            </form>
                            <div class="text-center mt-6">
                                <a href="#" class="text-gray-500 hover:underline">Forgot your password?</a>
                                <p class="text-gray-500 mt-1">or</p>
                                <p class="text-gray-500 hover:underline">Login with Email</p>
                            </div>

                            <div class="flex justify-center mt-3">
                                <a href="{{ route('login') }}">
                                    <img src="{{ asset('css/pictures/mail.png') }}" alt="Mail"
                                        class="w-20 h-20 object-contain hover:scale-105 transition-all duration-300">
                                </a>
                            </div>
                        </div>

                        <!-- Right Side - Sign Up -->
                        <div
                            class="flex-1 basis-1/2 bg-gradient-to-r from-orange-500 to-orange-700 p-12 flex flex-col justify-center text-white text-center">
                            <h2 class="text-4xl font-extrabold mb-4">New Here?</h2>
                            <p class="text-lg mb-6 leading-relaxed">Sign up now to experience a smooth and efficient
                                workflow!</p>
                            <a href="{{ route('register') }}"
                                class="bg-white text-orange-500 px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-gray-200 transition-all duration-300 text-lg">Sign
                                Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Responsive Login Section -->
    <section class="bg-gray-50 dark:bg-gray-900 block md:hidden">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen">
            <div
                class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-3xl font-extrabold leading-tight tracking-tight text-orange-600 dark:text-white text-center">
                        Login
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <input type="text" name="id_number" id="ID - number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="ID-number" required="">
                        </div>

                        <div>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>
                        <button type="submit"
                            class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold shadow-lg hover:bg-orange-600 transition-all duration-300">Log
                            In</button>

                        <div class="text-center mt-4">
                            <a href="#" class="text-sm font-light text-gray-500 dark:text-gray-400 hover:underline">Forgot
                                your password?</a>
                            <p class="text-gray-500 mt-2">or</p>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400 hover:underline">Login with Email</p>
                        </div>

                        <div class="flex justify-center">
                            <a href="{{ route('login') }}">
                                <img src="{{ asset('css/pictures/mail.png') }}" alt="Mail"
                                    class="w-24 h-24 object-contain hover:scale-105 transition-all duration-300">
                            </a>
                        </div>
                        <p class="text-center text-sm font-light text-black-500 dark:text-gray-400">
                            Don't have an account? <a href="{{ route('register') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign Up here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection