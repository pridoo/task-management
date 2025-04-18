<div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
    <div
         @click.outside="open = false"
        class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-lg border border-gray-200 transition-all duration-300">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Create New Task</h2>
            <button @click="open = false" class="text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</button>
        </div>

        <form class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Title</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Task title..." />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Task details..."></textarea>
            </div>


            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Start Date</label>
                    <input type="date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">End Date</label>
                    <input type="date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="in-progress">To Do</option>
                        <option value="pending">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Assigned To</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                         <option value="juan">Juan Dela Cruz</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Priority</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option>Low Priority</option>
                        <option selected>Medium Priority</option>
                        <option>High Priority</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Upload A Picture</label>
                    <input type="file" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Attachment</label>
                    <input type="file" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition">
                        Save Task
                </button>
            </div>
        </form>
    </div>
</div>
