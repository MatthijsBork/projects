<div class="w-full p-4 mx-0 mb-3 bg-white shadow-sm sm:rounded-lg text-decoration-none">
    <h2 class="mb-4 text-lg font-semibold">Menu</h2>
    <ul>
        <li class="mb-2">
            <x-button-link href="{{ route('user.projects.index') }}" :active="request()->routeIs('user.projects.*')">Projecten</x-button-link>
        </li>
        <li class="mb-2">
            <x-button-link href="{{ route('user.orders.own') }}" :active="request()->routeIs('user.orders*')">Bestellingen</x-button-link>
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
