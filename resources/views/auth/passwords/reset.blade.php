@extends('_layout.login')

@section('content')
    <!-- BEGIN: Login Form -->
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{__('Reset Password')}}</h2>

            @include('_inc.alertStatus')

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="intro-x mt-4">
                    <input id="input-email" name="email" type="email" class="intro-x login__input input input--lg border border-gray-300 block @error('email') border-theme-6 @enderror mt-4" placeholder="Email" value="{{ $email ?? old('email') }}" required>
                    @error('email')
                        <div id="error-email" class="email__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                    @enderror

                    <input id="input-password" name="password" type="password" class="intro-x login__input input input--lg border border-gray-300 block @error('password') border-theme-6 @enderror mt-4" placeholder="Password" value="" required>
                    @error('password')
                        <div id="error-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                    @enderror

                    <input id="password-password" name="password_confirmation" type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password Confirmation" value="" required>

                </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button id="btn-send" class="button button--lg w-full xl:w-100 text-white bg-theme-1 xl:mr-3 align-top">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
    <!-- END: Login Form -->
@endsection

@section('script')
    <script>
        cash(function ()
        {
            async function send()
            {
                // Reset state
                cash('#send-form').find('.input').removeClass('border-theme-6')
                cash('#send-form').find('.email__input-error').html('')

                // Post form
                let email = cash('#email').val()

                // Loading state
                cash('#btn-send').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                await helper.delay(1500)

                axios.post(`login`,
                {
                    email: email
                })
                .then(res =>{
                    //location.href = '/'
                    cash(`#input-email`).addClass('border-theme-9')
                    cash(`#error-email`).html(err.response.data.message)

                })
                .catch(err => {

                    cash('#btn-send').html('{{ __('Send Password Reset Link') }}')

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
                        cash(`#input-email`).addClass('border-theme-6')
                        cash(`#error-email`).html(err.response.data.message)
                    }
                })
            }

            cash('#btn-send').on('click', function()
            {
                send()
            })
        })
    </script>
@endsection
