<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Bestelling</h1>
            <a href="{{ route('user.orders.show.pdf', [$order]) }}"
                class="px-5 py-3 font-medium text-white transition bg-blue-700 rounded-lg shadow d-flex hover:bg-blue-800">
                <div class="flex flex-row gap-2 p-0 m-0">
                    <x-pdf-icon></x-pdf-icon>
                    Download PDF
                </div>
            </a>
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
                        <div class="mb-4 border-b">
                            <x-nav-link class="py-3" :href="route('user.orders.show', [$order])" :active="request()->routeIs('user.orders.show*')">
                                Bestelling
                            </x-nav-link>
                            <x-nav-link class="py-3" :href="route('user.orders.show.products', [$order])" :active="request()->routeIs('user.orders.show.products*')">
                                Producten
                            </x-nav-link>
                        </div>
                        <div class="pt-5 pb-5 border-b">
                            <div>
                                <div class="flex justify-start gap-10 flex-start xl:flex-row">
                                    <div>
                                        <h1 class="mb-2 text-lg font-bold">Adres</h1>
                                        <p><b>Naam: </b>{{ $order->shipping()->name }}</p>
                                        <p><b>Adres: </b>{{ $order->shipping()->address }}</p>
                                        <p><b>Plaats: </b>{{ $order->shipping()->place }}</p>
                                        <p><b>Postcode: </b>{{ $order->shipping()->zipcode }}</p>
                                    </div>
                                    <div>
                                        <h1 class="mb-2 text-lg font-bold">Contactgegevens</h1>
                                        <p><b>E-mail: </b>{{ $order['email'] }}</p>
                                        <p><b>Telefoon: </b>{{ $order['telephone'] }}</p>
                                    </div>
                                    @if ($order->invoice())
                                        <div>
                                            <h1 class="mb-2 text-lg font-bold">Factuuradres</h1>
                                            <p><b>Naam: </b>{{ $order->invoice()->name }}</p>
                                            <p><b>Adres: </b>{{ $order->invoice()->address }}</p>
                                            <p><b>Plaats: </b>{{ $order->invoice()->place }}</p>
                                            <p><b>Postcode: </b>{{ $order->invoice()->zipcode }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
