@extends('_layout.login')

@section('content')
    <!-- BEGIN: Login Form -->
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{ __('Verify Your Email Address') }}</h2>

            @if (session('resent'))
                <div class="p-2 bg-theme-12 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                    <span class="flex rounded-full bg-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">ATENÇÃO</span>
                    <span class="font-semibold mr-2 text-left flex-auto">{{ __('A fresh verification link has been sent to your email address.') }}</span>
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},

            <form id="send-form" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button id="btn-send" class="button button--lg w-full xl:w-100 text-white bg-theme-1 xl:mr-3 align-top">
                        {{ __('click here to request another') }}
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
