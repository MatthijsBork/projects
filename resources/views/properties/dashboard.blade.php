<x-app-layout>
    <x-dashboard title="Eigenschappen dashboard" route="/dashboard/properties">
        <x-search action="{{ route('dashboard.properties.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3">Naam</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                    <tr class="border-b even:bg-gray-50">
                        <td class="px-4 py-3">{{ $property->name }}</td>

                        <td class="flex justify-end py-3 text-right">
                            <a href="{{ route('dashboard.properties.edit', [$property]) }}"
                                class="text-blue-700 hover:underline">
                                <x-edit-icon></x-edit-icon>
                            </a>
                            <a href="{{ route('dashboard.properties.delete', [$property]) }}"
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
            {{ $properties->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
