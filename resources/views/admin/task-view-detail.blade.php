   <!-- Adapted Responsive Container -->
   <div class="mx-auto max-w-[90%] md:max-w-[1050px] p-6 bg-white border border-[#4444] rounded-lg">

<div class="text-[#444] text-base font-bold mb-4 flex items-center gap-2">
    <a href="#" class="hover:text-blue-600">
        <i class="bi bi-arrow-left w-4 h-4 text-[#444]"></i>
    </a>
</div>

<!-- Title -->
<div class="text-[#444] text-base font-bold flex items-center gap-2">
    <span class="mt-2">Task Title Example</span>
</div>

<!-- Divider -->
<div class="border-t border-gray-200 my-4"></div>

<div class="flex justify-between items-center">
    <!-- Status -->
    <button class="mb-4 px-6 py-2 text-white text-xs rounded-lg bg-yellow-400">
        In-progress
    </button>

    <!-- Priority -->
    <span class="text-[11px] flex items-center gap-1 text-yellow-500">
        🟡
        <span>Medium Priority</span>
    </span>
</div>

<!-- Start and End Dates -->
<div class="flex flex-wrap items-center gap-x-8 text-sm text-[#444] mb-4">
    <div class="flex gap-1 font-semibold">
        <span>Start Date:</span>
        <span class="font-light">Monday, April 28, 2025 09:00 AM</span>
    </div>
    <div class="flex gap-1 font-semibold">
        <span>End Date:</span>
        <span class="font-light">Friday, May 2, 2025 05:00 PM</span>
    </div>
</div>

<!-- Content -->
<div class="bg-[#6C757D23] rounded-lg p-4 mb-6">
    <div class="text-sm text-[#444] font-light">
        This is the task description. You can include any relevant information here.
    </div>
</div>

<!-- Divider -->
<div class="border-t border-gray-200 my-4"></div>

<!-- Attachments -->
<div class="mb-2 text-[#444] font-bold text-base">Attachments</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 mb-6">
    <a href="#" target="_blank"
        class="flex items-center justify-between border border-gray-300 rounded-lg p-3 shadow-sm hover:bg-gray-50 transition">
        <div class="flex items-center space-x-3">
            <div>
                <p class="font-semibold text-sm text-gray-800 truncate max-w-[180px]">document.pdf</p>
                <p class="text-xs text-gray-500">1.2 MB</p>
            </div>
        </div>
    </a>

</div>

<!-- Divider -->
<div class="border-t border-gray-200 my-4"></div>

<!-- Assignees -->
<div class="mt-6">
    <span class="text-[#444] text-[12px] font-semibold">
        Assigned to:
    </span>

    <div class="mt-2 flex flex-col space-y-2">
        <div class="flex items-center space-x-2">
            <div
                class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-xs text-gray-700">
                JD
            </div>
            <span class="text-xs text-gray-700">John Doe</span>
        </div>
        <div class="flex items-center space-x-2">
            <div
                class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-xs text-gray-700">
                AB
            </div>
            <span class="text-xs text-gray-700">Alice Brown</span>
        </div>
    </div>
</div>
</div>