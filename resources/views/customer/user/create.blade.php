@extends('_layout.side-menu',[
    'title' => __('Customer User Create'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('New User')}}</h2>
        </div>
    </div>
    <div class="intro-y box p-2">
        <div class="relative flex items-between">
            <div class="mr-2">
                <div class="font-medium text-base">{{$customer->cus_name??'--'}}
                    @if ($customer->cus_name_company)
                        <p class="text-gray-600 text-sm">{{$customer->cus_name_company}}</p>
                    @endif
                </div>
                <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Customer')}} {{$customer->id}}</span>
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

    <form action="{{route('toManager.customerUser.store')}}" method="post">
        @csrf
        <input type="hidden" name="cus_slug" value="{{$customer->cus_slug}}">
        <div class="intro-y box mt-3">
            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('User Identification')}}
                    </h2>
                </div>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-2">
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <label class="mb-2">{{__('Active')}}</label>
                        <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                            <option value="" selected>--</option>
                            <option value="1" @if (old('active') == 1) selected @endif>Sim</option>
                            <option value="0" @if (old('active') == 0) selected @endif>Não</option>
                        </select>
                        @error('active')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-5 sm:col-span-12">
                        <label class="mb-2">{{__('Name')}}</label>
                        <input id="input_name" name="name" type="text" class="input w-full border col-span-4 @error('name') border-theme-6 @enderror" placeholder="{{__('Name')}}" value="{{old('name')}}" required>
                        @error('name')
                        <div id="error-name" class="name__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <label class="mb-2">{{__('Email')}}</label>
                        <input id="input_email" name="email" type="email" class="input w-full border @error('email') border-theme-6 @enderror" placeholder="{{__('Email')}}" value="{{old('email')}}" required>
                        @error('email')
                        <div id="error-email" class="email__input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-2 mt-4">
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <label class="mb-2">{{__('Mobile')}}</label>
                        <input id="input_phone_mobile" name="phone_mobile" type="text" class="input w-full border @error('phone_mobile') border-theme-6 @enderror" placeholder="{{__('Phone Mobile')}}" value="{{old('phone_mobile')}}" required>
                        @error('phone_mobile')
                        <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <label class="mb-2">{{__('Phone')}}</label>
                        <input id="input_phone" name="phone" type="text" class="input w-full border @error('phone') border-theme-6 @enderror" placeholder="{{__('Phone')}}" value="{{old('phone')}}">
                        @error('phone')
                        <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <label class="mb-2">{{__('Password')}}</label>
                        <input id="input_password" name="password" type="password" class="input w-full border col-span-4 @error('password') border-theme-6 @enderror" placeholder="{{__('New Password')}}" value="" required>
                        @error('password')
                            <div id="error-current-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <label class="mb-2">{{__('Confirm Password')}}</label>
                        <input id="input_password-confirmation" name="password_confirmation" type="password" class="input w-full border col-span-4" placeholder="{{__('Confirm New Password')}}" value="" required>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-2 mt-4">
                    <div class="intro-y col-span-12 lg:col-span-12 sm:col-span-12">
                        <label class="mb-2 w-48">{{__('Profile')}}</label>
                        <div class="flex flex-col sm:flex-row mt-2">
                            <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0">
                                <input type="checkbox" value="1" name="financial" class="input border mr-2" id="checkbox_admin_financial">
                                <label class="flex cursor-pointer select-none" for="checkbox_admin_financial"> <i data-feather="dollar-sign" class="w-4 h-4 mt-1 mr-1"></i>{{__('financial')}}</label>
                            </div>
                            {{-- <div class="flex items-center text-gray-700 mr-2">
                                <input type="checkbox" value="1" name="manager" class="input border mr-2" id="checkbox_admin_system">
                                <label class="flex cursor-pointer select-none" for="checkbox_admin_system"> <i data-feather="settings" class="w-4 h-4 mt-1 mr-1"></i>{{__('manager')}}</label>
                            </div> --}}
                            <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0">
                                <input type="checkbox" value="1" name="tecnical" class="input border mr-2" id="checkbox_admin_customer">
                                <label class="flex cursor-pointer select-none" for="checkbox_admin_customer"> <i data-feather="activity" class="w-4 h-4 mt-1 mr-1"></i>{{__('tecnical')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 row-gap-5">
                    <div class="intro-y col-span-6 flex items-center text-left mt-5">
                        &#32
                    </div>
                    <div class="intro-y col-span-6 flex items-center justify-center sm:justify-end mt-5">
                        <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Create')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        mobile.mask(input_phone_mobile);
        phone.mask(input_phone);
    </script>
@endsection
