<x-app-layout>
    <div class="container py-8 mx-auto">
        <h1 class="mb-5 text-2xl font-bold">Artikel bewerken</h1>
        <div class="justify-between mt-3 md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>
            <div class="w-full md:w-3/4">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('articles.update', ['id' => $article->id]) }}">
                            @csrf
                            <div class="flex-row">
                                <div class="mb-4">
                                    <label for="publication_date"
                                        class="block text-sm font-semibold text-gray-600">Publiceerdatum</label>
                                    <input type="date" id="publication_date" name="publication_date"
                                        class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400"
                                        value="{{ date('Y-m-d', strtotime($article->publication_date)) }}" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-semibold text-gray-600"
                                    required>Titel</label>
                                <input type="text" id="title" name="title" value="{{ $article->title }}"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <div class="mb-4">
                                <label for="intro"
                                    class="block text-sm font-semibold text-gray-600">Introductie</label>
                                <textarea id="intro" name="intro"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>{{ $article->intro }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="content" class="block text-sm font-semibold text-gray-600">Content</label>
                                <textarea id="content" name="content"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>{{ $article->content }}</textarea>
                            </div>
                            <div class="text-right">
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
