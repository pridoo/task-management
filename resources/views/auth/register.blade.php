@extends('layouts.auth')

@section('content')
<div class="flex justify-center items-center ">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl flex overflow-hidden transform ">
        <div class="w-1/2 bg-gradient-to-r from-orange-500 to-orange-700 p-10 flex flex-col justify-center text-white text-center">
            <h2 class="text-3xl font-extrabold">Welcome Back</h2>
            <p class="mt-4 text-lg">Glad to see you again. Enter your credentials and pick up right where you left off.</p>
            <a href="{{ route('login') }}" class="mt-6 bg-white text-orange-500 px-6 py-3 rounded-full font-semibold shadow-lg hover:bg-gray-200 transition-all duration-300">Log In</a>
        </div>
        <div class="w-1/2 p-10 bg-gray-50 flex flex-col justify-center">
            <h2 class="text-3xl font-extrabold text-orange-500 text-center">Create Account</h2>
            <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                <input type="text" name="name" placeholder="Name" class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="email" name="email" placeholder="Email" class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="text" name="id_number" placeholder="ID - number" class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="password" name="password" placeholder="Password" class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full p-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-full font-semibold shadow-lg hover:bg-orange-600 transition-all duration-300">Sign Up</button>
            </form>
        </div>
    </div>
</div>
@endsection
