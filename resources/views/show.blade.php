<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="container py-8 mx-auto">
                <h1 class="text-4xl font-bold text-gray-800 truncate whitespace-normal">{{ $article->title }}</h1>
                <p class="text-gray-600">{{ $article->date }}</p>
                <div class="mt-4">
                    <p class="text-xl font-medium text-gray-900">
                        {{ $article->intro }}
                    </p>
                </div>
                <div class="mt-4">
                    <p class="text-gray-900">
                        {{ $article->content }}
                    </p>
                </div>
                <div class="mt-5">
                    <p class="text-sm text-gray-600">Klaar met lezen?</p>
                    <a href="{{ route('articles.index') }}" class="text-blue-500 hover:underline">Terug naar
                        Artikelen</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
