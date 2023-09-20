<x-app-layout>
    @csrf

    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-bold">Nieuw artikel</h1>
        </div>
        @if (session('error'))
            <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="justify-between md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>
            <div class="w-full md:w-3/4">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        // window.addEventListener('load', () => {
        //     for (const name of ['content']) {
        //         ClassicEditor.create(document.getElementById(name), {})
        //             .catch(error => {
        //                 console.error(error);
        //             });
        //     }
        // });
    </script>
</x-app-layout>
