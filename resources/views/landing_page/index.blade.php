@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2">
            <h1 class="text-4xl font-bold mb-4 leading-tight">One tool for smooth task management flow</h1>
            <p class="text-gray-600 mb-6">Tekflow simplifies task management for teams and professionals.</p>
            <a href="{{ route('register') }}" class="border border-orange-500 text-orange-500 px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-orange-500 hover:text-white">Get Started</a>
        </div>

        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('css/pictures/page1.png') }}" alt="Task Management UI" class="w-[140%] md:w-[180%] max-w-[900px] ">
        </div>
    </div>
</div>

<div class="bg-gray-300 py-12 w-full">
    <div class="px-6 max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8">Centralized, straightforward task management software for teams</h2>
        <div class="overflow-x-auto scrollbar-hidden flex space-x-6 py-4 scrolling-touch">
            <div class="flex-none w-[300px] md:w-[500px] bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ asset('css/pictures/page2.png') }}" alt="Task Management UI" class="w-full h-[350px] object-cover rounded-lg">
            </div>
            <div class="flex-none w-[300px] md:w-[500px] bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ asset('css/pictures/page2.png') }}" alt="Task Management UI" class="w-full h-[350px] object-cover rounded-lg">
            </div>
            <div class="flex-none w-[300px] md:w-[500px] bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ asset('css/pictures/page2.png') }}" alt="Task Management UI" class="w-full h-[350px] object-cover rounded-lg">
            </div>
        </div>
    </div>
</div>


<div class="bg-gray-50 py-16 w-full">
    <div class="px-6 max-w-6xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-10 text-gray-900">🚀 A Tool That’s Easy to Onboard, Adopt, and Love</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="p-8 bg-white border-2 border-orange-500 rounded-2xl shadow-lg text-orange-500 hover:bg-orange-500 hover:text-white hover:border-white transition-all">
                <i class="bi bi-card-list text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold">Easily visualize and organize tasks.</h3>
            </div>

            <div class="p-8 bg-white border-2 border-orange-500 rounded-2xl shadow-lg text-orange-500 hover:bg-orange-500 hover:text-white hover:border-white transition-all">
                <i class="bi bi-flag text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold">Assign priority levels to tasks for better workflow efficiency.</h3>
            </div>

            <div class="p-8 bg-white border-2 border-orange-500 rounded-2xl shadow-lg text-orange-500 hover:bg-orange-500 hover:text-white hover:border-white transition-all">
                <i class="bi bi-person-fill text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold">Assign tasks to specific team members and set clear responsibilities.</h3>
            </div>

            <div class="p-8 bg-white border-2 border-orange-500 rounded-2xl shadow-lg text-orange-500 hover:bg-orange-500 hover:text-white hover:border-white transition-all">
                <i class="bi bi-chat-left-text text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold">Collaborate directly within tasks by adding feedback.</h3>
            </div>

            <div class="p-8 bg-white border-2 border-orange-500 rounded-2xl shadow-lg text-orange-500 hover:bg-orange-500 hover:text-white hover:border-white transition-all">
                <i class="bi bi-tag text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold">Tag teammates and get instant updates to stay in sync.</h3>
            </div>
 
            <div class="p-8 bg-white border-2 border-orange-500 rounded-2xl shadow-lg text-orange-500 hover:bg-orange-500 hover:text-white hover:border-white transition-all">
                <i class="bi bi-clock text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold">Track time spent on tasks and improve productivity.</h3>
            </div>
        </div>
    </div>
</div>


<div class="bg-orange-500 text-white py-20 w-full">
    <div class="px-6 max-w-6xl mx-auto flex items-center justify-between">

        <div class="w-1/2 text-left">
            <h2 class="text-4xl font-bold mb-8">Enterprise-Grade Security 🔒</h2>

            <div class="flex flex-col space-y-6">
                <div class="flex items-center space-x-3 bg-white/10 px-6 py-4 rounded-lg shadow-md">
                    <i class="bi bi-lock text-3xl"></i> 
                    <span class="text-lg">Role-Based Access Control</span>
                </div>
                <div class="flex items-center space-x-3 bg-white/10 px-6 py-4 rounded-lg shadow-md">
                    <i class="bi bi-shield-lock text-3xl"></i> 
                    <span class="text-lg">Secure Transactions</span>
                </div>
            </div>
        </div>


        <div class="w-1/2 ml-80">
            <img src="{{ asset('css/pictures/security2.png') }}" alt="Security Illustration" class="mx-auto w-70">
        </div>
    </div>
</div>


<div class="container mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2">
            <h1 class="text-5xl font-extrabold mb-6 leading-tight">Do you have a question?</h1>
            <p class="text-gray-700 text-lg mb-6">Feel free to reach out to our team.</p>
        </div>

        <div class="md:w-1/2 flex justify-center">
            <div class="bg-white p-16 rounded-2xl shadow-lg w-full max-w-xl border-4 border-orange-500">
                <form action="#" method="POST">
                    <div class="mb-6">
                        <input type="text" name="name" placeholder="Name" class="w-full px-6 py-4 border rounded-xl bg-gray-100 text-xl font-semibold focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div class="mb-6">
                        <input type="email" name="email" placeholder="Email" class="w-full px-6 py-4 border rounded-xl bg-gray-100 text-xl font-semibold focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div class="mb-6">
                        <textarea name="message" placeholder="How can our team help you?" class="w-full px-6 py-4 border rounded-xl bg-gray-100 text-xl font-semibold focus:outline-none focus:border-orange-500" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-orange-500 text-white px-6 py-3 rounded-xl font-bold text-lg transition-all duration-300 hover:bg-orange-600 shadow-md">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
