<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-semibold">Bestelling bewerken</h1>
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
        <div class="justify-between rounded-lg md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>
            <div class="w-full md:w-3/4">
                <div class="w-full">
                    <div class="p-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                        <div class="mb-4 border-b">
                            <x-nav-link class="py-3" :href="route('dashboard.orders.edit', [$order])" :active="request()->routeIs('dashboard.orders.edit')">
                                Bestelling
                            </x-nav-link>
                            <x-nav-link class="py-3" :href="route('dashboard.orders.edit.products', [$order])" :active="request()->routeIs('dashboard.orders.edit.products*')">
                                Producten
                            </x-nav-link>
                        </div>
                        <div class="mb-4">
                            <h1 class="mb-10 text-lg font-bold">Bezorgadres</h1>

                            <form id="orderform" method="POST"
                                action="{{ route('dashboard.orders.update', [$order]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="items-center mb-4">
                                    <x-input-label class="mx-2" for="name">Naam</x-input-label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name') ?? $order->shipping()->name }}"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                    @error('name')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="items-center mb-4">
                                    <x-input-label class="mx-2" for="address">Adres</x-input-label>
                                    <input type="text" id="address" name="address"
                                        value="{{ old('address') ?? $order->shipping()->address }}"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                    @error('address')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="items-center mb-4">
                                    <x-input-label class="mx-2" for="zipcode">Postcode</x-input-label>
                                    <input type="text" id="zipcode" name="zipcode"
                                        value="{{ old('zipcode') ?? $order->shipping()->zipcode }}"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                    @error('zipcode')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="items-center mb-4">
                                    <x-input-label class="mx-2" for="place">Plaats</x-input-label>
                                    <input type="text" id="place" name="place"
                                        value="{{ old('place') ?? $order->shipping()->place }}"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                    @error('place')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="items-center mb-4">
                                    <x-input-label class="mx-2" for="title">Telefoonnummer</x-input-label>
                                    <input type="text" id="telephone" name="telephone"
                                        value="{{ old('telephone') ?? $order->telephone }}"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                    @error('telephone')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="items-center mb-4">
                                    <x-input-label class="mx-2" for="email">E-mail</x-input-label>
                                    <input type="text" id="email" name="email"
                                        value="{{ old('email') ?? $order->email }}"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                    @error('email')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="items-center mb-4">
                                    <label class="block">
                                        <input type="checkbox" id="invoice-checkbox" name="invoice"
                                            {{ $order->invoice() !== null ? '' : 'checked' }}>
                                        Factuuradres is hetzelfde als bezorgadres
                                    </label>
                                </div>

                                <div id="invoice" style="{{ $order->invoice() == null ? 'display: none;' : '' }}">
                                    <h1 class="mb-10 text-lg font-bold">Factuuradres</h1>
                                    <div class="items-center mb-4">
                                        <x-input-label class="mx-2" for="invoice-name">Naam</x-input-label>
                                        <input type="text" id="invoice-name" name="invoice-name"
                                            value="{{ old('invoice-name') ?? ($order->invoice()->name ?? null) }}"
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                        @error('invoice-name')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="items-center mb-4">
                                        <x-input-label class="mx-2" for="invoice-address">Adres</x-input-label>
                                        <input type="text" id="invoice-address" name="invoice-address"
                                            value="{{ old('invoice-address') ?? ($order->invoice()->address ?? null) }}"
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                        @error('invoice-name')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="items-center mb-4">
                                        <x-input-label class="mx-2" for="invoice-zipcode">Postcode</x-input-label>
                                        <input type="text" id="invoice-zipcode" name="invoice-zipcode"
                                            value="{{ old('invoice-zipcode') ?? ($order->invoice()->zipcode ?? null) }}"
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                        @error('invoice-zipcode')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="items-center mb-4">
                                        <x-input-label class="mx-2" for="invoice-place">Plaats</x-input-label>
                                        <input type="text" id="invoice-place" name="invoice-place"
                                            value="{{ old('invoice-place') ?? ($order->invoice()->place ?? null) }}"
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                        @error('invoice-place')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full text-right">
                                    <button type="submit"
                                        class="px-4 py-2 mb-2 text-white bg-blue-700 rounded-lg hover:bg-blue-800">Opslaan</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
