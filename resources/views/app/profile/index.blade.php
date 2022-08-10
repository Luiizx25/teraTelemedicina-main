@extends('_layout.side-menu',[
    'title' => __('Profile'),
    'useJquery' => true,
    'useDataTable' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
            <div class="flex flex-1 p-2 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 ml-5 flex-none lg:w-32 lg:h-32 image-fit relative">
                    @if (Auth::user()->photo)
                        <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow-xl rounded-full" src="{{ asset('storage/'.Auth::user()->photo) }}">
                    @else
                        <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow-xl rounded-full" src="{{ asset('app/images/default_profile.png') }}">
                    @endif
                </div>
                <div class="ml-5">
                    <div class="w-auto sm:w-auto sm:whitespace-normal font-medium text-lg" title="ID: {{Auth::user()->id}}">{{ Auth::user()->name??'--' }}</div>
                    <div class="text-gray-600">{{ Auth::user()->email??'--' }}</div>
                    <div class="sm:whitespace-normal flex items-center mt-2">
                        <i data-feather="smartphone" class="w-4 h-4 mr-2"></i> {{ Auth()->user()->phone_mobile??'--' }}
                    </div>
                    <div class="sm:whitespace-normal flex items-center mt-2">
                        <i data-feather="phone-call" class="w-4 h-4 mr-2"></i> {{ Auth()->user()->phone??'--' }}
                    </div>
                </div>
            </div>
            <div class="flex flex-1 py-2 px-5 lg:mt-0 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 lg:pt-1 justify-center">
                <div class="mt-5">
                    @if(!session()->has('customer-sys'))
                        <div class="w-full bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1 flex">
                                    <i data-feather="alert-circle" class="h-6 w-6 text-teal-500 mr-4"></i>
                                <div>
                                    <p class="font-bold">Ops! {{__('User not associated with a system client')}}</p>
                                    <p class="text-sm">{{__('Contact your system administrator and make the request')}}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $customerSys = session()->get('customer-sys');
                        @endphp
                        <div class="sm:whitespace-normal font-medium text-lg">{{ $customerSys->csys_name??'--'  }}</div>
                        <div class="text-gray-600">{{ $customerSys->csys_email??'---'  }}</div>
                        <div class="sm:whitespace-normal flex items-center mt-2">
                            <i data-feather="phone-call" class="w-4 h-4 mr-2"></i> {{ $customerSys->csys_phone??'---' }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Info -->

    <div class="tab-content mt-5">
        <div class="tab-content__pane active" id="profile">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN:  Edite Profile -->
                <div class="intro-y box col-span-12 lg:col-span-6">

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">{{__('Edit Profile')}}</h2>
                            <div class="intro-x text-center xl:text-left">
                                <button id="btn-send" class="button button--sm w-100 xl:w-100 text-white bg-theme-1 xl:mr-3 align-top">
                                    {{ __('Change') }}
                                </button>
                            </div>
                        </div>
                        <div class="p-5">

                            @if (session('status'))
                                <div class="w-full mb-4 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                    <span class="flex rounded-full bg-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
                                    <span class="font-semibold mr-2 text-left flex-auto">{{ session('status') }}</span>
                                </div>
                            @endif

                            <label>{{__('Name')}}</label>
                            <input id="input-name" name="name" type="text" class="input w-full border col-span-4 @error('name') border-theme-6 @enderror" placeholder="{{__('Name')}}" value="{{old('name', auth()->user()->name)}}" required>
                            @error('name')
                                <div id="error-name" class="name__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror

                            <div class="grid grid-cols-12 gap-2">

                                <div class="col-span-12 lg:col-span-7 sm:col-span-12 mt-4">
                                    <label>{{__('Email')}}</label>
                                    <input id="input-email" name="email" type="email" class="input w-full border @error('email') border-theme-6 @enderror" placeholder="{{__('Email')}}" value="{{old('email', auth()->user()->email)}}" required>
                                    @error('email')
                                    <div id="error-email" class="email__input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>

                                <div class="col-span-12 lg:col-span-5 sm:col-span-12 mt-4">
                                    <label>{{__('Date Birth')}}</label>
                                    <input id="input-date_birth" name="date_birth" type="date" class="input w-full border @error('date_birth') border-theme-6 @enderror" placeholder="{{__('Date Birth')}}" value="{{old('date_birth', (auth()->user()->date_birth?auth()->user()->date_birth->format('Y-m-d'):null))}}" required>
                                    @error('date_birth')
                                    <div id="error-date_birth" class="date_birth__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>

                            </div>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-6 mt-4">
                                    <label>{{__('Mobile')}}</label>
                                    <input id="input_phone_mobile" name="phone_mobile" type="text" class="input w-full border @error('phone_mobile') border-theme-6 @enderror" placeholder="{{__('Phone Mobile')}}" value="{{old('phone_mobile', auth()->user()->phone_mobile)}}" required>
                                    @error('phone_mobile')
                                        <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                                <div class="col-span-6 mt-4">
                                    <label>{{__('Phone')}}</label>
                                    <input id="input_phone" name="phone" type="text" class="input w-full border @error('phone') border-theme-6 @enderror" placeholder="{{__('Phone')}}" value="{{old('phone', auth()->user()->phone)}}" required>
                                    @error('phone')
                                        <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                                <div class="col-span-12 mt-4">
                                    <label>{{__('Image Profile')}}</label>
                                    <input id="input-photo" name="photo" type="file" class="input w-full border @error('photo') border-theme-6 @enderror" placeholder="{{__('Photo')}}" value="{{old('photo', auth()->user()->photo)}}">
                                    @error('photo')
                                        <div id="error-name" class="photo_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END: Edite Profile -->
                <!-- BEGIN:  Change Password -->
                <div class="intro-y box col-span-12 lg:col-span-6">

                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('put')
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">{{__('Change Password')}}</h2>
                            <div class="intro-x text-center xl:text-left">
                                <button id="btn-send" class="button button--sm w-full xl:w-100 text-white bg-theme-1 xl:mr-3 align-top">
                                    {{ __('Change') }}
                                </button>
                            </div>
                        </div>
                        <div class="p-5">

                            @if (session('status_password'))
                                <div class="w-full mb-4 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                    <span class="flex rounded-full bg-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
                                    <span class="font-semibold mr-2 text-left flex-auto">{{ session('status_password') }}</span>
                                </div>
                            @endif

                            <div>
                                <label>{{__('Current Password')}}</label>
                                <input id="input-current-password" name="old_password" type="password" class="input w-full border col-span-4 @error('current-password') border-theme-6 @enderror" placeholder="{{__('Password')}}" value="" required>
                                @error('old_password')
                                    <div id="error-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label>{{__('New Password')}}</label>
                                <input id="input-password" name="password" type="password" class="input w-full border col-span-4 @error('password') border-theme-6 @enderror" placeholder="{{__('New Password')}}" value="" onkeyup="validaSenha()" required>
                                @error('password')
                                    <div id="error-current-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>

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

                            <div class="mt-4">
                                <label>{{__('Confirm new Password')}}</label>
                                <input id="input-password-confirmation" name="password_confirmation" type="password" class="input w-full border col-span-4" placeholder="{{__('Confirm New Password')}}" value="" required>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- END: Change Password -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

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

        mobile.mask(input_phone_mobile);
        phone.mask(input_phone);
    </script>
@endsection
