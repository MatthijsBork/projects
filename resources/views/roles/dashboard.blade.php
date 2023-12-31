<x-app-layout>
    <x-dashboard title="Rollen dashboard" route='/dashboard/roles'>
        @if ($roles[0] ?? true)
            <div class="w-full p-10 text-center bg-white rounded-lg">
                <h1 class="text-xl font-bold text-blue-500">Veel leegte...</h1>
                <p class="mb-4">Er zijn nog geen rollen toegevoegd</p>
            </div>
        @else
            <x-search action="{{ route('dashboard.roles.search') }}"></x-search>
            <table class="w-full text-left bg-white table-auto sm:rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3">Naam</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="border-b even:bg-gray-50">
                            <td class="px-4 py-3">{{ $role->name }}
                            </td>
                            <td class="flex justify-end py-3 text-right">
                                <a title="Bewerken" href="{{ route('dashboard.roles.edit', [$role]) }}"
                                    class="text-blue-700 hover:underline">
                                    <x-edit-icon></x-edit-icon>
                                </a>
                                <a title="Verwijderen" href="{{ route('dashboard.roles.delete', [$role]) }}"
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
        </div>
    </x-dashboard>
</x-app-layout>
