<x-app-layout>
    <x-dashboard title="Categorieën dashboard" route="/dashboard/categories">
        <x-search action="{{ route('dashboard.categories.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Naam</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($categories as $category)
        <tr class="border-b even:bg-gray-50">
            <td class="px-4 py-2">{{ $category->name }}
            </td>
            </td>
            <td class="px-4 py-2">
                <a href="{{ route('dashboard.categories.edit', [$category->id]) }}"
                    class="text-blue-500 hover:underline">Bewerken</a>
            </td>
            <td class="px-4 py-2">
                <a href="{{ route('dashboard.categories.delete', [$category->id]) }}"
                    class="text-red-500 hover:underline">Verwijder</a>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        <div class="my-4">
            {{ $categories->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
