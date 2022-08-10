@extends('_layout.side-menu',[
    'title' => __('System User Change'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')

    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 mt-4">
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
                <div class="mt-4">
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
        <div class="intro-y col-span-12 lg:col-span-12 sm:col-span-12">
            <form action="{{route('toManager.UserCustomerSys.update',['UserCustomerSy'=>$user->id])}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="intro-y box mt-4">
                    <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Identification')}}
                            </h2>
                        </div>
                    </div>
                    <div class="px-5 py-2">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-2 sm:col-span-2 md:col-span-2 lg:col-span-1">
                                <label class="mb-2">{{__('Active')}}</label>
                                <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                                    <option value="1" @if (old('active',$user->active) == 1) selected @endif>Sim</option>
                                    <option value="0" @if (old('active',$user->active) == 0) selected @endif>Não</option>
                                </select>
                                @error('active')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-10 sm:col-span-10 md:col-span-10 lg:col-span-2">
                                <label class="mb-2">{{__('Name')}}</label>
                                <input id="input_name" name="name" type="text" class="input w-full border col-span-4 @error('name') border-theme-6 @enderror" placeholder="{{__('Name')}}" value="{{old('name',$user->name)}}" required>
                                @error('name')
                                <div id="error-name" class="name__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-3">
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
                                <label class="mb-2 w-48">{{__('Admin Permissions')}}</label>
                                <div class="flex flex-col sm:flex-row mt-2">
                                    <div class="flex items-center text-gray-700 mr-2 w-40"> <input type="checkbox" value="1" name="admin_system" class="input border mr-2" id="checkbox_admin_system" @if($user->admin_system) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_system"> <i data-feather="settings" class="w-4 h-4 mr-1"></i>{{__('system')}}</label>
                                    </div>
                                    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0 w-40"> <input type="checkbox" value="1" name="admin_customer" class="input border mr-2" id="checkbox_admin_customer" @if($user->admin_customer) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_customer"> <i data-feather="briefcase" class="w-4 h-4 mr-1"></i>{{__('customers')}}</label>
                                    </div>
                                    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0 w-40"> <input type="checkbox" value="1" name="admin_provider" class="input border mr-2" id="checkbox_admin_provider" @if($user->admin_provider) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_provider"> <i data-feather="pen-tool" class="w-4 h-4 mr-1"></i>{{__('providers')}}</label>
                                    </div>
                                    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0 w-40"> <input type="checkbox" value="1" name="admin_patient" class="input border mr-2" id="checkbox_admin_patient" @if($user->admin_patient) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_patient"> <i data-feather="smile" class="w-4 h-4 mr-1"></i>{{__('patients')}}</label>
                                    </div>
                                    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0 w-40"> <input type="checkbox" value="1" name="admin_financial" class="input border mr-2" id="checkbox_admin_financial" @if($user->admin_financial) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_financial"> <i data-feather="dollar-sign" class="w-4 h-4 mr-1"></i>{{__('financial')}}</label>
                                    </div>
                                    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0 w-40"> <input type="checkbox" value="1" name="admin_billing" class="input border mr-2" id="checkbox_admin_billing" @if($user->admin_billing) checked @endif>
                                        <label class="flex cursor-pointer select-none" for="checkbox_admin_billing"> <i data-feather="zap" class="w-4 h-4 mr-1"></i>{{__('billing')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 row-gap-5">
                            <div class="intro-y col-span-6 flex items-center text-left py-4">
                                &#32
                            </div>
                            <div class="intro-y col-span-6 flex items-center justify-center sm:justify-end py-4">
                                <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Change')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="intro-y col-span-12 lg:col-span-12 sm:col-span-12">
            <form action="{{route('toManager.UserCustomerSys.updatePwd',['UserCustomerSys'=>$user->id])}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="intro-y box mt-4 pb-4">
                    <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">{{__('Reset Password')}}</h2>
                        </div>
                        @if (session('status_password'))
                            <div class="w-full mb-4 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                <span class="flex rounded-full bg-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
                                <span class="font-semibold mr-2 text-left flex-auto">{{ session('status_password') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="px-5 py-2">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-4">
                                <label class="mb-2">{{__('Password')}}</label>
                                <input id="input_password" name="password" type="password" class="input w-full border col-span-4 @error('password') border-theme-6 @enderror" placeholder="{{__('Password')}}" required>
                                @error('password')
                                <div id="error-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-4">
                                <label class="mb-2">{{__('Password Confirm')}}</label>
                                <input id="input_password_confirmation" name="password_confirmation" type="password" class="input w-full border col-span-4 @error('password_confirmation') border-theme-6 @enderror" placeholder="{{__('Repeat the Password')}}" required>
                            </div>
                            <div class="intro-y col-span-4 flex items-center justify-center sm:justify-end mt-5">
                                <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Reset')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        mobile.mask(input_phone_mobile);
        phone.mask(input_phone);
        </script>
@endsection

<!-- -->
