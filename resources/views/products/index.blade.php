<x-app-layout>
    <div class="container p-8 mx-auto mt-8 max-w-7xl">
        @if (session('error'))
            <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                {{ session('error') }}
            </div>
        @elseif (session('success'))
            <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4 text-3xl font-semibold">Producten</h1>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-lg">
                    <div class="h-40 overflow-hidden border-b-2 border-blue-500">
                        <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}"
                            alt="{{ $product->name }}" class="rounded-t-lg">
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $product->title }}</h2>
                        <p class="mt-2 text-gray-500 truncate">{!! $product->description !!}</p>
                        <div class="text-right">
                            <span class="text-lg font-semibold">
                                €{{ number_format($product->price + $product->price * ($product->vat / 100), 2) }}
                            </span>
                            <a href="{{ route('products.show', $product) }}"
                                class="px-5 py-2 font-medium text-white transition bg-blue-500 border border-blue-500 rounded-lg hover:border-blue-700 btn">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
