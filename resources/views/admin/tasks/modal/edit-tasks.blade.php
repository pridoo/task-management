<!-- Edit Task Modal -->
<div x-show="editOpen" x-cloak x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50"
     x-data="{ currentTask: null, baseUrl: '{{ url('admin/tasks') }}' }"
     @open-edit-modal.window="currentTask = $event.detail.task; editOpen = true">
    
    <div @click.outside="editOpen = false" class="w-full max-w-lg bg-white p-6 rounded-xl shadow-xl border border-gray-200">

    
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Edit Task</h2>
            <button @click="editOpen = false" class="text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</button>
        </div>

     
        <form method="POST" 
              :action="baseUrl + '/' + (currentTask ? currentTask.id : '') + '/update'" 
              enctype="multipart/form-data" 
              class="space-y-4">
            @csrf
            @method('PUT') 

            
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Title</label>
                <input type="text" name="title" x-model="currentTask.title" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                    placeholder="Task Title" required>
            </div>

   
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                <textarea name="content" x-model="currentTask.content" rows="3" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                        placeholder="Task description..." required></textarea>
            </div>

 
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Start Date</label>
                    <input type="datetime-local" name="start_date" x-model="currentTask.start_date" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">End Date</label>
                    <input type="datetime-local" name="end_date" x-model="currentTask.end_date" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                        required>
                </div>
            </div>

      
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <select name="status" x-model="currentTask.status" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                        <option value="To do" :selected="currentTask.status === 'To do'">To do</option>
                        <option value="In-progress" :selected="currentTask.status === 'In-progress'">In Progress</option>
                        <option value="Completed" :selected="currentTask.status === 'Completed'">Completed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Assigned To</label>
                    <select name="assigned_to" x-model="currentTask.assigned_to" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        @foreach ($users as $user)
                            <option :value="{{ $user->id }}" :selected="currentTask.assigned_to == {{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Priority</label>
                    <select name="priority" x-model="currentTask.priority" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                        <option value="Low" :selected="currentTask.priority === 'Low'">Low</option>
                        <option value="Medium" :selected="currentTask.priority === 'Medium'">Medium</option>
                        <option value="High" :selected="currentTask.priority === 'High'">High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Replace Attachment</label>
                    <input type="file" name="attachment" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
            </div>


            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition">
                    Update Task
                </button>
            </div>
        </form>

    </div>
</div>