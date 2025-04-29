<div x-show="open" x-transition
    class="absolute top-10 right-4 w-[143px] bg-white border border-[#44444466] rounded-[10px] shadow-lg p-2 z-50"
    @click.stop>

    <div class="flex flex-col gap-2 text-[#444] text-[12px] font-medium leading-[15px]">
        <!-- Mark as Read -->
        <div class="flex items-center gap-2 cursor-pointer hover:bg-gray-100 p-1 rounded">
            <i class="bi bi-check w-4 h-4 text-[#444]"></i>
            <span>Mark as read</span>
        </div>

        <!-- Open -->
        <div class="flex items-center gap-2 cursor-pointer hover:bg-gray-100 p-1 rounded">
            <i class="bi bi-copy w-4 h-4 text-[#444]"></i>
            <span>Open</span>
        </div>

        <!-- Delete -->
        <div class="flex items-center gap-2 cursor-pointer hover:bg-gray-100 p-1 rounded">
            <i class="bi bi-trash w-4 h-4 text-[#444]"></i>
            <span>Delete</span>
        </div>
    </div>
</div>