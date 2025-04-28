<!-- Create Task Modal -->
<div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
    <div @click.outside="open = false" class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-lg border border-gray-200 transition-all duration-300">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Create New Task</h2>
            <button @click="open = false" class="text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.tasks.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Title</label>
                <input type="text" name="title" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Task title..." />
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                <textarea name="content" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Task details..."></textarea>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Start Date</label>
                    <input type="datetime-local" name="start_date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">End Date</label>
                    <input type="datetime-local" name="end_date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
            </div>

            <!-- Status -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="To do">To Do</option>
                        <option value="In-progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Assigned To</label>
                    <div class="relative">
                        <button type="button" id="createDropdownButton" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-left focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            Select Users
                        </button>
                        <div id="createDropdownMenu" class="absolute hidden w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto z-10">
                            <div class="px-4 py-2">
                                <label class="flex items-center">
                                    <input type="checkbox" id="createSelectAll" class="mr-2">
                                    Select All
                                </label>
                                <div class="space-y-2">
                                    @foreach ($users as $user)
                                        <label class="flex items-center justify-between">
                                            <span>{{ $user->name }}</span>
                                            <input type="checkbox" name="assigned_to[]" class="createUserCheckbox" value="{{ $user->id }}" id="user_{{ $user->id }}">
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Priority -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Priority</label>
                    <select name="priority" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="Low">Low Priority</option>
                        <option value="Medium" selected>Medium Priority</option>
                        <option value="High">High Priority</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Upload A Picture</label>
                    <input type="file" name="picture" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Attachment</label>
                    <input type="file" name="attachment" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition">
                    Save Task
                </button>
            </div>
        </form>
    </div>
</div>

<script>
  
    document.getElementById('createDropdownButton').addEventListener('click', function() {
        var dropdownMenu = document.getElementById('createDropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    });

  
    document.getElementById('createSelectAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.createUserCheckbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('createSelectAll').checked;
        });
    });


    document.querySelectorAll('.createUserCheckbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var allChecked = Array.from(document.querySelectorAll('.createUserCheckbox')).every(function(checkbox) {
                return checkbox.checked;
            });
            document.getElementById('createSelectAll').checked = allChecked;
        });
    });
</script>
