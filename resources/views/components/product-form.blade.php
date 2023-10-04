<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf

    <div class="tab-content">
        <div class="mb-4">
            <x-input-label for="title">Titel</x-input-label>
            <input type="text" id="title" name="title" value="{{ $product->title ?? old('title') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('title')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="description">Beschrijving</x-input-label>
            <input type="text" id="description" name="description"
                value="{{ $product->description ?? old('description') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('description')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="price">Prijs</x-input-label>
            <input type="text" id="price" name="price" value="{{ $product->price ?? old('price') }}"
                class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('price')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="stock">Voorraad</x-input-label>
            <input type="text" id="stock" name="stock" value="{{ $product->stock ?? old('stock') }}"
                class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('stock')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <x-input-label for="vat">BTW (%)</x-input-label>
            <input type="text" id="vat" name="vat" value="{{ $product->vat ?? old('vat') }}"
                class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('vat')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @if (isset($product->image_name) && $product->image_name !== '')
            <div class="mb-4">
                <x-input-label for="current_image">Huidige Afbeelding</x-input-label>
                <img id="current_image"
                    src="{{ asset('images/products/' . $product->id . '/' . $product->image_name) }}"
                    alt="Huidige Afbeelding" class="max-w-md p-1 border-gray-400 rounded-lg">
            </div>
            <div class="mb-4">
                <x-input-label for="delete_image">Verwijder Afbeelding</x-input-label>
                <input type="checkbox" id="delete_image" name="delete_image" value="1">
            </div>
        @endif
        @foreach ($product::getAllProperties() as $property)
            <div class="mb-4">
                <x-input-label for="{{ $property->name }}">{{ $property->name }}</x-input-label>
                <input type="text" id="{{ $property->name }}" name="properties[{{ $property->id }}]"
                    value="{{ $property->getValueForProduct($product->id) }}"
                    class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            </div>
        @endforeach
        <div class="mb-4">
            <a href="{{ route('dashboard.properties.create') }}"
                class="px-4 py-2 text-white bg-blue-500 rounded-lg btn hover:bg-blue-600">Eigenschap toevoegen</a>
        </div>
        <div class="mb-4">
            <x-input-label for="image">Foto</x-input-label>
            <input type="file" id="image" name="image" value="1"
                class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
            @error('image')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="text-right">
        <button
            class="px-4 py-2 mt-3 text-red-700 bg-transparent border-red-500 rounded-lg hover:bg-red-500 hover:text-white hover:border-transparent">
            Annuleren
        </button>
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Opslaan</button>
    </div>
</form>
{{-- <script defer>
    window.addEventListener('load', () => {
        for (const name of ['description']) {
            ClassicEditor.create(document.getElementById(name), {})
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script> --}}
