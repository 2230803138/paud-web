<nav x-data="{ open: false }" class="bg-white shadow-md border-b border-pink-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex items-center">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">

                    @if(Auth::check() && Auth::user()->role == 'admin')

                        <a href="{{ route('dashboard') }}">

                    @elseif(Auth::check() && Auth::user()->role == 'orangtua')

                        <a href="{{ route('dashboard.orangtua') }}">

                    @else

                        <a href="/">

                    @endif

                        <x-application-logo class="block h-10 w-auto fill-current text-pink-500" />

                    </a>

                </div>


                <!-- Navigation -->
                @if(Auth::check())

                <div class="hidden sm:flex sm:items-center sm:ms-10">

                    @if(Auth::user()->role == 'admin')

                        <x-nav-link 
                            :href="route('dashboard')" 
                            :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>

                    @elseif(Auth::user()->role == 'orangtua')

                        <x-nav-link 
                            :href="route('dashboard.orangtua')" 
                            :active="request()->routeIs('dashboard.orangtua')">
                            Dashboard
                        </x-nav-link>

                    @endif

                </div>

                @endif

            </div>



            <!-- Right -->

            @if(Auth::check())

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-4 py-2 bg-pink-100 border border-pink-200 rounded-xl text-sm font-medium text-pink-700 hover:bg-pink-200 transition">

                            <div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-2">
                                ▼
                            </div>

                        </button>

                    </x-slot>


                    <x-slot name="content">


                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>


                        <!-- Logout -->

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf


                            <x-dropdown-link 
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                Log Out

                            </x-dropdown-link>


                        </form>


                    </x-slot>


                </x-dropdown>


            </div>


            @else


            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">


                <a href="{{ route('login') }}"
                    class="text-pink-600 hover:text-pink-800 font-semibold">

                    Login

                </a>


                <a href="{{ route('register') }}"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">

                    Register

                </a>


            </div>


            @endif



            <!-- Hamburger -->

            <div class="-me-2 flex items-center sm:hidden">


                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-pink-100">


                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">


                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />


                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />


                    </svg>


                </button>


            </div>


        </div>

    </div>

</nav>