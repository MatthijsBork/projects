<div class="rounded-lg ">
    <div class="justify-between p-6 mb-6 bg-white rounded-lg shadow-md sm:flex sm:justify-start">
        <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}" alt="{{ $product->name }}"
            alt="product-image" class="object-cover overflow-hidden rounded-lg sm:w-40 sm:h-20" />
        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
            <div class="mt-5 sm:mt-0">
                <h2 class="text-lg font-bold text-gray-900">{{ $product->title }}</h2>
                <p>{!! $product->description !!}</p>
            </div>
            <div class="flex mt-4 sm:mt-0 sm:block">
                <div class="flex items-center">
                    <p class="font-bold">€{{ $product->netprice }}
                    <p class="text-sm text-gray-400">/stuk</p>
                    </p>
                </div>
                <div class="flex items-center border-gray-100">
                    @if ($product->quantity > 1)
                        <a href="{{ route('products.cart.subtract', [$product]) }}">
                            <span
                                class="cursor-pointer rounded bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50">
                                - </span>

                        </a>
                    @else
                        <a>
                            <span class="cursor-pointer rounded text-red-600 bg-gray-100 py-1 px-3.5">
                                Min. </span>

                        </a>
                    @endif
                    <p class="mx-4">{{ $product->quantity }}</p>

                    @if ($product->quantity < $product->stock)
                        <a href="{{ route('products.cart.add', [$product]) }}">
                            <span
                                class="px-3 py-1 duration-100 bg-gray-100 rounded cursor-pointer hover:bg-blue-500 hover:text-blue-50">
                                + </span>
                        </a>
                    @else
                        <a>
                            <span class="px-3 py-1 text-red-600 bg-gray-100 rounded cursor-pointer">Max.</span>
                        </a>
                    @endif
                    <a href="{{ route('products.cart.delete', [$product]) }}"
                        onclick="return confirm('Weet u zeker dat u dit wilt verwijderen?');">
                        <x-trash-icon></x-trash-icon>
                    </a>
                </div>
                <p class="text-gray-500"><i>{{ $product->stock }} Op voorraad</i></p>
            </div>
        </div>
    </div>
</div>
