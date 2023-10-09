<x-app-layout>
    <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center min-h-[10vh]">
            <h1 class="text-2xl font-bold">Gebruikers toevoegen</h1>
        </div>
        <div class="justify-between md:flex">
            <div class="w-full md:w-1/6 lg:w-1/5">
                <x-dashboard-menu></x-dashboard-menu>
            </div>
            <div class="w-full md:w-3/4">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <x-project-tab-menu :projectid="$projectid"></x-project-tab-menu>
                        <form action="{{ route('dashboard.projects.roles.store', [$projectid]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex mb-4 space-x-4">

                                <div class="w-1/2">
                                    <label for="user" class="block text-sm font-semibold text-gray-600">Kies
                                        gebruiker</label>
                                    <select id="user" name="user_id"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                        <option selected disabled>Kies een gebruiker</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-1/2">
                                    <label for="role" class="block text-sm font-semibold text-gray-600">Kies
                                        Rol</label>
                                    <select id="role" name="role_id"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                        <option selected disabled>Kies een rol</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="px-4 py-2 mt-5 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Toevoegen</button>
                                </div>
                            </div>
                        </form>
                        <table class="w-full text-left bg-white table-auto sm:rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">Gebruiker</th>
                                    <th class="px-4 py-2">Rol</th>
                                    <th class="px-4 py-2"></th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($userroles)
                                    @foreach ($userroles as $userrole)
                                        <tr class="border-b even:bg-gray-50">
                                            <td class="max-w-[22vw] px-4 py-2 overflow-hidden">
                                                {{ $userrole->user->name }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $userrole->role->name }}
                                            </td>
                                            <td class="px-4 py-2">
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.projects.roles.delete', [$projectid, $userrole->id]) }}"
                                                    class="text-red-500 hover:underline"
                                                    onclick="return confirm('Weet u zeker dat u dit wilt verwijderen?');">Verwijder</a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        @else
                            <p>Er zijn nog geen gebruikers toegevoegd</p>
                            @endif
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
