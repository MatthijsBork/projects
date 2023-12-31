<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Taak</h1>
        </div>
        @if (session('success'))
            <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="justify-between md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-site-menu></x-site-menu>
            </div>
            <div class="w-full md:w-3/4">
                <div class="w-full">
                    <div class="p-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                        <div class="text-gray-900 ">
                            <div class="mb-4 border-b">
                                <x-nav-link class="py-3" :href="route('user.projects.show', [$task->project->id])" :active="request()->routeIs('user.projects.show')">
                                    Project
                                </x-nav-link>
                                <x-nav-link class="py-3" :href="route('user.projects.tasks', [$task->project->id])" :active="request()->routeIs('user.projects.tasks*')">
                                    Mijn taken
                                </x-nav-link>
                            </div>
                            <div class="mb-4 border-b">
                                <div>
                                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                                        <div class="container py-8 mx-auto">
                                            <h1 class="text-4xl font-bold text-gray-800 truncate whitespace-normal">
                                                {{ $task->title }}
                                            </h1>
                                            <p class="text-gray-600">Deadline: {!! $task->deadline !!}</p>
                                            <div class="mt-4">
                                                <p class="text-xl font-medium text-gray-900">
                                                    {!! $task->description !!}
                                                </p>
                                            </div>
                                            <div class="mt-5">
                                                <a href="{{ route('user.projects.tasks', $task->project) }}"
                                                    class="text-blue-500 hover:underline">Terug naar
                                                    taken</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
