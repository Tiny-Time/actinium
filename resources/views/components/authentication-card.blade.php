<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full max-w-sm px-6 py-4 mt-2">
        <h3 class="text-2xl font-bold text-center">{{ $title }}</h3>
        {{ $slot }}
    </div>
</div>
