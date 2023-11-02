<x-app-layout>
    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-10 text-2xl font-bold">Bestellen</h1>
        <div class="justify-center mx-auto md:flex md:space-x-6">
            <div class="p-6 mb-6 bg-white rounded-lg md:w-2/3">
                <h1 class="mb-10 text-lg font-bold">Producten</h1>
                @foreach ($cart['products'] as $product)
                    <div class="rounded-lg ">
                        <div class="justify-between p-6 mb-6 bg-white rounded-lg sm:flex sm:justify-start">
                            <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}"
                                alt="{{ $product->name }}" alt="product-image"
                                class="object-cover min-h-full rounded-lg sm:w-40" />
                            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                <div class="mt-5 sm:mt-0">
                                    <h2 class="text-lg font-bold text-gray-900">{{ $product->title }}</h2>
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <div class="flex justify-between mt-4 sm:mt-0 sm:block sm:space-x-6">
                                    <div class="flex items-center">
                                        <p class="font-bold">€{{ $product->netprice }}
                                        <p class="text-sm text-gray-400">/stuk</p>
                                        </p>
                                    </div>
                                    <div class="flex items-center border-gray-100">
                                        <p id="quantity" class="">Aantal: <b>{{ $product->quantity }}</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach

                <div class="flex justify-between mt-5 xl:flex-row">
                    <div>
                        <h1 class="mb-2 text-lg font-bold">Adres</h1>
                        <p><b>Naam: </b>{{ $order['name'] }}</p>
                        <p><b>Adres: </b>{{ $order['address'] }}</p>
                        <p><b>Plaats: </b>{{ $order['place'] }}</p>
                        <p><b>Postcode: </b>{{ $order['zipcode'] }}</p>
                    </div>
                    <div>
                        @if (!isset($order['invoice']))
                            <h1 class="mb-2 text-lg font-bold">Factuuradres</h1>
                            <p><b>Naam: </b>{{ $order['invoice-name'] }}</p>
                            <p><b>Adres: </b>{{ $order['invoice-address'] }}</p>
                            <p><b>Plaats: </b>{{ $order['invoice-place'] }}</p>
                            <p><b>Postcode: </b>{{ $order['invoice-zipcode'] }}</p>
                        @endif
                    </div>
                    <div>
                        <h1 class="mb-2 text-lg font-bold">Contactgegevens</h1>
                        <p><b>E-mail: </b>{{ $order['email'] }}</p>
                        <p><b>Telefoon: </b>{{ $order['telephone'] }}</p>
                    </div>
                </div>
            </div>
            <div class="h-full p-6 mt-6 bg-white border rounded-lg shadow-md md:mt-0 md:w-1/3">
                <div class="flex justify-between mb-2">
                    <p class="text-gray-700">BTW</p>
                    <p class="text-gray-700">€{{ number_format($cart['taxedtotal'], 2) }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700">Producten</p>
                    <p class="text-gray-700">€{{ number_format($cart['grosstotal'], 2) }}</p>
                </div>
                <hr class="my-4" />
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Totaal</p>
                    <div class="">
                        <p class="mb-1 text-lg font-bold">€{{ number_format($cart['subtotal'], 2) }}</p>
                        <p class="text-sm text-gray-700">incl. BTW</p>
                    </div>
                </div>
                <div class="flex flex-row justify-between mt-6 align-middle">
                    <a href="{{ route('products.cart') }}" class="w-1/2 py-1.5 underline text-red-500">
                        Annuleren
                    </a>
                    <a href="{{ route('products.orders.store') }}"
                        class="btn bg-blue-500 hover:bg-blue-600 text-white font-medium py-1.5 rounded-md px-10">
                        Afrekenen
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
