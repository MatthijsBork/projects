<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-bold">Categorie bewerken</h1>
        </div>
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
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('dashboard.categories.update', [$category]) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-semibold text-gray-600">Naam</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                                    value="{{ $category->name }}" name="name">
                            </div>
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <div class="text-right">
                                <button type="button" onclick="history.back()"
                                    class="px-4 py-2 mt-3 text-red-700 bg-transparent rounded-lg hover:bg-red-500 hover:text-white hover:border-transparent">
                                    Annuleren
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Opslaan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
