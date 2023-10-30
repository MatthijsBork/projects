<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Bestelde producten</h1>
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
                <x-site-menu></x-site-menu>
            </div>
            <div class="w-full md:w-3/4">
                <div class="w-full">
                    <div class="p-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                        <div class="text-gray-900 ">
                            <div class="mb-4 border-b">
                                <x-nav-link class="py-3" :href="route('user.orders.show', [$order])" :active="request()->routeIs('user.orders.show')">
                                    Bestelling
                                </x-nav-link>
                                <x-nav-link class="py-3" :href="route('user.orders.show.products', [$order])" :active="request()->routeIs('user.orders.show.products*')">
                                    Producten
                                </x-nav-link>
                            </div>
                            <div class="mb-4 border-b">
                                <table class="w-full text-left bg-white table-auto sm:rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3">Naam</th>
                                            <th class="px-4 py-3">Nettoprijs</th>
                                            <th class="px-4 py-3">Aantal</th>
                                            <th class="px-4 py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                            <tr class="border-b even:bg-gray-50">
                                                <td class="max-w-[22vw] px-4 py-3 overflow-hidden">
                                                    {{ $product->product->title }}
                                                </td>
                                                <td class="max-w-[22vw] px-4 py-3 overflow-hidden">
                                                    €{{ $order->net_total }}</td>
                                                <td class="max-w-[22vw] px-4 py-3 overflow-hidden">
                                                    {{ $product->amount }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
