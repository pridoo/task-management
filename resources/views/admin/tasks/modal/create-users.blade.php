<div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
    <div
         @click.outside="open = false"
        class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-lg border border-gray-200 transition-all duration-300">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Add New User</h2>
            <button @click="open = false" class="text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</button>
        </div>

        <form class="space-y-4">
            <div class="mb-4">
                <label for="full-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="full-name" name="full-name" 
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" 
                       placeholder="Enter full name" 
                       x-model="currentUser.name" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" 
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" 
                       placeholder="Enter email address" 
                       x-model="currentUser.email" required>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" 
                        x-model="currentUser.role" required>
                    <option value="admin">Admin</option>
                    <option value="user">Developer</option>
                </select>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition">
                        Save Task
                </button>
            </div>
        </form>
    </div>
</div>
