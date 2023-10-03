<x-app-layout>
    <x-dashboard title="Eigenschappen dashboard" route="/dashboard/properties">
        <x-search action="{{ route('dashboard.properties.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Naam</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($properties as $property)
        <tr class="border-b even:bg-gray-50">
            <td class="px-4 py-2">{{ $property->name }}
            </td>
            </td>
            <td class="px-4 py-2">
                <a href="{{ route('dashboard.properties.edit', [$property->id]) }}"
                    class="text-blue-500 hover:underline">Bewerken</a>
            </td>
            <td class="px-4 py-2">
                <a href="{{ route('dashboard.properties.delete', [$property->id]) }}"
                    class="text-red-500 hover:underline">Verwijder</a>
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
