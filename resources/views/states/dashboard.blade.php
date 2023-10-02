<x-app-layout>
    <x-dashboard title="Statussen dashboard" route="/dashboard/states">
        <table class="w-full text-left bg-white sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Naam</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($states as $state)
                    <tr class="border-b even:bg-gray-50">
                        <td class="px-4 py-2">{{ $state->name }}
                        </td>
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('dashboard.states.edit', [$state->id]) }}"
                                class="text-blue-500 hover:underline">Bewerken</a>
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('dashboard.states.delete', [$state->id]) }}"
                                class="text-red-500 hover:underline">Verwijder</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{ $states->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
