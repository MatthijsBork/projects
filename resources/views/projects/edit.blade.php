<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-bold">Project bewerken</h1>
        </div>
        <div class="justify-between md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>

            <div class="w-full md:w-3/4">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <ul
                                class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                                <li class="mr-2">
                                    <a href="{{ route('dashboard.projects.edit', [$project->id]) }}"
                                        class="inline-block p-4 text-blue-500 rounded-t-lg bg-gray-50 hover:bg-gray-100">
                                        Project</a>
                                </li>
                                <li class="mr-2">
                                    <a href="{{ route('dashboard.projects.roles', [$project->id]) }}"
                                        class="inline-block p-4 rounded-t-lg bg-gray-50 hover:bg-gray-100">
                                        Gebruikers</a>
                                </li>
                            </ul>
                        </div>
                        <x-project-form :users="$users" :project="$project" :roles="$roles" :userroles="$userroles"
                            action="{{ route('dashboard.projects.update', [$project->id]) }}"></x-project-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

