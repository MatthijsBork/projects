<x-app-layout>
    <div class="container py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-bold">Nieuw artikel</h1>
        </div>
        <div class="justify-between md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>
            {{-- textarea langer, datum onderaan --}}
            <div class="w-full md:w-3/4">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <x-article-form></x-article-form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
