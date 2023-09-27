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
                        <div class="mb-4">
                            <ul
                                class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                                <li class="mr-2">
                                    <a href="{{ route('dashboard.projects.edit', [$project->id]) }}"
                                        class="inline-block p-4 rounded-t-lg bg-gray-50 hover:bg-gray-100">
                                        Project</a>
                                </li>
                                <li class="mr-2">
                                    <a href="{{ route('dashboard.projects.roles', [$project->id]) }}"
                                        class="inline-block p-4 text-blue-500 rounded-t-lg bg-gray-50 hover:bg-gray-100">
                                        Gebruikers</a>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('dashboard.projects.roles.store', [$project->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex mb-4 space-x-4">

                                <div class="w-1/2">
                                    <label for="user" class="block text-sm font-semibold text-gray-600">Kies
                                        gebruiker</label>
                                    <select id="user" name="user"
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
                                    <select id="role" name="role"
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
                                @if (isset($userroles))
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
                                                <a href="{{ route('dashboard.projects.roles.delete', [$project->id, $userrole->id]) }}"
                                                    class="text-red-500 hover:underline">Verwijder</a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
