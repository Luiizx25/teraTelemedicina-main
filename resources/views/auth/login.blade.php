@extends('_layout.login')

@section('content')
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{__('Be Welcome')}}</h2>
                    <div class="intro-x mt-2">
                        <form id="login-form">
                            <input type="text" id="input-email" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email">
                            <div id="error-email" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                            <input type="password" id="input-password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
                            <div id="error-password" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                        </form>
                    </div>
                    <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                        <div class="intro-x mt-2 text-center xl:text-left mr-auto">
                            <button id="btn-login" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">{{__('Login')}}</button>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                        @endif
                    </div>
                    <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
                        {{__('By signin up, you agree to our')}} <br> <a class="text-theme-1 dark:text-theme-10" href="https://teratelemedicina.com.br/politica-de-privacidade-2/">{{__('Terms and Conditions')}}</a> {{__('&')}} <a class="text-theme-1 dark:text-theme-10" href="https://teratelemedicina.com.br/politica-de-privacidade-2/">{{__('Privacy Policy')}}</a>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
@endsection

@section('script')
    <script>
        cash(function ()
        {
            async function login()
            {
                // Reset state
                cash('#login-form').find('.input').removeClass('border-theme-6')
                cash('#login-form').find('.login__input-error').html('')

                // Post form
                let email = cash('#input-email').val()
                let password = cash('#input-password').val()
                //let rememberMe = cash('#input-remember-me').val()
                let rememberMe = false;

                //
                // console.log('email: '+email);
                // console.log('password: '+password);
                // console.log('remember_me: '+rememberMe);

                // Loading state
                cash('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                await helper.delay(1500)

                axios.post(`login`,
                {
                    email: email,
                    password: password,
                    remember_me: rememberMe
                })
                .then(res =>{
                    location.href = '/'
                })
                .catch(err => {

                    console.error(err);

                    cash('#btn-login').html('Login')

                    if (err.response.data.message != 'Wrong email or password.')
                    {
                        for (const [key, val] of Object.entries(err.response.data.errors))
                        {
                            cash(`#input-${key}`).addClass('border-theme-6')
                            cash(`#error-${key}`).html(val)
                        }
                    }
                    else
                    {
                        cash(`#input-password`).addClass('border-theme-6')
                        cash(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            cash('#login-form').on('keyup', function(e)
            {
                if (e.keyCode === 13)
                {
                    login()
                }
            })

            cash('#btn-login').on('click', function()
            {
                login()
            })
        })
    </script>
@endsection
