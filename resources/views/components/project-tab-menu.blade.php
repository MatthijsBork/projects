<div class="mb-4 border-b">
    <x-nav-link class="py-3" :href="route('dashboard.projects.edit', [$projectid])" :active="request()->routeIs('dashboard.projects.edit*')">
        Project
    </x-nav-link>
    <x-nav-link class="py-3" :href="route('dashboard.projects.roles', [$projectid])" :active="request()->routeIs('dashboard.projects.roles*')">
        Gebruikers
    </x-nav-link>
    <x-nav-link class="py-3" :href="route('dashboard.projects.tasks', [$projectid])" :active="request()->routeIs('dashboard.projects.tasks*')">
        Taken
    </x-nav-link>
</div>
