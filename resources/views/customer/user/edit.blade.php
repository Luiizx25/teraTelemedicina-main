@extends('_layout.side-menu',[
    'title' => __('Customer User Edit'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Edit User')}}</h2>
        </div>
    </div>

    <div class="intro-y box p-2">
        <div class="relative flex items-between">
            <div class="mr-2">
                <div class="font-medium text-base">{{$customer->cus_name??'--'}}
                    @if ($customer->cus_name_company)
                        <div class="text-gray-600 text-sm">{{$customer->cus_name_company}}</div>
                    @endif
                </div>
                <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Customer')}} {{$customer->id}}</p>
            </div>
            <div class="ml-auto">
                <div class="w-16 h-16 image-cover">
                    @empty($customer->cus_logo)
                    <img class="rounded" src="{{asset('/app/images/default_profile.png')}}">
                    @else
                    <img class="rounded" src="{{asset('storage/' . $customer->cus_logo)}}">
                    @endempty
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 mt-3">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5">
            <div class="flex flex-1 p-4 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 flex-none image-fit relative">
                    @if ($user->photo)
                    <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('storage/'.$user->photo) }}">
                    @else
                    <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('app/images/default_profile.png') }}">
                    @endif
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 sm:whitespace-normal font-medium text-lg">{{ $user->name }}</div>
                    <div class="text-gray-600">{{ $user->email }}</div>
                </div>
            </div>
            <div class="flex flex-1 p-4 lg:mt-0 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 lg:pt-1">
                <div class="">
                    <div class="sm:whitespace-normal flex items-center mt-3">
                        <i data-feather="smartphone" class="w-4 h-4 mr-2"></i> {{ $user->phone_mobile??'--' }}
                    </div>
                    <div class="sm:whitespace-normal flex items-center mt-3">
                        <i data-feather="phone-call" class="w-4 h-4 mr-2"></i> {{ $user->phone??'--' }}
                    </div>
                </div>
            </div>
            <div class="flex flex-1 px-5 lg:mt-0">
                <div class="">
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Info -->

    <div class="grid grid-cols-12 gap-4">
        <div class="intro-y col-span-12 lg:col-span-9 sm:col-span-12">
            <form action="{{route('toManager.customerUser.update',['customerUser'=>$user->id])}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="cus_slug" value="{{$customer->cus_slug}}">
                <div class="intro-y box mt-3">
                    <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Identification')}}
                            </h2>
                        </div>
                    </div>
                    <div class="px-5 py-2">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-2 sm:col-span-2 md:col-span-2 lg:col-span-2">
                                <label class="mb-2">{{__('Active')}}</label>
                                <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                                    <option value="1" @if (old('active',$user->active) == 1) selected @endif>Sim</option>
                                    <option value="0" @if (old('active',$user->active) == 0) selected @endif>Não</option>
                                </select>
                                @error('active')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-10 sm:col-span-10 md:col-span-10 lg:col-span-4">
                                <label class="mb-2">{{__('Name')}}</label>
                                <input id="input_name" name="name" type="text" class="input w-full border col-span-4 @error('name') border-theme-6 @enderror" placeholder="{{__('Name')}}" value="{{old('name',$user->name)}}" required>
                                @error('name')
                                <div id="error-name" class="name__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-6">
                                <label class="mb-2">{{__('Email')}}</label>
                                <input id="input_email" name="email" type="email" class="input w-full border @error('email') border-theme-6 @enderror" placeholder="{{__('Email')}}" value="{{old('email',$user->email)}}" required>
                                @error('email')
                                <div id="error-email" class="email__input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-3">
                                <label class="mb-2">{{__('Phone Mobile')}}</label>
                                <input id="input_phone_mobile" name="phone_mobile" type="text" class="input w-full border @error('phone_mobile') border-theme-6 @enderror" placeholder="{{__('Phone Mobile')}}" value="{{old('phone_mobile',$user->phone_mobile)}}" required>
                                @error('phone_mobile')
                                <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-3">
                                <label class="mb-2">{{__('Phone')}}</label>
                                <input id="input_phone" name="phone" type="text" class="input w-full border @error('phone') border-theme-6 @enderror" placeholder="{{__('Phone')}}" value="{{old('phone',$user->phone)}}" required>
                                @error('phone')
                                <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>

                            <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-12">
                                <label class="mb-2 w-48">{{__('Profile')}}</label>
                                <div class="flex flex-col sm:flex-row mt-2">
                                    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0">
                                        <input type="checkbox" value="1" name="financial" class="input border mr-1" id="checkbox_financial" @if(old('financial',$user->customer->first()->pivot->financial)) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_financial"> <i data-feather="dollar-sign" class="w-4 h-4 mt-1 mr-1"></i>{{__('financial')}}</label>
                                    </div>
                                    {{-- <div class="flex items-center text-gray-700 mr-2">
                                        <input type="checkbox" value="1" name="manager" class="input border mr-1" id="checkbox_manager" @if(old('manager',$user->customer->first()->pivot->manager)) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_system"> <i data-feather="settings" class="w-4 h-4 mt-1 mr-1"></i>{{__('manager')}}</label>
                                    </div> --}}
                                    <div class="flex items-center text-gray-700 mr-2">
                                        <input type="checkbox" value="1" name="tecnical" class="input border mr-1" id="checkbox_tecnical" @if(old('tecnical',$user->customer->first()->pivot->tecnical)) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_system"> <i data-feather="activity" class="w-4 h-4 mt-1 mr-1"></i>{{__('tecnical')}}</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="grid grid-cols-12 gap-4 row-gap-5">
                            <div class="intro-y col-span-6 flex items-center text-left mt-5">
                                &#32
                            </div>
                            <div class="intro-y col-span-6 flex items-center justify-center sm:justify-end mt-5">
                                <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Edit')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
            <form action="{{route('toManager.customerUser.updatePwd',['customerUser'=>$user->id])}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="cus_slug" value="{{$customer->cus_slug}}">
                <div class="intro-y box mt-3">
                    <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">{{__('Reset Password')}}</h2>
                        </div>
                    </div>
                    <div class="px-5 py-2">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-12">
                                <label class="mb-2">{{__('Password')}}</label>
                                <input id="input_password" name="password" type="password" class="input w-full border col-span-4 @error('password') border-theme-6 @enderror" placeholder="{{__('Password')}}" required>
                                @error('password')
                                <div id="error-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror

                                @if (session('status_password'))
                                    <div class="w-full mb-4 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                        <span class="flex rounded-full bg-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
                                        <span class="font-semibold mr-2 text-left flex-auto">{{ session('status_password') }}</span>
                                    </div>
                                @endif

                            </div>
                            <div class="intro-y col-span-12">
                                <label class="mb-2">{{__('Password Confirm')}}</label>
                                <input id="input_password_confirmation" name="password_confirmation" type="password" class="input w-full border col-span-4 @error('password_confirmation') border-theme-6 @enderror" placeholder="{{__('Password Confirmation')}}" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 row-gap-5">
                            <div class="intro-y col-span-6 flex items-center text-left mt-5">
                                &#32
                            </div>
                            <div class="intro-y col-span-6 flex items-center justify-center sm:justify-end mt-5">
                                <button class="button w-auto justify-center block bg-theme-1 text-white ml-2">{{__('Reset')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    @endsection

    @section('script')
    <script>
        function validaSenha(){
            var senha = document.getElementById("input_password").value;

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

            if(senha.lenght>7){
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

<!-- -->
