<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf

    <div class="tab-content">
        <div class="mb-4">
            <label for="title" class="block text-sm font-semibold text-gray-600" required>Titel</label>
            <input type="text" id="title" name="title" value="{{ $project->title ?? old('title') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('title')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <div id="intro-toolbar"></div>
            <label for="intro" class="block text-sm font-semibold text-gray-600">Introductie</label>
            <textarea id="intro" name="intro"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 min-h-[20vh]">{{ $project->intro ?? old('intro') }}</textarea>
            @error('intro')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-semibold text-gray-600">Startdatum</label>
            <input type="date" id="start_date" name="start_date"
                value="{{ isset($project) ? date('Y-m-d', strtotime($project->start_date)) : old('start_date') }}"
                class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('start_date')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @if (isset($project->image_name))
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">Huidige Afbeelding</label>
                <img src="{{ asset('images/projects/' . $project->id . '/' . $project->image_name) }}"
                    alt="Huidige Afbeelding" class="max-w-md p-1 border-gray-400 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="delete_image" class="block text-sm font-semibold text-gray-600">Verwijder Afbeelding</label>
                <input type="checkbox" id="delete_image" name="delete_image" value="1">
            </div>
        @endif
        <div class="mb-4">
            <label for="image" class="block text-sm font-semibold text-gray-600">Foto</label>
            <input type="file" id="image" name="image" value="1"
                class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('image')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="text-right">
        <button
            class="px-4 py-2 mt-3 text-red-700 bg-transparent border-red-500 rounded-lg hover:bg-red-500 hover:text-white hover:border-transparent">
            Annuleren
        </button>
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Opslaan</button>
    </div>
</form>
