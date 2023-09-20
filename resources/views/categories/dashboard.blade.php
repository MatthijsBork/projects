<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Categorieën Dashboard</h1>
            <a href="{{ route('dashboard.categories.create') }}"
                class="p-4 font-bold text-white transition bg-blue-500 rounded hover:bg-blue-700">
                Nieuwe categorie
            </a>
        </div>
        @if (session('success'))
            <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
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
                <div class="w-full text-right">
                    <div class="p-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                        <x-search action="/categories/dashboard/search"></x-search>
                        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">Naam</th>
                                    <th class="px-4 py-2"></th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="border-b even:bg-gray-50">
                                        <td class="px-4 py-2">{{ $category->name }}
                                        </td>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('dashboard.categories.edit', [$category->id])}}"
                                                class="text-blue-500 hover:underline">Bewerken</a>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('dashboard.categories.delete', [$category->id])}}"
                                                class="text-red-500 hover:underline">Verwijder</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="my-4">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
