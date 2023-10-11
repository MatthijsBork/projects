<x-app-layout>
    <x-dashboard title="Projecten Dashboard" route="/dashboard/projects">
        <div class="p-6 text-gray-900">
            <div class="mb-4 border-b">
                <x-nav-link class="py-3" :href="route('dashboard.projects.user.show', [$project->id])" :active="request()->routeIs('dashboard.projects.user.show*')">
                    Project
                </x-nav-link>
                <x-nav-link class="py-3" :href="route('dashboard.projects.user.show.tasks', [$project->id])" :active="request()->routeIs('dashboard.projects.user.show*')">
                    Mijn taken
                </x-nav-link>
            </div>
            <h2 class="text-xl text-bold">{{ $project->title }}</h2>
            <p><b>Startdatum:</b> {{ $project->start_date }}</p>
            <span>{!! $project->description !!} </span>
            {{-- <x-project-form :project="$project" action="{{ route('dashboard.projects.store') }}"></x-project-form> --}}
            @if (isset($project->image_name) && $project->image_name !== '')
                <div class="mb-4">
                    <x-input-label for="current_image">Huidige Afbeelding</x-input-label>
                    <img id="current_image"
                        src="{{ asset('images/projects/' . $project->id . '/' . $project->image_name) }}"
                        alt="Huidige Afbeelding" class="max-w-md p-1 border-gray-400 rounded-lg">
                </div>
            @endif
        </div>
    </x-dashboard>
</x-app-layout>
