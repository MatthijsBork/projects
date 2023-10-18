<x-app-layout>
    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-10 text-2xl font-bold">Winkelwagentje</h1>
        <div class="justify-center mx-auto md:flex md:space-x-6">

            <div class="rounded-lg md:w-2/3">
                @foreach ($cart['products'] as $product)
                    <x-cart-item :product="$product">

                    </x-cart-item>
                @endforeach
            </div>
            <div class="h-full p-6 mt-6 bg-white border rounded-lg shadow-md md:mt-0 md:w-1/3">
                <div class="flex justify-between mb-2">
                    <p class="text-gray-700">BTW</p>
                    <p class="text-gray-700">€{{ $cart['taxedtotal'] }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700">Producten</p>
                    <p class="text-gray-700">€{{ $cart['grosstotal'] }}</p>
                </div>
                <hr class="my-4" />
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Totaal</p>
                    <div class="">
                        <p class="mb-1 text-lg font-bold">€{{ $cart['subtotal'] }}</p>
                        <p class="text-sm text-gray-700">incl. BTW</p>
                    </div>
                </div>
                <div class="justify-between align-middle flex flex-row mt-6">
                    <a href="{{ route('products.index') }}" class="w-1/2 py-1.5 underline text-red-500">
                        Verder winkelen
                    </a>
                    <a href="{{ route('products.cart.order') }}"
                        class="btn bg-blue-500 hover:bg-blue-600 text-white font-medium py-1.5 rounded-md px-10">
                        Bestellen
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
