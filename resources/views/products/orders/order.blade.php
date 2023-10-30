<x-app-layout>
    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-10 text-2xl font-bold">Bestellen</h1>
        <div class="justify-center mx-auto md:flex md:space-x-6">
            <div class="p-6 mb-6 bg-white rounded-lg shadow-md md:w-2/3">
                <h1 class="mb-10 text-lg font-bold">Bezorgadres</h1>

                <form id="orderform" method="POST" action="{{ route('products.cart.order.confirm') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="items-center mb-4">
                        <x-input-label class="mx-2" for="name">Naam</x-input-label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="items-center mb-4">
                        <x-input-label class="mx-2" for="address">Adres</x-input-label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        @error('address')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="items-center mb-4">
                        <x-input-label class="mx-2" for="zipcode">Postcode</x-input-label>
                        <input type="text" id="zipcode" name="zipcode" value="{{ old('zipcode') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        @error('zipcode')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="items-center mb-4">
                        <x-input-label class="mx-2" for="place">Plaats</x-input-label>
                        <input type="text" id="place" name="place" value="{{ old('place') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        @error('place')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="items-center mb-4">
                        <x-input-label class="mx-2" for="title">Telefoonnummer</x-input-label>
                        <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        @error('telephone')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="items-center mb-4">
                        <x-input-label class="mx-2" for="email">E-mail</x-input-label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="items-center mb-4">
                        <label class="block">
                            <input type="checkbox" id="invoice-checkbox" name="invoice"
                                {{ old('invoice') ? 'checked' : '' }} checked>
                            Factuuradres is hetzelfde als bezorgadres
                        </label>
                    </div>

                    <div id="invoice" style="display: none;">
                        <h1 class="mb-10 text-lg font-bold">Factuuradres</h1>
                        <div class="items-center mb-4">
                            <x-input-label class="mx-2" for="invoice-name">Naam</x-input-label>
                            <input type="text" id="invoice-name" name="invoice-name"
                                value="{{ old('invoice-name') }}"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('invoice-name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="items-center mb-4">
                            <x-input-label class="mx-2" for="invoice-address">Adres</x-input-label>
                            <input type="text" id="invoice-address" name="invoice-address"
                                value="{{ old('invoice-address') }}"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('invoice-name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="items-center mb-4">
                            <x-input-label class="mx-2" for="invoice-zipcode">Postcode</x-input-label>
                            <input type="text" id="invoice-zipcode" name="invoice-zipcode"
                                value="{{ old('invoice-zipcode') }}"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('invoice-zipcode')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="items-center mb-4">
                            <x-input-label class="mx-2" for="invoice-place">Plaats</x-input-label>
                            <input type="text" id="invoice-place" name="invoice-place"
                                value="{{ old('invoice-place') }}"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('invoice-place')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
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
                <div class="flex flex-row justify-between mt-6 align-middle">
                    <a href="{{ route('products.cart') }}" class="w-1/2 py-1.5 underline text-red-500">
                        Annuleren
                    </a>
                    <a href="#" onclick="document.getElementById('orderform').submit();"
                        class="btn bg-blue-500 hover:bg-blue-600 text-white font-medium py-1.5 rounded-md px-10">
                        Betalen
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const showInvoiceFields = document.getElementById('invoice-checkbox');
    const additionalFieldsContainer = document.getElementById('invoice');

    showInvoiceFields.addEventListener('change', function() {
        if (showInvoiceFields.checked) {
            additionalFieldsContainer.style.display = 'none';
        } else {
            additionalFieldsContainer.style.display = 'block';
        }
    });
</script>
