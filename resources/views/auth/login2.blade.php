@extends('layouts.auth')

@section('content')
<div class="flex justify-center items-center">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl flex overflow-hidden transform">
        <div class="w-1/2 p-10 bg-gray-50 flex flex-col justify-center">

            <div class="flex items-center justify-center space-x-2">
                <h2 class="text-3xl font-extrabold text-orange-500">Log In</h2>
            </div>

            <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                <input type="text" name="id_number" placeholder="ID - number" class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="password" name="password" placeholder="Password" class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-full font-semibold shadow-lg hover:bg-orange-600 transition-all duration-300">Login</button>
            </form>
            
            <div class="text-center mt-4">
                <a href="#" class="text-orange-500 hover:underline">Forgot your password?</a>
                <p class="text-gray-500 mt-2">or</p>
                <p class="text-orange-500 font-semibold mt-2">Login with Email</p>
            </div>

            <div class="flex justify-center mt-6">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('css/pictures/mail.png') }}" alt="ID Card" class="w-24 h-24 object-contain hover:scale-105 transition-all duration-300">
                </a>
            </div>

        </div>

        <div class="w-1/2 bg-gradient-to-r from-orange-500 to-orange-700 p-10 flex flex-col justify-center text-white text-center">
            <h2 class="text-3xl font-extrabold">New Here?</h2>
            <p class="mt-4 text-lg">Sign up now to experience a smooth and efficient workflow!</p>
            <a href="{{ route('register') }}" class="mt-6 bg-white text-orange-500 px-6 py-3 rounded-full font-semibold shadow-lg hover:bg-gray-200 transition-all duration-300">Sign Up</a>
        </div>
    </div>
</div>
@endsection




