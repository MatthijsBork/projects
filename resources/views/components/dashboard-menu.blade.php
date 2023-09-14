<div class="w-full p-4 mx-0 mb-3 bg-white shadow-sm sm:rounded-lg text-decoration-none">
    <h2 class="mb-4 text-lg font-semibold">Menu</h2>
    <ul>
        <li class="mb-2">
            <a href="{{ route('articles.dashboard') }}"
                class="block px-4 py-2 transition rounded-md bg-gray-50 hover:bg-gray-300 hover:text-blue-600">Artikelen</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('categories.dashboard') }}"
                class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">Categorieën</a>
        </li>
        <li class="mb-2">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf

            </form>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600">Utloggen</a>
        </li>
    </ul>
</div>
