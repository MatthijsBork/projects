<div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex justify-between items-center min-h-[10vh]">
        <h1 class="text-2xl font-semibold">{{ $title }}</h1>
        <a href="{{ $route . '/create' }}"
            class="p-4 font-bold text-white transition bg-blue-700 rounded hover:bg-blue-800">
            Nieuw
        </a>
    </div>
    @if (session('success'))
        <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="justify-between md:flex">
        <div class="w-full md:w-1/6 lg:w-1/5">
            <x-dashboard-menu></x-dashboard-menu>
        </div>
        <div class="w-full md:w-3/4">
            <div class="w-full">
                <div class="p-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
