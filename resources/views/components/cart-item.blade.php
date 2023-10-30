<div class="rounded-lg ">
    <div class="justify-between p-6 mb-6 bg-white rounded-lg shadow-md sm:flex sm:justify-start">
        <img src="{{ asset('images/products/' . $product->id . '/' . $product->img) }}" alt="{{ $product->name }}"
            alt="product-image" class="object-cover min-h-full rounded-lg sm:w-40" />
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
                    <a href="{{ route('products.cart.subtract', [$product]) }}">
                        <span
                            class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50">
                            - </span>
                    </a>
                    <p class="mx-4">{{ $product->quantity }}</p>
                    <a href="{{ route('products.cart.add', [$product]) }}">
                        <span
                            class="px-3 py-1 duration-100 bg-gray-100 rounded-r cursor-pointer hover:bg-blue-500 hover:text-blue-50">
                            + </span>
                    </a>
                    <a href="{{ route('products.cart.delete', [$product]) }}">
                        <x-trash-icon></x-trash-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
