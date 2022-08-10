<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar mt-4">
        <a href="{{ route('home') }}" class="mr-auto">
            <img alt="inTera - Sistema de Telemedicina da TeraTelemedicina" class="w-40 flex" src="{{ asset('dist/images/logo.teraTelemedicina.svg') }}">
            @if (session()->get('profile'))
                <p class="text-right text-white">{{ __(session()->get('profile')) }}</p>
            @endif
        </a>
        <a href="javascript:;" id="mobile-menu-toggler">
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        @if (session()->has('side-menu'))
            @foreach (session('side-menu') as $menu)
                @if ($menu == 'devider')
                    <li class="menu__devider my-6"></li>
                    @continue
                @else
                    @php
                        $route      = false;
                        $routeGroup = false;
                        $classMenu  = false;
                        if(isset($menu['route-group']) && request()->is($menu['route-group'].'*'))
                        {
                            $routeGroup = $menu['route-group'];
                            $classMenu = 'menu--active';
                        }
                        if(isset($menu['route']))
                        {
                            $route = $menu['route'];

                            if(Route::getCurrentRoute()->getName() == $menu['route'])
                                $classMenu = 'menu--active';
                        }
                    @endphp
                    <li>
                        <a href="{{ $route?route($route):'javascript:;' }}" class="menu {{ $classMenu }}">
                            <div class="menu__icon">
                                <i data-feather="{{ $menu['icon'] }}"></i>
                            </div>
                            <div class="menu__title">
                                {{ __($menu['title']) }}
                                @if (isset($menu['sub_menu']))
                                    <i data-feather="chevron-down" class="menu__sub-icon"></i>
                                @endif
                            </div>
                        </a>
                        @if (isset($menu['sub_menu']))
                            <ul class="{{ $routeGroup ? 'menu__sub-open' : '' }}">
                                @foreach ($menu['sub_menu'] as $subMenu)
                                    @php
                                        $route      = false;
                                        $routeGroup = false;
                                        $classMenu  = false;
                                        if(isset($subMenu['route-group']) && request()->is($subMenu['route-group'].'*'))
                                        {
                                            $routeGroup = $subMenu['route-group'];
                                            $classMenu = 'menu--active';
                                        }
                                        if(isset($subMenu['route']))
                                        {
                                            $route = $subMenu['route'];

                                            if(Route::getCurrentRoute()->getName() == $subMenu['route'])
                                                $classMenu = 'menu--active';
                                        }
                                    @endphp
                                    <li>
                                        <a href="{{ $route?route($route):'javascript:;' }}" class="menu {{ $classMenu }}">
                                            <div class="menu__icon">
                                                <i data-feather="{{$subMenu['icon']?$subMenu['icon']:'align-justify'}}"></i>
                                            </div>
                                            <div class="menu__title">
                                                {{ __($subMenu['title']) }}
                                                @if (isset($subMenu['sub_menu']))
                                                    <i data-feather="chevron-down" class="menu__sub-icon"></i>
                                                @endif
                                            </div>
                                        </a>
                                        @if (isset($subMenu['sub_menu']))
                                            <ul class="{{ $routeGroup ? 'menu__sub-open' : '' }}">
                                                @foreach ($subMenu['sub_menu'] as $lastSubMenu)
                                                    @php
                                                        $route      = false;
                                                        $routeGroup = false;
                                                        $classMenu  = false;
                                                        if(isset($lastSubMenu['route-group']) && request()->is($lastSubMenu['route-group'].'*'))
                                                        {
                                                            $routeGroup = $lastSubMenu['route-group'];
                                                            $classMenu = 'menu--active';
                                                        }
                                                        if(isset($lastSubMenu['route']))
                                                        {
                                                            $route = $lastSubMenu['route'];

                                                            if(Route::getCurrentRoute()->getName() == $lastSubMenu['route'])
                                                                $classMenu = 'menu menu--active';
                                                        }
                                                    @endphp
                                                    <li>
                                                        <a href="{{ $route?route($route):'javascript:;' }}" class="menu {{ $classMenu }}">
                                                            <div class="menu__icon">
                                                                <i data-feather="zap"></i>
                                                            </div>
                                                            <div class="menu__title">{{ __($lastSubMenu['title']) }}</div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
</div>
<!-- END: Mobile Menu -->
