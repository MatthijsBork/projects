<x-app-layout>
    <x-dashboard title="Statussen dashboard" route="/dashboard/states">
        @if ($states[0] ?? true)
            <div class="w-full p-10 text-center bg-white rounded-lg">
                <h1 class="text-xl font-bold text-blue-500">Veel leegte...</h1>
                <p class="mb-4">Er zijn nog geen statussen toegevoegd</p>
            </div>
        @else
            <table class="w-full text-left bg-white sm:rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Naam</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($states as $state)
                        <tr class="border-b even:bg-gray-50">
                            <td class="px-4 py-2">{{ $state->name }}
                            </td>
                            <td class="flex justify-end py-3 text-right">
                                <a title="Bewerken" href="{{ route('dashboard.states.edit', [$state]) }}"
                                    class="text-blue-700 hover:underline">
                                    <x-edit-icon></x-edit-icon>
                                </a>
                                <a title="Verwijderen" href="{{ route('dashboard.states.delete', [$state]) }}"
                                    class="text-red-500 hover:underline"
                                    onclick="return confirm('Weet u zeker dat u dit wilt verwijderen?');">
                                    <x-trash-icon></x-trash-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="my-4">
            {{ $states->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
