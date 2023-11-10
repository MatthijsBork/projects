<x-app-layout>
    <x-dashboard title="Producten Dashboard" route="/dashboard/products">
        <x-search action="{{ route('dashboard.products.search') }}"></x-search>
        @if (!isset($products[0]))
            <div class="w-full p-10 text-center bg-white rounded-lg">
                <h1 class="text-xl font-bold text-blue-500">Veel leegte...</h1>
                <p class="mb-4">Er zijn nog geen artikelen toegevoegd</p>
            </div>
        @else
            <table class="w-full text-left bg-white table-auto sm:rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3">Titel</th>
                        <th class="px-4 py-3">Prijs</th>
                        <th class="px-4 py-3">BTW</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b even:bg-gray-50">
                            <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $product->title }}</td>
                            <td class="max-w-[22vw] px-4 py-3 overflow-hidden">€{{ $product->price }}</td>
                            <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $product->vat }}%</td>
                            <td class="flex justify-end py-3 text-right">
                                <a title="Bewerken" href="{{ route('dashboard.products.edit', [$product]) }}"
                                    class="text-blue-700 hover:underline">
                                    <x-edit-icon></x-edit-icon>
                                </a>
                                <a title="Verwijderen" href="{{ route('dashboard.products.delete', [$product]) }}"
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
            {{ $products->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
