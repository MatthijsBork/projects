<x-app-layout>
    <div class="container py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Artikelen Dashboard</h1>
            <a href="/articles/create" class="p-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Nieuw artikel
            </a>
        </div>
        @if (session('success'))
            <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
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
                        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
                            <thead>
                                <tr>
                                    <th class="">Datum</th>
                                    <th class="">Titel</th>
                                    <th class=""></th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td class="px-4 py-2">{{ date('j F Y', strtotime($article->publication_date)) }}
                                        </td>
                                        <td class="max-w-[22vw] px-4 py-2 overflow-hidden">{{ $article->title }}</td>
                                        <td class="px-4 py-2">
                                            <a href="/articles/edit/{{ $article->id }}"
                                                class="text-blue-500 hover:underline">Bewerken</a>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="/articles/delete/{{ $article->id }}"
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
