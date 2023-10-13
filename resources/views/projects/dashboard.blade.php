<x-app-layout>
    <x-dashboard title="Projecten Dashboard" route="/dashboard/projects">
        <x-search action="{{ route('dashboard.projects.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3">Titel</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="items-center border-b even:bg-gray-50">
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $project->title }}</td>
                        <td class="flex justify-end py-3 text-right">
                            <a href="{{ route('dashboard.projects.tasks', [$project->id]) }}" title="Taken"
                                class="flex justify-end text-right text-blue-700 hover:underline">
                                <x-task-icon></x-task-icon>
                            </a>
                            <a href="{{ route('dashboard.projects.roles', [$project->id]) }}" title="Gebruikers"
                                class="flex justify-end text-right text-blue-700 hover:underline">
                                <x-user-icon></x-user-icon>
                            </a>
                            <a href="{{ route('dashboard.projects.edit', [$project]) }}" title="Bewerken"
                                class="text-blue-700 hover:underline">
                                <x-edit-icon></x-edit-icon>
                            </a>
                            <a href="{{ route('dashboard.projects.delete', [$project]) }}" title="Verwijderen"
                                class="text-red-500 hover:underline"
                                onclick="return confirm('Weet u zeker dat u dit wilt verwijderen?');">
                                <x-trash-icon></x-trash-icon>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{ $projects->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
