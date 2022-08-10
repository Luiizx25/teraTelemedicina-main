@extends('_layout.side-menu',[
    'title' => __('Provider'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Change Provider')}}</h2>
        </div>
    </div>

    <!-- BEGIN: Profile Info -->
    <div class="intro-y box">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5">

            <div class="flex flex-1 px-4 py-2 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 flex-none image-fit relative">
                    @if ($provider->user->photo)
                        <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('storage/'.$provider->user->photo) }}">
                    @else
                        <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('app/images/default_profile.png') }}">
                    @endif
                </div>
                <div class="ml-5">
                    <div class="w-auto sm:whitespace-normal font-medium text-lg">{{ $provider->user->name }}</div>
                    <p class="text-gray-600">{{ strtoupper($provider->pvd_identity_type??'--') }}: {{ $provider->pvd_identity_num??'--' }}/{{ $provider->pvd_identity_uf??'--' }}</p>
                    <p class="text-gray-600">{{ $provider->type->ref_description??'--' }} - {{ $provider->specialty->ref_description??'--' }}</p>
                </div>
            </div>

            <div class="flex flex-1 px-4 py-2 justify-center lg:justify-start lg:mt-0 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 lg:pt-1">
                <div class="mt-2">
                    <div class=""><a href="mailto:{{ $provider->user->email }}">{{ $provider->user->email }}</a></div>
                    <div class="sm:whitespace-normal flex items-center mt-1">
                        <i data-feather="smartphone" class="w-4 h-4 mr-2"></i> {{ $provider->user->phone_mobile??'--' }}
                    </div>
                    <div class="sm:whitespace-normal flex items-center mt-1">
                        <i data-feather="phone-call" class="w-4 h-4 mr-2"></i> {{ $provider->user->phone??'--' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Info -->

    <div class="grid grid-cols-12 gap-2 mt-2">
        <div class="intro-y col-span-12 lg:col-span-12 sm:col-span-12">
            <form action="{{route('toManager.provider.update',['provider'=>$provider->pvd_slug])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" value="{{$provider->user_id}}">

                <div class="intro-y box mt-2">
                    <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Identification')}}
                            </h2>
                        </div>
                    </div>
                    <div class="px-5 py-2">
                        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-2">
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                                <div class="mb-2">* {{__('Type')}}</div>
                                <select id="type_id" name="type_id" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                                    @foreach ($RefProviderType as $item)
                                        <option value="{{ $item->id }}" @if (old('type_id',$provider->type_id) == $item->id) selected @endif>{{ $item->ref_description }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                                <div class="mb-2">* {{__('Specialty')}}</div>
                                <select id="specialty_id" name="specialty_id" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                                    @foreach ($RefProviderSpecialty as $item)
                                        <option value="{{ $item->id }}" @if (old('specialty_id',$provider->specialty_id) == $item->id) selected @endif>{{ $item->ref_description }}</option>
                                    @endforeach
                                </select>
                                @error('specialty_id')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                                <div class="mb-2">* {{__('Document Type')}}</div>
                                <select id="pvd_doc_type" name="pvd_doc_type" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                                    @foreach ($RefDocTypePvd as $item)
                                        <option value="{{ $item->ref_slug }}" @if (old('pvd_doc_type',$provider->pvd_doc_type) == $item->ref_slug) selected @endif>{{ $item->ref_description }}</option>
                                    @endforeach
                                </select>
                                @error('pvd_doc_type')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                                <div class="mb-2">* {{__('Document Number')}}</div>
                                <input id="pvd_doc_num" name="pvd_doc_num" value="{{ old('pvd_doc_num',$provider->pvd_doc_num) }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" disabled="true" aria-required111="" required111>
                                @error('pvd_doc_num')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                                <div class="mb-2">* {{__('Identity Type')}}</div>
                                <select id="pvd_identity_type" name="pvd_identity_type" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                                    @foreach ($RefIdentityTypePvd as $item)
                                        <option value="{{ $item->ref_slug }}" @if (old('pvd_identity_type',$provider->pvd_identity_type) == $item->ref_slug) selected @endif>{{ $item->ref_description }}</option>
                                    @endforeach
                                </select>
                                @error('pvd_identity_type')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                                <div class="mb-2">* {{__('Identity UF')}}</div>
                                <select id="pvd_identity_uf" name="pvd_identity_uf" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                                    @foreach ($ListUf as $item)
                                        <option value="{{ $item->ref_description }}" @if (old('pvd_identity_uf',$provider->pvd_identity_uf) == $item->ref_slug) selected @endif>{{ $item->ref_description }}</option>
                                    @endforeach
                                </select>
                                @error('pvd_identity_uf')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                                <div class="mb-2">* {{__('Identity Number')}}</div>
                                <input id="pvd_identity_num" name="pvd_identity_num" value="{{ old('pvd_identity_num',$provider->pvd_identity_num) }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" disabled="true" aria-required111="" required111>
                                @error('pvd_identity_num')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                                <div class="mb-2">* {{__('Name')}}</div>
                                <input id="name" name="name" value="{{ old('name',$provider->user->name) }}" type="text" class="input order-none sm:order-3 w-full border flex-1" placeholder="" disabled="true" aria-required111="" required111>
                                @error('name')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                                <div class="mb-2">* {{__('Name Company')}}</div>
                                <input id="pvd_name_company" name="pvd_name_company" value="{{ old('pvd_name_company',$provider->pvd_name_company) }}" type="text" class="input order-none order-none sm:order-4 w-full border flex-1" placeholder="" disabled="true">
                                @error('pvd_name_company')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-6">
                                <div class="mb-2">* {{__('Email')}}</div>
                                <input id="email" name="email" value="{{ old('email',$provider->user->email) }}" type="email" class="input order-none sm:order-6 w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('email')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                                <div class="mb-2">* {{__('Phone')}}</div>
                                <input id="input_phone" name="phone" value="{{ old('phone',$provider->user->phone) }}" type="text" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('phone')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                                <div class="mb-2">* {{__('Mobile')}}</div>
                                <input id="input_phone_mobile" name="phone_mobile" value="{{ old('phone_mobile',$provider->user->phone_mobile) }}" type="text" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('phone_mobile')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                        </div>

                        <div class="font-medium text-base mt-5">{{__('Address')}}</div>
                        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                            <div class="intro-y col-span-12 lg:col-span-5 sm:col-span-12">
                                <div class="mb-2">* {{__('Street')}}</div>
                                <input id="pvd_street" name="pvd_street" value="{{ old('pvd_street',$provider->pvd_street) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('pvd_street')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-12">
                                <div class="mb-2">* {{__('Number')}}</div>
                                <input id="pvd_street_num" name="pvd_street_num" value="{{ old('pvd_street_num',$provider->pvd_street_num) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('pvd_street_num')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                                <div class="mb-2">{{__('Complement')}}</div>
                                <input id="pvd_street_complement" name="pvd_street_complement" value="{{ old('pvd_street_complement',$provider->pvd_street_complement) }}" type="text" class="input w-full border flex-1" placeholder="">
                                @error('pvd_street_complement')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                                <div class="mb-2">* {{__('Neighborhood')}}</div>
                                <input id="pvd_neighborhood" name="pvd_neighborhood" value="{{ old('pvd_neighborhood',$provider->pvd_neighborhood) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('pvd_neighborhood')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                                <div class="mb-2">* {{__('City')}}</div>
                                <input id="pvd_city" name="pvd_city" value="{{ old('pvd_city',$provider->pvd_city) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('pvd_city')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                                <div class="mb-2">* {{__('State')}}</div>
                                <input id="pvd_state" name="pvd_state" value="{{ old('pvd_state',$provider->pvd_state) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('pvd_state')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                                <div class="mb-2">* {{__('Postal Code')}}</div>
                                <input id="pvd_postalcode" name="pvd_postalcode" value="{{ old('pvd_postalcode',$provider->pvd_postalcode) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                @error('pvd_postalcode')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>

                        </div>

                        <div class="font-medium text-base mt-5">{{__('Additional Information')}}</div>
                        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                            {{-- FORCE FALSE --}}
                            <input type="hidden" id="pvd_logo_use" name="pvd_logo_use" value="0">

                            {{-- <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                                <div class="mb-2">* {{__('Use Logo')}}</div>
                                <select id="pvd_logo_use" name="pvd_logo_use" class="input w-full border flex-1" aria-required111="" required111>
                                    <option value="1" @if (old('pvd_logo_use',$provider->pvd_logo_use) == strval(1)) selected @endif>Sim</option>
                                    <option value="0" @if (old('pvd_logo_use',$provider->pvd_logo_use) == strval(0)) selected @endif>Não</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-10 sm:col-span-10">
                                <div class="mb-2">{{__('Logo Image')}}</div>
                                @if ($provider->pvd_logo)
                                    <div class="grid grid-cols-12 gap-2">
                                        <img alt="Customer Logo" class="rounded w-10 h-10 col-span-1" src="{{asset('storage/'.$provider->pvd_logo)}}">
                                        <input id="pvd_logo" name="pvd_logo" value="{{ $provider->pvd_logo }}" type="text" class="input w-full border py-1 flex-1 col-span-10" readonly>
                                    </div>
                                @else
                                    <input id="pvd_logo" name="pvd_logo" value="{{ old('pvd_logo') }}" type="file" class="input w-full border py-1 flex-1">
                                @endif
                                @error('pvd_logo')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div> --}}

                            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                                <div class="mb-2">* {{__('Use Signature')}}</div>
                                <select id="pvd_signature_use" name="pvd_signature_use" class="input w-full border flex-1" aria-required111="" required111>
                                    <option value="1" @if (old('pvd_signature_use',$provider->pvd_signature_use) == strval(1)) selected @endif>Sim</option>
                                    <option value="0" @if (old('pvd_signature_use',$provider->pvd_signature_use) == strval(0)) selected @endif>Não</option>
                                </select>
                                @error('pvd_signature_use')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>

                            <div class="intro-y col-span-12 lg:col-span-10 sm:col-span-10">
                                <div class="mb-2">{{__('Signature Image')}}</div>
                                @if ($provider->pvd_signature)
                                    <div class="grid grid-cols-12 gap-2">
                                        <img alt="Customer Logo" class="rounded w-10 h-10 col-span-1" src="{{asset('storage/'.$provider->pvd_signature)}}">
                                        <input id="pvd_signature" name="pvd_signature" value="{{ $provider->pvd_signature }}" type="text" class="input w-full border py-1 flex-1 col-span-10" readonly>
                                    </div>
                                @else
                                    <input id="pvd_signature" name="pvd_signature" value="{{ old('pvd_signature') }}" type="file" class="input w-full border py-1 flex-1">
                                @endif
                                @error('pvd_signature')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-12 sm:col-span-12">
                                <div class="mb-2">{{__('Certificate')}}</div>
                                @if ($provider->certificate)
                                    <div class="grid grid-cols-12 gap-2">
                                        <input id="certificate" name="certificate" value="{{ $provider->certificate }}" type="text" class="input w-50 border py-1 flex-1 col-span-10" readonly>
                                    </div>
                                @else
                                    <input id="certificate" name="certificate" value="{{ old('certificate') }}" type="file" class="input w-full border py-1 flex-1">
                                @endif
                                @error('certificate')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="font-medium text-base mt-5">{{__('Bank information')}}</div>
                        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

                            <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-6">
                                <div class="mb-2">{{__('Bank Name')}}</div>
                                <select id="bank_id" name="bank_id" class="input w-full border flex-1">
                                    <option value=""> -- </option>
                                    @foreach ($ListBank as $item)
                                        <option value="{{ $item->id }}" @if(old('bank_id',$provider->bank_id) == $item->id) selected @endif>{{ $item->ref_options }} - {{ $item->ref_description }}</option>
                                    @endforeach
                                </select>
                                @error('bank_id')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>

                            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                                <div class="mb-2">{{__('Agence')}}</div>
                                <input id="bank_agency_num" name="bank_agency_num" value="{{ old('bank_agency_num',$provider->bank_agency_num) }}" type="number" class="input w-full border flex-1" placeholder="">
                                @error('bank_agency_num')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                                <div class="mb-2">{{__('DV')}}</div>
                                <input id="bank_agency_dv" name="bank_agency_dv" value="{{ old('bank_agency_dv',$provider->bank_agency_dv) }}" type="number" class="input w-full border flex-1" placeholder="">
                                @error('bank_agency_dv')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-6">
                                <div class="mb-2">{{__('Account Type')}}</div>
                                <select id="bank_account_type_id" name="bank_account_type_id" class="input w-full border flex-1">
                                    <option value=""> -- </option>
                                    @foreach ($ListBankAccountType as $item)
                                        <option value="{{ $item->id }}" @if(old('bank_account_type_id',$provider->bank_account_type_id) == $item->id) selected @endif>{{ $item->ref_description }}</option>
                                    @endforeach
                                </select>
                                @error('bank_account_type_id')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                                <div class="mb-2">{{__('Account Number')}}</div>
                                <input id="bank_account_num" name="bank_account_num" value="{{ old('bank_account_num',$provider->bank_account_num) }}" type="number" class="input w-full border flex-1" placeholder="">
                                @error('bank_account_num')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                                <div class="mb-2">{{__('DV')}}</div>
                                <input id="bank_account_dv" name="bank_account_dv" value="{{ old('bank_account_dv',$provider->bank_account_dv) }}" type="number" class="input w-full border flex-1" placeholder="">
                                @error('bank_account_dv')
                                <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                            <div class="intro-y col-span-6 flex items-center text-left mt-5">
                                <h6 class="text-red">* {{__('Mandatory filling')}}</h6>
                            </div>
                            <div class="intro-y col-span-6 flex items-center justify-center sm:justify-end mt-5">
                                <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Alter')}}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                {{-- <div class="intro-y box col-span-4 lg:col-span-4 sm:col-span-12">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">{{__('Provider Logo')}}</h2>
                        <div class="intro-x">
                            <form id="formRemoveProviderImage" action="{{route('toManager.providerImage.remove',['providerSlug'=>$provider->pvd_slug])}}" method="post">
                                @if ($provider->pvd_logo)
                                    @csrf
                                    <input type="hidden" name="target" value="pvd_logo"/>
                                    <input type="hidden" name="pvd_logo" value="{{$provider->pvd_logo}}"/>
                                    <button id="btn-send" class="button button--sm w-100 xl:w-100 text-white bg-theme-1 ml-auto align-top">
                                        {{__('Remove')}}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="p-5 text-center">
                        @if ($provider->pvd_logo)
                            <img alt="Customer Logo" class="rounded" src="{{asset('storage/'.$provider->pvd_logo)}}">
                        @else
                            {{__('No Image')}}
                        @endif
                    </div>
                </div> --}}

                <div class="intro-y box col-span-4 lg:col-span-4 sm:col-span-12">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">{{__('Provider Signature')}}</h2>
                        <div class="intro-x">
                            <form id="formRemoveProviderImage" action="{{route('toManager.providerImage.remove',['providerSlug'=>$provider->pvd_slug])}}" method="post">
                                @if ($provider->pvd_signature)
                                    @csrf
                                    <input type="hidden" name="target" value="pvd_signature"/>
                                    <input type="hidden" name="pvd_signature" value="{{$provider->pvd_signature}}"/>
                                    <button id="btn-send" class="button button--sm w-100 xl:w-100 text-white bg-theme-1 ml-auto align-top">
                                        {{__('Remove')}}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="p-5 text-center">
                        @if ($provider->pvd_signature)
                            <img alt="Provider Signature Image" class="rounded" src="{{asset('storage/'.$provider->pvd_signature)}}">
                        @else
                            {{__('No Image')}}
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script>
        jQuery('#formRemoveCustomerImage').submit(function( event )
        {
            if(!confirm("{{__('Confirm Image Remove?')}}"))
                event.preventDefault();
        });

        jQuery('#pvd_doc_type').on('change',function()
        {
            if($('#pvd_doc_type').val() == 'cpf')
            {
                cpf.mask(pvd_doc_num);
                $('#name').prop('disabled', false);
                $('#pvd_doc_num').prop('disabled', false);
                $('#pvd_name_company').prop('disabled', true);
            }
            else if($('#pvd_doc_type').val() == 'cnpj')
            {
                cnpj.mask(pvd_doc_num);
                $('#name').prop('disabled', false);
                $('#pvd_doc_num').prop('disabled', false);
                $('#pvd_name_company').prop('disabled', false);
                $('#pvd_name_company').prop('require', true);
            }
            else
            {
                //remove.mask(pvd_doc_num);
                $('#name').prop('disabled', true);
                $('#pvd_doc_num').prop('disabled', true);
                $('#pvd_name_company').prop('disabled', true);
            }
        });

        jQuery(document).ready(function()
        {
            if($('#pvd_doc_type').val() == 'cpf')
            {
                cpf.mask(pvd_doc_num);
                $('#pvd_name').prop('disabled', false);
                $('#pvd_name_company').prop('disabled', true);
                $('#pvd_name_company').val()
            }

            if($('#pvd_doc_type').val() == 'cnpj')
            {
                cnpj.mask(pvd_doc_num);
                $('#pvd_name').prop('disabled', false);
                $('#pvd_name_company').prop('require', true);
                $('#pvd_name_company').prop('disabled', false);
            }

            if($('#name').val())
                $('#name').prop('disabled', false);

            if($('#pvd_name_company').val())
                $('#pvd_name_company').prop('disabled', false);

            if($('#pvd_doc_type').val())
                $('#pvd_doc_num').prop('disabled', false);

            if($('#pvd_identity_type').val())
                $('#pvd_identity_num').prop('disabled', false);
        });

        mobile.mask(input_phone_mobile);
        phone.mask(input_phone);
        cep.mask(pvd_postalcode);

        </script>
@endsection

<!-- -->
