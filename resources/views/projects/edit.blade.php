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
                            <ul class="flex space-x-4">
                                <li class="mb-2">
                                    <a href=""
                                        class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">
                                        Project</a>
                                </li>
                                <li class="mb-2">
                                    <a href=""
                                        class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">
                                        Users</a>
                                </li>
                                <li class="mb-2">
                                    <a href=""
                                        class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <x-project-form action="{{ route('dashboard.projects.update', [$project->id]) }}"
                            :project="$project"></x-project-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        // window.addEventListener('load', () => {
        //     for (const name of ['content']) {
        //         ClassicEditor.create(document.getElementById(name))
        //             .catch(error => {
        //                 console.error(error);
        //             });
        //     }
        // });
    </script>
</x-app-layout>
