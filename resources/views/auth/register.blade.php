@extends('_layout.login',[
    'title' => 'Register Account',
    'useJquery' => true,
    'useInputmask' => true,
])

@section('content')
    <!-- BEGIN: Login Form -->
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">

            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{__('Sign Up')}}</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="intro-x mt-8">
                    <div class="grid grid-cols-12 gap-2">
                        <input id="name" name="name" type="text" class="intro-x input input--lg border border-gray-300 block @error('name') border-theme-6 @enderror col-span-10 lg:col-span-10 sm:col-span-12" value="{{ old('name') }}" placeholder="{{__('Full Name')}}" autocomplete="name" autofocus required>
                        @error('name')
                            <div id="error-name" class="login__input-error w-5/6 text-theme-6 mt-2 col-span-10 lg:col-span-10 sm:col-span-12"><strong>{{ __($message) }}</strong></div>
                        @enderror

                    </div>
                    <div class="grid grid-cols-12 gap-2">

                        <input id="email" name="email" type="email" class="intro-x input input--lg border border-gray-300 block @error('email') border-theme-6 @enderror mt-4 col-span-10 lg:col-span-10 sm:col-span-12" placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div id="error-email" class="login__input-error w-5/6 text-theme-6 mt-2 col-span-10 lg:col-span-10 sm:col-span-12"><strong>{{ __($message) }}</strong></div>
                        @enderror

                    </div>
                    <div class="grid grid-cols-12 gap-2">

                        <input id="phone_mobile" name="phone_mobile" type="text" class="intro-x input input--lg border border-gray-300 block @error('phone_mobile') border-theme-6 @enderror mt-4 col-span-5 lg:col-span-5 sm:col-span-12" placeholder="{{__('Mobile')}}" value="{{ old('phone_mobile') }}" required>
                        @error('phone_mobile')
                            <div id="error-phone_mobile" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2 col-span-5 lg:col-span-5 sm:col-span-12"><strong>{{ __($message) }}</strong></div>
                        @enderror

                        <input id="phone" name="phone" type="text" class="intro-x input input--lg border border-gray-300 block @error('phone') border-theme-6 @enderror mt-4 col-span-5 lg:col-span-5 sm:col-span-12" placeholder="{{__('Phone')}}" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div id="error-phone_mobile" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2 col-span-5 lg:col-span-5 sm:col-span-12"><strong>{{ __($message) }}</strong></div>
                        @enderror

                    </div>
                    <div class="grid grid-cols-12 gap-2">
                        <input id="password" name="password" type="password" class="intro-x input input--lg border border-gray-300 block @error('password') border-theme-6 @enderror mt-4 col-span-5 lg:col-span-5 sm:col-span-12" placeholder="{{__('Password')}}" value="" required>
                        <input id="password-password" name="password_confirmation" type="password" class="intro-x input input--lg border border-gray-300 block mt-4 col-span-5 lg:col-span-5 sm:col-span-12" placeholder="{{__('Password Confirm')}}" value="" required>
                        @error('password')
                            <div id="error-password" class="login__input-error w-5/6 text-theme-6 mt-2 col-span-12 lg:col-span-12 sm:col-span-12"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                </div>
                <div class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm">
                    <input type="checkbox" class="input border mr-2" id="remember-me" required>
                    <label class="cursor-pointer select-none" for="remember-me">{{__('I agree the')}} </label>
                    <a class="text-theme-1 dark:text-theme-10 ml-1" href="">{{__('Privacy Policy')}}</a>.
                </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">{{__('Register')}}</button>
                    {{__('or')}} <a href="{{route('login')}}" class="text-theme-1 dark:text-theme-10 ml-1">{{__('Login')}}</a>
                </div>
            </form>

            <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
                {{__('By signin up, you agree to our')}}<br/><a class="text-theme-1 dark:text-theme-10" href="">{{__('Terms and Conditions')}}</a> {{__('&')}} <a class="text-theme-1 dark:text-theme-10" href="">{{__('Privacy Policy')}}</a>
            </div>
        </div>
    </div>
    <!-- END: Login Form -->
@endsection
@section('script')
    <script>
        jQuery(document).ready(function()
        {
            phone.mask('#phone');
            mobile.mask('#phone_mobile');
        });
    </script>
@endsection
