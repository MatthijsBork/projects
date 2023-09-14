<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Categorieën Dashboard</h1>
            <a href="/categories/create"
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
                        <form class="text-right" method="GET" action="/categories/dashboard/search">
                            <div class="relative">
                                <input type="search" name="query" value="{{ request('query') }}"
                                    class="block p-2.5 w-full z-20 text-sm border-gray-200 text-gray-900 bg-gray-50 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Zoeken">
                                <button type="submit"
                                    class="absolute top-0 right-0 h-full p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </form>
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
                                            <a href="/categories/edit/{{ $category->id }}"
                                                class="text-blue-500 hover:underline">Bewerken</a>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="/categories/delete/{{ $category->id }}"
                                                class="text-red-500 hover:underline">Verwijder</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
