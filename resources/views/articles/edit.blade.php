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
                        <x-article-form :article="$article" :categories="$categories"
                            route="{{ route('dashboard.articles.update', [$article]) }}"></x-article-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        window.addEventListener('load', () => {
            for (const name of ['content']) {
                ClassicEditor.create(document.getElementById(name))
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
</x-app-layout>
