<div class="justify-between p-6 mb-6 bg-white rounded-lg shadow-md sm:flex sm:justify-start">
    <img src="https://images.unsplash.com/photo-1515955656352-a1fa3ffcd111?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
        alt="product-image" class="w-full rounded-lg sm:w-40" />
    <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
        <div class="mt-5 sm:mt-0">
            <h2 class="text-lg font-bold text-gray-900">Nike Air Max 2019</h2>
            <x-input-label for="price">Aantal</x-input-label>
            <div class="flex mb-4">
                <input type="number" step="0.01" id="price" name="price"
                    class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
                <a href="">
                    <x-trash-icon></x-trash-icon>
                </a>
            </div>
        </div>
        <div class="flex justify-between mt-4 sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
            <div class="flex items-center space-x-4">
                <p class="font-bold">$200</p>
            </div>
            <div class="flex items-center border-gray-100">
            </div>
        </div>
    </div>
</div>
