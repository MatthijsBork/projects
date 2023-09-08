<form method="POST" action="{{ route('articles.post') }}">
    @csrf
    <div class="flex-row">
    </div>
    <div class="mb-4">
        <label for="title" class="block text-sm font-semibold text-gray-600" required>Titel</label>
        <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
        @error('title')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="intro" class="block text-sm font-semibold text-gray-600">Introductie</label>
        <textarea id="intro" name="intro"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 min-h-[20vh]">{{ old('intro', $article->intro) }}</textarea>
        @error('intro')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="content" class="block text-sm font-semibold text-gray-600">Content</label>
        <textarea id="content" name="content"
            class="w-full px-3 py-2 border rounded-lg min-h-[25vh] focus:outline-none focus:ring focus:border-blue-300">{{ old('content', $article->content) }}</textarea>
        @error('content')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="publication_date" class="block text-sm font-semibold text-gray-600">Publiceerdatum</label>
        <input type="date" id="publication_date" name="publication_date" value="{{ old('publication_date', date('Y-m-d', strtotime($article->publication_date))) }}"
            class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
        @error('publication_date')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div class="text-right">
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Opslaan</button>
    </div>
</form>
