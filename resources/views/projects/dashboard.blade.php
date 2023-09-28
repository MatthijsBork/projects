<x-app-layout>
    <x-dashboard title="Projecten Dashboard" route="/dashboard/projects">
        <x-search action="{{ route('dashboard.projects.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Titel</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="border-b even:bg-gray-50">
                        <td class="max-w-[22vw] px-4 py-2 overflow-hidden">{{ $project->title }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('dashboard.projects.edit', [$project->id]) }}"
                                class="text-blue-500 hover:underline">Bewerken</a>
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('dashboard.projects.delete', [$project->id]) }}"
                                class="text-red-500 hover:underline">Verwijder</a>
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
