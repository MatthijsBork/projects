<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-bold">Bestelling bewerken</h1>
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
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4 border-b">
                            <x-nav-link class="py-3" :href="route('dashboard.orders.edit', [$order])" :active="request()->routeIs('dashboard.orders.edit')">
                                Bestelling
                            </x-nav-link>
                            <x-nav-link class="py-3" :href="route('dashboard.orders.edit.products', [$order])" :active="request()->routeIs('dashboard.orders.edit.products*')">
                                Producten
                            </x-nav-link>
                        </div>
                        <form action="{{ route('dashboard.orders.products.store', [$order]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="flex mb-4 space-x-4">
                                <div class="w-2/3">
                                    <label for="product" class="block text-sm font-semibold text-gray-600">Product
                                        toevoegen</label>
                                    <select id="product" name="product_id"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                        <option selected disabled>Kies een product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-1/3">
                                    <x-input-label for="quantity">Hoeveelheid</x-input-label>
                                    <input
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                                        type="number" name="quantity" id="quantity" value="1" min="1">
                                </div>
                                <div>
                                    <button type="submit"
                                        class="px-4 py-2 mt-5 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Toevoegen</button>
                                </div>
                            </div>
                        </form>
                        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">Product</th>
                                    <th class="px-4 py-2">Aantal</th>
                                    <th class="px-4 py-2">Brutoprijs/st</th>
                                    <th class="px-4 py-2">Nettoprijs</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr class="border-b even:bg-gray-50">
                                        <td class="max-w-[22vw] px-4 py-2 overflow-hidden">
                                            {{ $product->product->title }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center border-gray-100">
                                                {{-- <a
                                                    href="{{ route('dashboard.orders.products.subtract', [$order, $product]) }}">
                                                    <span
                                                        class="cursor-pointer rounded bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50">
                                                        - </span>
                                                </a>
                                                <p class="mx-4">{{ $product->amount }}</p>
                                                <a
                                                    href="{{ route('dashboard.orders.products.add', [$order, $product]) }}">
                                                    <span
                                                        class="px-3 py-1 duration-100 bg-gray-100 rounded cursor-pointer hover:bg-blue-500 hover:text-blue-50">
                                                        + </span>
                                                </a> --}}



                                                @if ($product->amount > 1)
                                                    <a
                                                        href="{{ route('dashboard.orders.products.subtract', [$order, $product]) }}">
                                                        <span
                                                            class="cursor-pointer rounded bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50">
                                                            - </span>

                                                    </a>
                                                @else
                                                    <a>
                                                        <span
                                                            class="cursor-pointer rounded text-red-600 bg-gray-100 py-1 px-3.5">
                                                            Min. </span>

                                                    </a>
                                                @endif
                                                <p class="mx-4">{{ $product->amount }}</p>

                                                @if ($product->amount < $product->product->stock)
                                                    <a
                                                        href="{{ route('dashboard.orders.products.add', [$order, $product]) }}">
                                                        <span
                                                            class="px-3 py-1 duration-100 bg-gray-100 rounded cursor-pointer hover:bg-blue-500 hover:text-blue-50">
                                                            + </span>
                                                    </a>
                                                @else
                                                    <a class="mx-4">
                                                        <span
                                                            class="px-3 py-1 text-red-600 bg-gray-100 rounded cursor-pointer">Max.</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-2">
                                            €{{ $product->price }}
                                        </td>
                                        <td class="px-4 py-2">
                                            €{{ ($product->price + ($product->price * $product->vat) / 100) * $product->amount }}
                                        </td>
                                        <td class="flex justify-end py-3 text-right">
                                            <a href="{{ route('dashboard.orders.products.delete', [$order, $product]) }}"
                                                class="text-red-500 hover:underline"
                                                onclick="return confirm('Weet u zeker dat u dit wilt verwijderen?');">
                                                <x-trash-icon></x-trash-icon>
                                            </a>
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
</x-app-layout>
