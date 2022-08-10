@extends('_layout.login')

@section('content')
    <!-- BEGIN: Login Form -->
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{__('Reset Password')}}</h2>

            @include('_inc.alertStatus')

            <form method="POST" action="{{ route('mandatory.reset') }}">
                @csrf
                <div class="intro-x mt-4">

                    <input id="input-password-old" name="old_password" type="password" class="intro-x login__input input input--lg border border-gray-300 block @error('old_password') border-theme-6 @enderror mt-4" placeholder="Password" value="" required>

                    <input id="input-password" name="password" type="password" class="intro-x login__input input input--lg border border-gray-300 block @error('password') border-theme-6 @enderror mt-4" placeholder="New Password" value="" onkeyup="validaSenha()" required>
                    @error('password')
                        <div id="error-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                    @enderror

                    <div id="validacao1" class="hidden">
                        Mínimo de 8 caracteres
                    </div>
                    <div id="validacao2" class="hidden">
                        Pelo menos um caracter minúsculo
                    </div>
                    <div id="validacao3" class="hidden">
                        Pelo menos um caracter maiúsculo
                    </div>
                    <div id="validacao4" class="hidden">
                        Pelo menos um numero
                    </div>
                    <div id="validacao5" class="hidden">
                        Pelo menos um caracter especial .;|@$!%?&
                    </div>

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

        function validaSenha(){
            var senha = document.getElementById("input-password").value;

            var minusculo = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
            var maiusculo = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
            var numero = ['0','1','2','3','4','5','6','7','8','9'];
            var especial = ['.',';','|','@','$','!','%','*','#','?','&'];

            var valida_minusculo = false;
            var valida_maiusculo = false;
            var valida_numero = false;
            var valida_especial = false;

            for(var i=0; i<senha.length; i++){
                if(minusculo.includes(senha[i])){
                    valida_minusculo = true;
                }
                else if(maiusculo.includes(senha[i])){
                    valida_maiusculo = true;
                }
                else if(numero.includes(senha[i])){
                    valida_numero = true;
                }
                else if(especial.includes(senha[i])){
                    valida_especial = true;
                }
            }
            
            if(senha.length>7){
                document.getElementById("validacao1").className = "hidden";
            }
            else{
                document.getElementById("validacao1").className = "text-theme-6 mt-1";
            }

            if(valida_minusculo){
                document.getElementById("validacao2").className = "hidden";
            }
            else{
                document.getElementById("validacao2").className = "text-theme-6 mt-1";
            }
            

            if(valida_maiusculo){
                document.getElementById("validacao3").className = "hidden";
            }
            else{
                document.getElementById("validacao3").className = "text-theme-6 mt-1";
            }


            if(valida_numero){
                document.getElementById("validacao4").className = "hidden";
            }
            else{
                document.getElementById("validacao4").className = "text-theme-6 mt-1";
            }


            if(valida_especial){
                document.getElementById("validacao5").className = "hidden";
            }
            else{
                document.getElementById("validacao5").className = "text-theme-6 mt-1";
            }

        }
    </script>
@endsection
