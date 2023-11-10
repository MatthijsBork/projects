<x-app-layout>
    <div class="container p-8 mx-auto mt-8 max-w-7xl">
        <div class="flex flex-col-reverse bg-white rounded-lg lg:flex-row flex-end">
            <div class="w-1/2 p-5 m-4 bg-white">
                <div class="flex flex-row justify-between">
                    <h1 class="text-3xl font-semibold">{{ $product->title }}</h1>


                </div>

                <div class="mt-4 text-2xl font-semibold">
                    €{{ number_format($product->price + $product->price * ($product->vat / 100), 2) }}
                </div>


                <a href="{{ route('products.cart.add', [$product]) }}">
                    <button
                        class="px-4 py-3 mt-4 text-base font-normal text-white transition bg-blue-600 rounded-lg shadow-lg hover:shadow-sm hover:bg-blue-700">
                        Toevoegen aan winkelwagen
                    </button>
                </a>
                <div class="mt-8">
                    <h2 class="text-xl font-semibold">Beschrijving</h2>
                    <p class="mt-2">{!! $product->description !!}</p>
                </div>
                @if ($product->properties[0] ?? false)
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold">Product specificaties</h2>
                        @foreach ($product->properties as $property)
                            <p><b>{{ $property->property->name }}</b>: {{ $property->value }} </p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="w-3/4 p-2 m-4 rounded-lg lg:w-1/2">
                <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}"
                    alt="{{ $product->name }}" class="p-5 border rounded-lg">
            </div>
        </div>
    </div>
</x-app-layout>
