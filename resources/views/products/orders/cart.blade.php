<x-app-layout>
    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-10 text-2xl font-bold">Winkelwagentje</h1>
        <div class="justify-center mx-auto md:flex md:space-x-6">
            @if (!empty($cart['products']))
                <div class="rounded-lg md:w-2/3">
                    @foreach ($cart['products'] as $product)
                        <x-cart-item :product="$product">

                        </x-cart-item>
                    @endforeach

                </div>
                <div class="h-full p-6 mt-6 bg-white border rounded-lg shadow-md md:mt-0 md:w-1/3">
                    <div class="flex justify-between mb-2">
                        <p class="text-gray-700">BTW</p>
                        <p class="text-gray-700">€{{ number_format($cart['taxedtotal'], 2) ?? 0 }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-700">Producten</p>
                        <p class="text-gray-700">€{{ number_format($cart['grosstotal'], 2) ?? 0 }}</p>
                    </div>
                    <hr class="my-4" />
                    <div class="flex justify-between">
                        <p class="text-lg font-bold">Totaal</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold">€{{ number_format($cart['subtotal'], 2) ?? 0 }}</p>
                            <p class="text-sm text-gray-700">incl. BTW</p>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between mt-6 align-middle">
                        <a href="{{ route('products.index') }}" class="w-1/2 py-1.5 underline text-red-500">
                            Verder winkelen
                        </a>
                        <a href="{{ route('products.cart.order') }}"
                            class="btn bg-blue-500 hover:bg-blue-600 text-white font-medium py-1.5 rounded-md px-10">
                            Bestellen
                        </a>
                    </div>
                </div>
            @else
                <div class="w-full p-10 text-center bg-white rounded-lg shadow">
                    <h1 class="text-xl font-bold text-blue-500">Je winkelwagentje is leeg.</h1>
                    <p class="mb-4">Er zijn nog geen producten toegevoegd</p>
                    <a href="{{ route('products.index') }}"
                        class="px-5 py-2 font-medium text-blue-500 transition bg-white border border-blue-500 rounded-md shadow-lg hover:border-blue-700 hover:text-blue-700 hover:bg-gray-50 hover:shadow-sm btn">
                        Verder winkelen
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
