<x-app-layout>
    <x-dashboard title="Producten Dashboard" route="/dashboard/products">
        <x-search action="{{ route('dashboard.products.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Titel</th>
                    <th class="px-4 py-2">Nettoprijs</th>
                    <th class="px-4 py-2">BTW</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-b even:bg-gray-50">
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $product->title }}</td>
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">€{{ $product->price }}</td>
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $product->vat }}%</td>
                        <td class="py-2 text-right max-w-[3vh] overflow-hidden">
                            <a href="{{ route('dashboard.products.edit', [$product->id]) }}"
                                class="text-blue-500 hover:underline">Bewerk</a>
                        </td>
                        <td class="py-2 text-right max-w-[3vh] overflow-hidden">
                            <a href="{{ route('dashboard.products.delete', [$product->id]) }}"
                                class="text-red-500 hover:underline">Verwijder</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{ $products->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
