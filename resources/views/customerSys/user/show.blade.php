@extends('_layout.side-menu',[
    'title' => __('User System'),
])

@section('subcontent')
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
            <div class="flex flex-1 mb-6 px-5 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                    @if ($user->photo)
                        <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('storage/'.$user->photo) }}">
                    @else
                        <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('app/images/default_profile.png') }}">
                    @endif
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 sm:whitespace-normal font-medium text-lg">{{ $user->name }}</div>
                    <div class="text-gray-600">{{ $user->email }}</div>
                    <div class="sm:whitespace-normal flex items-center mt-3">
                        <i data-feather="phone-call" class="w-4 h-4 mr-2"></i> {{ $user->phone??'--' }}
                    </div>
                    <div class="sm:whitespace-normal flex items-center mt-3">
                        <i data-feather="smartphone" class="w-4 h-4 mr-2"></i> {{ $user->phone_mobile??'--' }}
                    </div>
                </div>
            </div>
            <div class="flex flex-1 px-5 lg:mt-0 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 lg:pt-1">
                <div class="">
                    @empty($user->customersys->toArray())
                        <div class="w-100 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">Ops! {{__('User not associated with a system client')}}</p>
                                    <p class="text-sm">{{__('Contact your system administrator and make the request')}}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="sm:whitespace-normal font-medium text-lg">{{ $user->customersys->first()->csys_name??'--'  }}</div>
                        <div class="text-gray-600">{{ $user->customersys->first()->csys_email??'---'  }}</div>
                        <div class="sm:whitespace-normal flex items-center mt-3">{{ $user->customersys->first()->csys_phone??'---' }}</div>
                    @endempty
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

                    <form method="POST" action="{{ route('toManager.UserCustomerSys.update',['UserCustomerSy'=>$user->id]) }}" enctype="multipart/form-data">
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
                            <input id="input-name" name="name" type="text" class="input w-full border col-span-4 @error('name') border-theme-6 @enderror" placeholder="{{__('Name')}}" value="{{old('name', $user->name)}}" required>
                            @error('name')
                                <div id="error-name" class="name__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror

                            <div class="grid grid-cols-12 gap-2">

                                <div class="col-span-7 mt-4">
                                    <label>{{__('Email')}}</label>
                                    <input id="input-email" name="email" type="email" class="input w-full border @error('email') border-theme-6 @enderror" placeholder="{{__('Email')}}" value="{{old('email', $user->email)}}" required>
                                    @error('email')
                                    <div id="error-email" class="email__input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>

                                <div class="col-span-5 mt-4">
                                    <label>{{__('Date Birth')}}</label>
                                    <input id="input-date_birth" name="date_birth" type="date" class="input w-full border @error('date_birth') border-theme-6 @enderror" placeholder="{{__('Date Birth')}}" value="{{old('date_birth', ($user->date_birth?$user->date_birth->format('Y-m-d'):null))}}" required>
                                    @error('date_birth')
                                    <div id="error-date_birth" class="date_birth__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>

                            </div>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-6 mt-4">
                                    <label>{{__('Phone Mobile')}}</label>
                                    <input id="input-phone_mobile" name="phone_mobile" type="text" class="input w-full border @error('phone_mobile') border-theme-6 @enderror" placeholder="{{__('Phone Mobile')}}" value="{{old('phone_mobile', $user->phone_mobile)}}" required>
                                    @error('phone_mobile')
                                        <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                                <div class="col-span-6 mt-4">
                                    <label>{{__('Phone')}}</label>
                                    <input id="input-phone" name="phone" type="text" class="input w-full border @error('phone') border-theme-6 @enderror" placeholder="{{__('Phone')}}" value="{{old('phone', $user->phone)}}" required>
                                    @error('phone')
                                        <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                                <div class="col-span-12 mt-4">
                                    <label>{{__('Image Profile')}}</label>
                                    <input id="input-photo" name="photo" type="file" class="input w-full border @error('photo') border-theme-6 @enderror" placeholder="{{__('Photo')}}" value="{{old('photo', $user->photo)}}">
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
                                <input id="input-password" name="password" type="password" class="input w-full border col-span-4 @error('password') border-theme-6 @enderror" placeholder="{{__('New Password')}}" value="" required>
                                @error('password')
                                    <div id="error-current-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
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
