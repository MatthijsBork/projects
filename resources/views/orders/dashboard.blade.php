<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Bestellingen dashboard</h1>
        </div>
        @if (session('success'))
            <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="justify-between md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>
            <div class="w-full md:w-3/4">
                <div class="w-full">
                    <div class="p-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
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
                                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">
                                            {{ $order->shipping()->name }}</td>
                                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">€{{ $order->net_total }}</td>
                                        <td class="max-w-[22vw] px-4 py-3 overflow-hidden">{{ $order->created_at }}</td>
                                        <td class="flex justify-end py-3 text-right">
                                            <a title="Bewerken" href="{{ route('dashboard.orders.edit', [$order]) }}"
                                                class="text-blue-700 hover:underline">
                                                <x-edit-icon></x-edit-icon>
                                            </a>
                                            <a title="Verwijderen"
                                                href="{{ route('dashboard.orders.delete', [$order]) }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
