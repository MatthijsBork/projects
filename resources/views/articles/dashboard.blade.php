<x-app-layout>
    <x-dashboard title="Artikelen dashboard" route="/dashboard/articles">
        <x-search action="{{ route('dashboard.articles.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Datum</th>
                    <th class="px-4 py-2">Categorie</th>
                    <th class="px-4 py-2">Titel</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="border-b even:bg-gray-50">
                        <td class="px-4 py-2">
                            {{ date('j F Y', strtotime($article->publication_date)) }}
                        </td>
                        <td class="px-4 py-2">{{ $article->category->name }}
                        </td>
                        <td class="max-w-[22vw] px-4 py-2 overflow-hidden">{{ $article->title }}</td>
                        <td class="px-4 py-2">
                            <a href="articles/{{ $article->id }}/edit"
                                class="text-blue-500 hover:underline">Bewerken</a>
                        </td>
                        <td class="px-4 py-2">
                            <a href="articles/{{ $article->id }}/delete"
                                class="text-red-500 hover:underline">Verwijder</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{-- {{ $articles->links() }} --}}
        </div>
    </x-dashboard>
</x-app-layout>
