<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="min-h-[10vh] items-center">
                <h1 class="mb-5 text-2xl font-bold">Het laatste nieuws</h1>
            </div>
            <div class="flex flex-wrap -mx-4">
                @foreach ($articles as $article)
                    <div class="w-full px-4 mb-4 md:w-1/2">
                        <div class="p-4 bg-white rounded-lg shadow-md">
                            <h2 class="mb-2 text-2xl font-semibold text-gray-800 truncate whitespace-normal">
                                {!! $article->title !!}</h2>
                            <p class="mb-2 text-gray-600">{!! $article->intro !!}</p>
                            <p class="text-gray-400">
                                {{ \Carbon\Carbon::parse($article->publication_date)->format('j F Y') }}</p>
                            <a href="{{ route('articles.show', [$article->id]) }}"
                                class="block mt-2 text-blue-500 hover:underline">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
