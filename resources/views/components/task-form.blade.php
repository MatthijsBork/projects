<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf

    <div class="tab-content">
        <div class="mb-4">
            <x-input-label for="title">Titel</x-input-label>
            <input type="text" id="title" name="title" value="{{ $task->title ?? old('title') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('title')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="description">Beschrijving</x-input-label>
            <textarea id="description" name="description"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 min-h-[20vh]">{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="deadline">Deadline</x-input-label>
            <input type="date" id="deadline" name="deadline"
                value="{{ isset($task->deadline) ? date('Y-m-d', strtotime($task->deadline)) : old('deadline') }}"
                class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('deadline')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="state">Status</x-input-label>
            <input type='hidden' value='0' name='state'>
            <input type="checkbox" name="state" value="1"
                {{ isset($task) && $task->state == '1' ? 'checked' : '' }}>
            @error('state')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="users">Gebruikers toevoegen</x-input-label>
            @foreach ($task::getAllUsers() as $user)
                <input id="users" type="checkbox" name="selected_users[]" value="{{ $user->id }}"
                    {{ isset($task) && $task->users->contains($user->id) ? 'checked' : '' }}>
                {{ $user->name }}
            @endforeach
        </div>
    </div>

    <div class="text-right">
        <x-cancel-button>Annuleren</x-cancel-button>
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
