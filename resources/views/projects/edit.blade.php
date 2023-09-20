<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-bold">Artikel bewerken</h1>
        </div>
        <div class="justify-between md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>

            <div class="w-full md:w-3/4">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <ul class="flex space-x-4">
                                <li class="mb-2">
                                    <a href=""
                                        class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">Tab
                                        1</a>
                                </li>
                                <li class="mb-2">
                                    <a href=""
                                        class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">Tab
                                        2</a>
                                </li>
                                <li class="mb-2">
                                    <a href=""
                                        class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">Tab
                                        3</a>
                                </li>
                            </ul>
                        </div>
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-semibold text-gray-600"
                                    required>Name</label>
                                <input type="text" id="title" name="title" value=""
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                @error('title')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div id="intro-toolbar"></div>

                                <label for="intro"
                                    class="block text-sm font-semibold text-gray-600">Introductie</label>
                                <textarea id="intro" name="intro"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 min-h-[20vh]"></textarea>
                                @error('intro')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button
                                    class="px-4 py-2 text-red-700 bg-transparent border border-red-500 rounded-lg hover:bg-red-500 hover:text-white hover:border-transparent">
                                    Annuleren
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Opslaan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        // window.addEventListener('load', () => {
        //     for (const name of ['content']) {
        //         ClassicEditor.create(document.getElementById(name))
        //             .catch(error => {
        //                 console.error(error);
        //             });
        //     }
        // });
    </script>
</x-app-layout>
