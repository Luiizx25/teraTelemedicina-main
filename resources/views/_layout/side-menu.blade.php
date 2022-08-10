@extends('_layout/main')

@section('content')
    @include('_layout/components/mobile-menu')
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav @if($fullPage??false) side-nav--simple @endif">
            <a href="{{ route('home') }}" class="intro-x flex items-start pl-5 mt-5">
                <img class="w-10 mt-2" src="{{ asset('dist/images/logo.svg') }}">
                <span class=" @if($fullPage??false) hidden @else xl:block text-white ml-1 @endif">
                    <img alt="Sistema de Telemedicina da TeraTelemedicina" src="{{ asset('dist/images/teraTelemedicina.svg') }}">
                    @if (session()->get('profile'))
                        <p class="text-right">{{ __(session()->get('profile')) }}</p>
                    @endif
                </span>
            </a>
            <div class="my-6"></div>
            <ul>
                @if (session()->has('side-menu'))
                    @php
                        $breadCrumb = [];
                        $titleOnly  = false;
                    @endphp
                    @foreach (session('side-menu') as $menu)
                        @if ($menu == 'devider')
                            <li class="side-nav__devider my-6"></li>
                            @continue
                        @else
                            @php
                                $route      = false;
                                $routeGroup = false;
                                $classMenu  = false;

                                if(isset($menu['route-group']) && request()->is($menu['route-group'].'*'))
                                {
                                    $routeGroup = $menu['route-group'];
                                    $classMenu  = 'side-menu--active';

                                    if ($menu['titleOnly']??false)
                                    {
                                        $title = $menu['title'];
                                        $titleOnly = true;
                                        //continue;
                                    }

                                    $breadCrumb[] = ['title'=>$menu['title'],'route'=>false];
                                }

                                if(isset($menu['route']))
                                {
                                    $route = $menu['route'];


                                    if(Route::getCurrentRoute()->getName() == $menu['route'] || in_array(Route::getCurrentRoute()->getName(),$menu['inRoute']) || array_key_exists(Route::getCurrentRoute()->getName(),$menu['inRoute']))
                                    {
                                        $classMenu = 'side-menu--active';

                                        if ($menu['titleOnly']??false)
                                        {
                                            $title = $menu['title'];
                                            $titleOnly = true;
                                            //continue;
                                        }

                                        if(array_key_exists(Route::getCurrentRoute()->getName(),$menu['inRoute']))
                                        {
                                            foreach ($menu['inRoute'] as $key => $value)
                                            {
                                                if($key === Route::getCurrentRoute()->getName())
                                                {
                                                    $title = $value['title'];

                                                    if($value['titleOnly']??false)
                                                        $titleOnly = true;
                                                }
                                            }
                                        }

                                        $breadCrumb[] = ['title'=>$menu['title'],'route'=>$menu['route']];
                                    }
                                }
                            @endphp
                            <li>
                                <a href="{{ $route?route($route):'javascript:;' }}" class="side-menu {{ $classMenu }}">
                                    <div class="side-menu__icon">
                                        <i data-feather="{{$menu['icon']?$menu['icon']:'align-justify'}}"></i>
                                    </div>
                                    <div class="side-menu__title">
                                        {{ __($menu['title']) }}
                                        @if (isset($menu['sub_menu']))
                                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                                        @endif
                                    </div>
                                </a>
                                @if (isset($menu['sub_menu']))
                                    <ul class="{{ $routeGroup ? 'side-menu__sub-open' : '' }}">
                                        @foreach ($menu['sub_menu'] as $subMenu)
                                            @php
                                                $route      = false;
                                                $routeGroup = false;
                                                $classMenu  = false;


                                                if(isset($subMenu['route-group']) && request()->is($subMenu['route-group'].'*'))
                                                {
                                                    $routeGroup = $subMenu['route-group'];
                                                    $classMenu  = 'side-menu--active';
                                                    if ($subMenu['titleOnly']??false)
                                                    {
                                                        $title = $subMenu['title'];
                                                        $titleOnly = true;
                                                        //continue;
                                                    }
                                                    //
                                                    $breadCrumb[] = ['title'=>$subMenu['title'],'route'=>false];
                                                }

                                                if(isset($subMenu['route']))
                                                {
                                                    $route = $subMenu['route'];

                                                    if(Route::getCurrentRoute()->getName() == $subMenu['route'] || in_array(Route::getCurrentRoute()->getName(),$subMenu['inRoute']) || array_key_exists(Route::getCurrentRoute()->getName(),$subMenu['inRoute']))
                                                    {
                                                        $classMenu = 'side-menu--active';
                                                        if ($subMenu['titleOnly']??false)
                                                        {
                                                            $title = $subMenu['title'];
                                                            $titleOnly = true;
                                                            //continue;
                                                        }

                                                        if(array_key_exists(Route::getCurrentRoute()->getName(),$subMenu['inRoute']))
                                                        {
                                                            foreach ($subMenu['inRoute'] as $key => $value)
                                                            {
                                                                if($key === Route::getCurrentRoute()->getName())
                                                                {
                                                                    $title = $value['title'];

                                                                    if($value['titleOnly']??false)
                                                                        $titleOnly = true;
                                                                }
                                                            }
                                                        }
                                                        //
                                                        $breadCrumb[] = ['title'=>$subMenu['title'],'route'=>$subMenu['route']];
                                                    }
                                                }
                                            @endphp
                                            <li>
                                                <a href="{{ $route?route($route):'javascript:;' }}" class="side-menu {{ $classMenu }}">
                                                    <div class="side-menu__icon">
                                                        <i data-feather="{{$subMenu['icon']?$subMenu['icon']:'activity'}}"></i>
                                                    </div>
                                                    <div class="side-menu__title">
                                                        {{ __($subMenu['title']) }}
                                                        @if (isset($subMenu['sub_menu']))
                                                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                                                        @endif
                                                    </div>
                                                </a>
                                                @if (isset($subMenu['sub_menu']))
                                                    <ul class="{{ $routeGroup ? 'side-menu__sub-open' : '' }}">
                                                        @foreach ($subMenu['sub_menu'] as $lastSubMenu)
                                                            @php
                                                                $route      = false;
                                                                $routeGroup = false;
                                                                $classMenu  = false;

                                                                if(isset($lastSubMenu['route-group']) && request()->is($lastSubMenu['route-group'].'*'))
                                                                {
                                                                    $routeGroup = $lastSubMenu['route-group'];
                                                                    $classMenu = 'side-menu--active';
                                                                    if ($lastSubMenu['titleOnly']??false)
                                                                    {
                                                                        $title = $lastSubMenu['title'];
                                                                        $titleOnly = true;
                                                                        //continue;
                                                                    }
                                                                    //
                                                                    $breadCrumb[] = ['title'=>$lastSubMenu['title'],'route'=>false];
                                                                }

                                                                if(isset($lastSubMenu['route']))
                                                                {
                                                                    $route = $lastSubMenu['route'];
                                                                    if(Route::getCurrentRoute()->getName() == $lastSubMenu['route'] || in_array(Route::getCurrentRoute()->getName(),$lastSubMenu['inRoute']) || array_key_exists(Route::getCurrentRoute()->getName(),$lastSubMenu['inRoute']))
                                                                    {
                                                                        $classMenu = 'side-menu--active';
                                                                        if ($lastSubMenu['titleOnly']??false)
                                                                        {
                                                                            $title = $lastSubMenu['title'];
                                                                            $titleOnly = true;
                                                                            //continue;
                                                                        }
                                                                        //
                                                                        $breadCrumb[] = ['title'=>$lastSubMenu['title'],'route'=>$lastSubMenu['route']];
                                                                    }
                                                                }
                                                            @endphp
                                                            <li>
                                                                <a href="{{ $route?route($route):'javascript:;' }}" class="side-menu {{ $classMenu }}">
                                                                    <div class="side-menu__icon">
                                                                        <i data-feather="{{$lastSubMenu['icon']?$lastSubMenu['icon']:'zap'}}"></i>
                                                                    </div>
                                                                    <div class="side-menu__title">{{ __($lastSubMenu['title']) }}</div>
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
            <div class="mt-4 p-2 rounded bg-gray-100 text-gray-600">
                @if (session()->get('profile'))
                    <p class="truncate">{{ __(session()->get('profile')) }}</p>
                @endif
                <div class="font-medium truncate">{{ucwords(Auth::user()->name??false)}}</div>
                <div class="text-xs text-gray-500 truncate">{{Auth::user()->email??false}}</div>
            </div>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @include('_layout/components/top-bar')
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection
