<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        @if(empty($breadCrumb) || $titleOnly??false || $titlePage??false)

            @if ($titlePage??false)
                <h2 class="text-2xl font-medium mr-auto">{{__($titlePage)}}</h2>
            @else
                <h2 class="text-2xl font-medium mr-auto">{{__($title??'')}}</h2>
            @endif
        @else
            <a href="{{route('toManager.dashboard')}}" class=""><i data-feather="home" class="breadcrumb__icon"></i></a>
            @foreach ($breadCrumb as $breadCrumbKey => $breadCrumbItem)
                <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                @if ($breadCrumbKey == array_key_last($breadCrumb))
                    <span class="breadcrumb--active">{{__($breadCrumbItem['title'])}}</span>
                @else
                    <span>{{__($breadCrumbItem['title'])}}</span>
                @endif
            @endforeach
        @endif
    </div>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6 all:hidden">
        <div class="search hidden sm:block">
            <input type="text" class="search__input input placeholder-theme-13" placeholder="Search...">
            <i data-feather="search" class="search__icon dark:text-gray-300"></i>
        </div>
        <a class="notification sm:hidden lg:hidden" href="">
            <i data-feather="search" class="notification__icon dark:text-gray-300"></i>
        </a>
        <div class="search-result hidden">
            <div class="search-result__content">
                <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a href="" class="flex items-center">
                        <div class="w-8 h-8 bg-theme-18 text-theme-9 flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-feather="inbox"></i>
                        </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-theme-17 text-theme-11 flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-feather="users"></i>
                        </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-feather="credit-card"></i>
                        </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
                <div class="search-result__content__title">Users</div>
                <div class="mb-5">
                    fakers
                </div>
                <div class="search-result__content__title">Products</div>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Image Profile" class="rounded-full" src="{{ asset('dist/images/default_profile.png') }}">
                        </div>
                        <div class="ml-3">PrductName</div>
                        <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">productsCategory</div>
                    </a>
            </div>
        </div>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    <div class="intro-x dropdown mr-auto sm:mr-6">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer">
            <i data-feather="bell" class="notification__icon dark:text-gray-300"></i>
        </div>
        <div class="notification-content pt-2 dropdown-box">
            <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
                <div class="notification-content__title">Notifications</div>

                    <div class="cursor-pointer relative flex items-center {{ 0 ? 'mt-5' : '' }}">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            @if (Auth::user()->photo??false)
                                <img alt="Image Profile" class="rounded-full" src="{{ asset('storage/'.Auth::user()->photo) }}">
                            @else
                                <img alt="Image Profile" class="rounded-full" src="{{ asset('app/images/default_profile.png') }}">
                            @endif
                            <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a href="javascript:;" class="font-medium truncate mr-5">userName</a>
                                <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">Times</div>
                            </div>
                            <div class="w-full truncate text-gray-600">short_content</div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            @if (Auth::user()->photo??false)
                <img alt="Image Profile" class="border-solid border border-gray-600 shadow rounded-full" src="{{ asset('storage/'.Auth::user()->photo) }}">
            @else
                <img alt="Image Profile" class="border-solid border border-gray-600 shadow rounded-full" src="{{ asset('app/images/default_profile.png') }}">
            @endif
        </div>
        <div class="dropdown-box w-56">
            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                    <div class="font-medium">{{ucwords(Auth::user()->name??false)}}</div>
                    <div class="text-xs text-theme-41 dark:text-gray-600 truncate">{{Auth::user()->email??false}}</div>
                </div>
                <div class="p-2">
                    <a href="{{route('profile.index')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="user" class="w-4 h-4 mr-2"></i> {{__('Profile')}}
                    </a>
                </div>
                @if (session()->get('profiles') && count(session()->get('profiles')) > 1)
                    <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                    @foreach (session()->get('profiles') as $profileKey => $profile)
                    <a href="{{route($profileKey.'.dashboard')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="{{ (session()->get('profile') == $profileKey)?'check-circle':'circle' }}" class="w-4 h-4 mr-2"></i> {{__($profileKey)}}
                    </a>
                    @endforeach
                    </div>
                @endif
                <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                    <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"><i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>

<!-- PZN - ALERTS -->
@if (env('APP_DEBUG'))
    @if ($errors->any())
        @foreach ($errors->all() as $key => $error)
            <!-- PZN ERROR - {{ $key . ' = ' . $error }} -->
        @endforeach
    @endif
@endif
<!-- PZN - ALERTS -->
@if (session('status'))
<div class="w-full mt-2 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-9 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status')) }}</span>
</div>
@endif
@if (session('status_success'))
<div class="w-full mt-2 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-9 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_success')) }}</span>
</div>
@endif
@if (session('status_warning'))
<div class="w-full mt-2 p-2 bg-theme-1 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_warning')) }}</span>
</div>
@endif
@if (session('status_error'))
<div class="w-full mt-2 p-2 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
</div>
@endif
<!-- -->
@if (session('status_update_success'))
<div class="w-full mt-2 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-9 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_update_success')) }}</span>
</div>
@endif
@if (session('status_update_warning'))
<div class="w-full mt-2 p-2 bg-theme-1 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_update_warning')) }}</span>
</div>
@endif
@if (session('status_update_error'))
<div class="w-full mt-2 p-2 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_update_error')) }}</span>
</div>
@endif
<!-- END:ALERTS -->

<!-- END: Top Bar -->
