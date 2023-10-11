<x-app-layout>
    <x-dashboard title="Mijn projecten" route="/dashboard/projects/user">
        {{-- <x-search action="{{ route('dashboard.projects.user.search') }}"></x-search> --}}
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3">Titel</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="border-b even:bg-gray-50">
                        <td class="w-full px-4 py-3 overflow-hidden hover:bg-gray-200">
                            <a href="{{ route('dashboard.projects.user.show', $project) }}">
                                {{ $project->title }}
                            </a>
                        </td>
                        {{-- <td class="flex justify-end py-3 text-right">
                            <a title="Taken" href="{{ route('dashboard.projects.tasks', [$project->id]) }}"
                                class="flex justify-end text-right text-blue-700 hover:underline">
                                <x-task-icon></x-task-icon>
                            </a>
                            <a title="Gebruikers" href="{{ route('dashboard.projects.roles', [$project->id]) }}"
                                class="flex justify-end text-right text-blue-700 hover:underline">
                                <x-user-icon></x-user-icon>
                            </a>
                            <a title="Bewerken" href="{{ route('dashboard.projects.edit', [$project->id]) }}"
                                class="text-blue-700 hover:underline">
                                <x-edit-icon></x-edit-icon>
                            </a>
                            <a title="Verwijderen" href="{{ route('dashboard.projects.delete', [$project->id]) }}"
                                class="text-red-500 hover:underline"
                                onclick="return confirm('Weet u zeker dat u dit wilt verwijderen?');">
                                <x-trash-icon></x-trash-icon>
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{ $projects->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
