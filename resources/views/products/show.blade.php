<x-app-layout>
    <div class="container p-8 mx-auto mt-8 max-w-7xl">
        <div class="flex flex-col-reverse lg:flex-row flex-end">
            <div class="w-1/2 ml-4">
                <h1 class="text-3xl font-semibold">{{ $product->title }}</h1>

                <div class="mt-4 text-2xl font-semibold">
                    €{{ $product->price + $product->price * ($product->vat / 100) }}
                </div>

                <a href="{{ route('products.cart.add', [$product]) }}">
                    <button class="px-4 py-2 mt-4 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Toevoegen aan winkelwagen
                    </button>
                </a>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold">Beschrijving</h2>
                    <p class="mt-2">{!! $product->description !!}</p>
                </div>
                <div class="mt-8">
                    @if (isset($product->properties))
                        <h2 class="text-xl font-semibold">Product specificaties</h2>
                        @foreach ($product->properties as $property)
                            <p><b>{{ $property->name }}</b>: {{ $property->value }} </p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="w-3/4 lg:w-1/2 rounded-xl">
                <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}"
                    alt="{{ $product->name }}" class="rounded-xl">
            </div>
        </div>
    </div>
</x-app-layout>
