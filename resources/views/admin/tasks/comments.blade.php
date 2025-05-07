<section class="mx-auto max-w-[90%] md:max-w-[1050px] mt-10 p-6 bg-white border border-[#4444] rounded-lg">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-4">Comments</h2>

        <div class="max-h-96 overflow-y-auto p-4 bg-gray-100 rounded-lg border">
            <div class="space-y-4">
                @foreach ($task->comments as $comment)
                    <div class="bg-white p-4 rounded-lg shadow border-2">
                        <div class="flex items-center mb-2">
                            <div>
                                @if($comment->admin)
                        
                                    <h3 class="font-semibold">{{ $comment->admin->name }}</h3>
                                @else
                                    <h3 class="font-semibold">{{ $comment->user->name }}</h3>
                                @endif
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($comment->created_at)->setTimezone('Asia/Manila')->format('l, F j, Y h:i A') }}</p>

                            </div>
                        </div>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add Comment Form -->
        <form class="mt-8 bg-white p-4 rounded-lg shadow border-2" method="POST" action="{{ route('admin.tasks.comments.store', $task->id) }}">
            @csrf
            <div class="mb-4">
                <label for="comment" class="block text-gray-700 font-medium mb-2">Comment</label>
                <textarea id="comment" name="comment" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Post Comment
            </button>
        </form>
    </div>
</section>
