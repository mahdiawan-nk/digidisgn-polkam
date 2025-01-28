<x-filament-widgets::widget>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- User Avatar -->
        <div class="flex flex-col items-center">
            <img src="{{ $avatar }}" alt="User Avatar" class="h-24 w-24 rounded-full object-cover mb-4">
            <!-- User Info -->
            <h3 class="text-xl font-semibold text-gray-800">{{ $name }}</h3>
            <p class="text-sm text-gray-600">{{ $email }}</p>
            <p class="text-sm text-gray-600">{{ $position }}</p>
            <p class="text-sm text-gray-600">{{ $roles[0] }}</p>
        </div>
        <!-- Welcome Message and Date -->
        <div class="mt-6 text-center">
            <h1 class="text-xl font-semibold text-gray-800">Selamat Datang di Aplikasi DigSign</h1>
            <p class="text-sm text-gray-600">{{ now()->format('l, d F Y') }}</p>
        </div>
    </div>
</x-filament-widgets::widget>
