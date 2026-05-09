<div
    x-data="{ show: false, message: '' }"
    x-on:show-toast.window="
        message = $event.detail.message;
        show = true;
        setTimeout(() => show = false, 3000)
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-5 right-5 z-50 pointer-events-none"
    style="display: none;"
>
    <div class="bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3">
        <x-icons.save size="size-5" />
        <span class="font-semibold text-sm" x-text="message"></span>
    </div>
</div>