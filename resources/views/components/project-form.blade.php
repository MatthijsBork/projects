<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf

    <div class="tab-content">
        <div class="mb-4">
            <x-input-label for="title">Titel</x-input-label>
            <input type="text" id="title" name="title" value="{{ $project->title ?? old('title') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('title')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="description">Beschrijving</x-input-label>
            <textarea id="description" name="description"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">{{ $project->description ?? old('description') }}</textarea>
            @error('description')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="start_date">Startdatum</x-input-label>
            <input type="date" id="start_date" name="start_date"
                value="{{ isset($project->start_date) ? date('Y-m-d', strtotime($project->start_date)) : old('start_date') }}"
                class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('start_date')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @if (isset($project->image_name) && $project->image_name !== '')
            <div class="mb-4">
                <x-input-label for="current_image">Huidige Afbeelding</x-input-label>
                <img id="current_image"
                    src="{{ asset('images/projects/' . $project->id . '/' . $project->image_name) }}"
                    alt="Huidige Afbeelding" class="max-w-md p-1 border-gray-400 rounded-lg">
            </div>
            <div class="mb-4">
                <x-input-label for="delete_image">Verwijder Afbeelding</x-input-label>
                <input type="checkbox" id="delete_image" name="delete_image" value="1">
            </div>
        @endif
        <div class="mb-4">
            <x-input-label for="image">Foto</x-input-label>
            <input type="file" id="image" name="image" value="1"
                class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('image')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="text-right">
        <a class="text-red-500" href="{{ route('dashboard.projects') }}">Annuleren</a>
        <x-submit-button>Opslaan</x-submit-button>
    </div>
</form>
<script defer>
    window.addEventListener('load', () => {
        for (const name of ['description']) {
            ClassicEditor.create(document.getElementById(name), {})
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
