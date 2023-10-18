<x-app-layout>
    <div class="container max-w-7xl p-8 mx-auto mt-8">
        <h1 class="mb-4 text-3xl font-semibold">Producten</h1>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="h-40 overflow-hidden">
                        <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}"
                            alt="{{ $product->name }}">
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                        <p class="mt-2 text-gray-500">{{ $product->description }}</p>
                        <div class="">
                            <span class="text-lg font-semibold">
                                €{{ $product->price + $product->price * ($product->vat / 100) }}
                            </span>
                            <a href="{{ route('products.show', $product) }}"
                                class="block mt-2 text-blue-500 hover:underline">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
