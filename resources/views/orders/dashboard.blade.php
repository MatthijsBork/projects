<x-app-layout>
    <x-dashboard title="Bestellingen Dashboard" route="/dashboard/orders">
        <x-search action="{{ route('dashboard.products.search') }}"></x-search>
        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Naam</th>
                    <th class="px-4 py-3">Nettoprijs</th>
                    <th class="px-4 py-3">Besteld op</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b even:bg-gray-50">
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $order->id }}</td>
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $order->shipping()->name }}</td>
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">€{{ $order->net_total }}</td>
                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $order->created_at }}</td>
                        <td class="flex justify-end py-3 text-right">
                            <a title="Bewerken" href="{{ route('dashboard.orders.edit', [$order]) }}"
                                class="text-blue-700 hover:underline">
                                <x-edit-icon></x-edit-icon>
                            </a>
                            <a title="Verwijderen" href="{{ route('dashboard.orders.delete', [$order]) }}"
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
            {{ $orders->links() }}
        </div>
    </x-dashboard>
</x-app-layout>
