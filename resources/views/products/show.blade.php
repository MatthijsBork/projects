<x-app-layout>
    <div class="container p-8 mx-auto mt-8">
        <div class="flex">
            <!-- Product Image -->
            <div class="w-1/2">
                <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}" alt="{{ $product->name }}"
                    class="rounded-lg">
            </div>

            <div class="w-1/2 ml-4">
                <h1 class="text-3xl font-semibold">{{ $product->name }}</h1>
                <p class="mt-2 text-gray-500">{{ $product->description }}</p>

                <div class="mt-4 text-2xl font-semibold text-green-500">
                    ${{ $product->price }}
                </div>

                <a href="{{ route('products.cart.add', [$product]) }}">
                    <button class="px-4 py-2 mt-4 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Toevoegen aan winkelwagen
                    </button>
                </a>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold">Product specificaties</h2>
                    <ul class="mt-2 list-disc list-inside">
                        {{-- <li>Size: {{ $product->size }}</li>
                        <li>Color: {{ $product->color }}</li>
                        <li>Material: {{ $product->material }}</li> --}}
                        @foreach ($product->properties as $property)
                            <li>{{ $property->value }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
