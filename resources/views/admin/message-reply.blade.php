@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/all-tasks.css') }}">

<style>
    .modal-enter { opacity: 0; transform: scale(0.95); }
    .modal-enter-active { opacity: 1; transform: scale(1); transition: all 0.3s ease-in-out; }
</style>

<div class="min-h-screen bg-gray-100">
    <main class="pt-24 px-6 ml-64">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Reply to Message</h2>
        </div>

        <div class="w-full bg-white border shadow-xl rounded-lg p-6">
            <!-- Back Button -->
            <div class="mb-6">
                <button onclick="showUnsavedModal('{{ route('admin.messages.index') }}')"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Inbox
                </button>
            </div>

            <!-- Reply Form -->
            <form id="replyForm" action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">To:</label>
                    <input type="text" name="to" value="{{ $message->email }}" readonly
                           class="w-full px-4 py-2 border border-gray-300 rounded bg-gray-100 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Your Reply:</label>
                    <textarea name="reply_body" id="replyBody" rows="8" required
                              class="w-full px-4 py-2 border border-gray-300 rounded text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Type your reply here..."></textarea>
                </div>

                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Send Reply
                </button>
            </form>
        </div>
    </main>

    <!-- Success/Error Modal -->
    @if(session('success') || session('error'))
    <div id="feedbackModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg text-center border
            {{ session('success') ? 'border-green-500' : 'border-red-500' }}">
            <h3 class="text-lg font-bold mb-4 text-center
                {{ session('success') ? 'text-green-600' : 'text-red-600' }}">
                {{ session('success') ? 'Success!' : 'Error!' }}
            </h3>
            <p class="text-gray-700 text-sm text-center mb-4">
                {{ session('success') ?? session('error') }}
            </p>
            <div class="flex justify-center">
                <button onclick="document.getElementById('feedbackModal').remove()"
                        class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900 transition">
                    Close
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        setTimeout(function () {
            window.location.href = "{{ route('admin.messages.index') }}";
        }, 2000);
    </script>
    @endif
    @endif

    <!-- Unsaved Changes Modal -->
    <div id="unsavedModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl text-center">
            <h2 class="text-xl font-semibold text-red-600 mb-2">Unsaved Changes</h2>
            <p class="text-gray-700 text-sm mb-6">You have unsaved changes. Are you sure you want to leave?</p>
            <div class="flex justify-center gap-4">
                <button id="confirmLeaveBtn"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Leave Anyway
                </button>
                <button onclick="closeUnsavedModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                    Stay Here
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let isDirty = false;
    let leaveUrl = null;

    document.getElementById('replyBody').addEventListener('input', () => {
        isDirty = true;
    });

    document.getElementById('replyForm').addEventListener('submit', () => {
        isDirty = false;
    });

    window.addEventListener('beforeunload', function (e) {
        if (isDirty) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    function showUnsavedModal(targetUrl) {
        if (isDirty) {
            leaveUrl = targetUrl;
            document.getElementById('unsavedModal').classList.remove('hidden');
            document.getElementById('unsavedModal').classList.add('flex');
        } else {
            window.location.href = targetUrl;
        }
    }

    function closeUnsavedModal() {
        document.getElementById('unsavedModal').classList.remove('flex');
        document.getElementById('unsavedModal').classList.add('hidden');
    }

    document.getElementById('confirmLeaveBtn')?.addEventListener('click', function () {
        if (leaveUrl) window.location.href = leaveUrl;
    });
</script>
@endsection
