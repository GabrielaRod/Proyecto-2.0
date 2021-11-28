<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <!-- Dashboard -->
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-jet-nav-link>

                    <!-- Live Feed of the Antennas Scanning -->
                    <x-jet-nav-link href="{{ route('livefeed.index') }}"
                        :active="request()->routeIs('livefeed.index')">
                        {{ __('Transmisión') }}
                    </x-jet-nav-link>

                    <!-- Antennas -->
                    <div class="ml-3  mt-4 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 transition ease-in-out duration-150">
                                        {{ __('Antenas') }}
                                    </button>
                                </span>
                                <x-slot name="content">
                                    <x-jet-dropdown-link href="{{ route('antennas.index') }}">
                                        {{ __('Lista') }}
                                    </x-jet-dropdown-link>

                                    <x-jet-dropdown-link href="{{ route('antennas.map') }}">
                                        {{ __('Mapa') }}
                                    </x-jet-dropdown-link>
                                </x-slot>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    <!-- Locations -->
                    <x-jet-nav-link href="{{ route('coordinates.index') }}"
                        :active="request()->routeIs('coordinates.index')">
                        {{ __('Localización') }}
                    </x-jet-nav-link>

                    <!-- Users -->
                    <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                        {{ __('Usuarios') }}
                    </x-jet-nav-link>

                    <!-- Vehicles -->
                    <x-jet-nav-link href="{{ route('vehicles.index') }}"
                        :active="request()->routeIs('vehicles.index')">
                        {{ __('Vehiculos') }}
                    </x-jet-nav-link>

                    <!-- Reports -->
                    <div class="ml-3  mt-4 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ __('Reportes') }}
                                    </button>
                                </span>
                                <x-slot name="content">
                                    <x-jet-dropdown-link href="{{ route('reports.index') }}">
                                        {{ __('Alertas') }}
                                    </x-jet-dropdown-link>

                                    <x-jet-dropdown-link href="{{ route('reports.admin') }}">
                                        {{ __('Tablero') }}
                                    </x-jet-dropdown-link>
                                </x-slot>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                {{-- Notifications --}}
                <div class="hidden sm:flex sm:items-center sm:ml-3">
                    <div x-data="{ dropdownOpen: false }" class="relative my-32">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="relative z-10 rounded-md bg-white p-2 focus:outline-none">
                            <span class="relative inline-flex rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="grey">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75">
                                    </span>
                                    <span class="object-right-top inline-flex rounded-full h-3 w-3 bg-blue-500"></span>

                                </span>
                        </button>
                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                            class="fixed inset-0 h-full w-full z-10">
                        </div>
                        <div x-show="dropdownOpen"
                            class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20"
                            style="width:20rem; display:none">
                            <?php $notifications = DB::table('notifications')
                                ->select('*')
                                ->where('notifications.Read', 'false')
                                ->get(); ?>
                            @foreach ($notifications as $notification)
                                <div class="py-2">
                                    <a href="" class=" flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                        <p class="text-gray-600 visited:text-medium-gray-400 text-sm mx-2">
                                            <span class="font-bold" href="#">
                                                {{ $notification->Message }}</span>
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                            <a href="{{ route('notifications.index') }}"
                                class="block bg-gray-800 text-white text-center font-bold py-2">See all
                                notifications</a>
                        </div>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Dashboard -->
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>

            <!-- Live Feed of the Antennas Scanning -->
            <x-jet-responsive-nav-link href="{{ route('livefeed.index') }}"
                :active="request()->routeIs('livefeed.index')">
                {{ __('Transmisión') }}
            </x-jet-responsive-nav-link>

            <!-- Antennas -->
            <x-jet-responsive-nav-link href="{{ route('antennas.index') }}"
                :active="request()->routeIs('antennas.index')">
                {{ __('Antenas') }}
            </x-jet-responsive-nav-link>

            <!-- Localización -->
            <x-jet-responsive-nav-link href="{{ route('coordinates.index') }}"
                :active="request()->routeIs('coordinates.index')">
                {{ __('Localización') }}
            </x-jet-responsive-nav-link>

            <!-- Usuarios -->
            <x-jet-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                {{ __('Usuarios') }}
            </x-jet-responsive-nav-link>

            <!-- Vehicles -->
            <x-jet-responsive-nav-link href="{{ route('vehicles.index') }}"
                :active="request()->routeIs('vehicles.index')">
                {{ __('Vehiculos') }}
            </x-jet-responsive-nav-link>

            <!-- Reports -->
            <x-jet-responsive-nav-link href="{{ route('reports.index') }}"
                :active="request()->routeIs('reports.index')">
                {{ __('Reportes') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                        :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures() && Auth::user()->current_team_id)
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                            :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
