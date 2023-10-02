<x-app-layout>
    <x-dashboard title="Taken Dashboard" route="/dashboard/projects/{{ $projectid }}/edit/tasks">
        <x-project-tab-menu :projectid="$projectid"></x-project-tab-menu>

        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Titel</th>
                    <th class="px-4 py-2">Deadline</th>
                    <th class="px-4 py-2">Staat</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="border-b even:bg-gray-50">
                        <td class="max-w-[22vw] px-4 py-2 overflow-hidden">{{ $task->title }}</td>
                        <td class="max-w-[22vw] px-4 py-2 overflow-hidden">{{ date('j F Y', strtotime($task->deadline)) }}</td>
                        <td class="max-w-[22vw] px-4 py-2 overflow-hidden">{{ $task->state == 1 ? 'Klaar' : 'Bezig' }}</td>
                        <td class="px-4 py-2">
                            <a href="tasks/{{ $task->id }}/edit" class="text-blue-500 hover:underline">Bewerken</a>
                        </td>
                        <td class="px-4 py-2">
                            <a href="tasks/{{ $task->id }}/delete" class="text-red-500 hover:underline">Verwijder</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{ $tasks->links() }}
        </div>
    </x-dashboard>
</x-app-layout>