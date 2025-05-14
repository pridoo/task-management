<div x-show="editOpen" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.outside="editOpen = false" class="w-full max-w-lg bg-white p-6 rounded-xl shadow-xl border border-gray-200">
        <form :action="`/admin/change-password/${selectedUser.id}`" method="POST" onsubmit="return validatePasswords();">

            @csrf
            @method('PUT')

            <h3 class="text-xl font-semibold mb-4">Change Password for <span x-text="selectedUser.name"></span></h3>

       
            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="new_password" id="new_password" 
                       class="w-full mt-2 p-3 border border-gray-300 rounded-md" 
                       required 
                       minlength="8" 
                       pattern=".*\d.*" 
                       title="Password must be at least 8 characters long and contain at least one number.">
            </div>


            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                       class="w-full mt-2 p-3 border border-gray-300 rounded-md" 
                       required 
                       minlength="8" 
                       pattern=".*\d.*" 
                       title="Password must be at least 8 characters long and contain at least one number.">
            </div>


            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Update Password</button>
            </div>



            
        </form>
    </div>
</div>
<script>
    function validatePasswords() {
        const password = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('new_password_confirmation').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return false;
        }

        return true;
    }

    function closeModal() {
        document.querySelector('.fixed.inset-0').style.display = 'none';
    }
</script>
