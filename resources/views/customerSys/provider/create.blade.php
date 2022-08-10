@extends('_layout.side-menu',[
    'title' => __('Provider Create'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('New Provider')}}
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <form action="{{route('toManager.provider.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="intro-y box mt-2">
            <div class="p-5">
                <h2 class="text-2xl font-medium mr-auto">
                    {{__('Identification')}}
                </h2>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                        <div class="mb-2">* {{__('Type')}}</div>
                        <select id="type_id" name="type_id" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($RefProviderType as $item)
                                @if (old('type_id') == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->ref_description }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->ref_description }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('type_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                        <div class="mb-2">* {{__('Specialty')}}</div>
                        <select id="specialty_id" name="specialty_id" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($RefProviderSpecialty as $item)
                                @if (old('specialty_id') == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->ref_description }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->ref_description }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('specialty_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-3">
                        <div class="mb-2">* {{__('Document Type')}}</div>
                        <select id="pvd_doc_type" name="pvd_doc_type" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($RefDocTypePvd as $item)
                                @if (old('pvd_doc_type') == $item->ref_slug)
                                    <option value="{{ $item->ref_slug }}" selected>{{ $item->ref_description }}</option>
                                @else
                                    <option value="{{ $item->ref_slug }}">{{ $item->ref_description }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('pvd_doc_type')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                        <div class="mb-2">* {{__('Document Number')}}</div>
                        <input id="pvd_doc_num" name="pvd_doc_num" value="{{ old('pvd_doc_num') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" disabled="true" aria-required="" required>
                        @error('pvd_doc_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Identity Type')}}</div>
                        <select id="pvd_identity_type" name="pvd_identity_type" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($RefIdentityTypePvd as $item)
                                @if (old('pvd_identity_type') == $item->ref_slug)
                                    <option value="{{ $item->ref_slug }}" selected>{{ $item->ref_description }}</option>
                                @else
                                    <option value="{{ $item->ref_slug }}">{{ $item->ref_description }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('pvd_identity_type')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Identity UF')}}</div>
                        <select id="pvd_identity_uf" name="pvd_identity_uf" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($ListUf as $item)
                                @if (old('pvd_identity_uf') == $item->ref_description)
                                    <option value="{{ $item->ref_description }}" selected>{{ $item->ref_description }}</option>
                                @else
                                    <option value="{{ $item->ref_description }}">{{ $item->ref_description }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('pvd_identity_uf')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                        <div class="mb-2">* {{__('Identity Number')}}</div>
                        <input id="pvd_identity_num" name="pvd_identity_num" value="{{ old('pvd_identity_num') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" disabled="true" aria-required="" required>
                        @error('pvd_identity_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Name')}}</div>
                        <input id="name" name="name" value="{{ old('name') }}" type="text" class="input order-none sm:order-3 w-full border flex-1" placeholder="" disabled="true" aria-required="" required>
                        @error('name')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Name Company')}}</div>
                        <input id="pvd_name_company" name="pvd_name_company" value="{{ old('pvd_name_company') }}" type="text" class="input order-none order-none sm:order-4 w-full border flex-1" placeholder="" disabled="true">
                        @error('pvd_name_company')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-6">
                        <div class="mb-2">* {{__('Email')}}</div>
                        <input id="email" name="email" value="{{ old('email') }}" type="email" class="input order-none sm:order-6 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('email')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <div class="mb-2">* {{__('Phone')}}</div>
                        <input id="input_phone" name="phone" value="{{ old('phone') }}" type="text" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('phone')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <div class="mb-2">* {{__('Mobile')}}</div>
                        <input id="input_phone_mobile" name="phone_mobile" value="{{ old('phone_mobile') }}" type="text" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('phone_mobile')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <div class="mb-2">* {{__('Password')}}</div>
                        <input id="password" name="password" type="password" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('password')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <div class="mb-2">* {{__('Password Confirm')}}</div>
                        <input id="password_confirm" name="password_confirm" type="password" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required="" required>
                    </div>
                </div>

                <h2 class="text-2xl font-medium mr-auto mt-4">
                    {{__('Address')}}
                </h2>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-5 sm:col-span-12">
                        <div class="mb-2">* {{__('Street')}}</div>
                        <input id="pvd_street" name="pvd_street" value="{{ old('pvd_street') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required="" required>
                        @error('pvd_street')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-12">
                        <div class="mb-2">* {{__('Number')}}</div>
                        <input id="pvd_street_num" name="pvd_street_num" value="{{ old('pvd_street_num') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required="" required>
                        @error('pvd_street_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">{{__('Complement')}}</div>
                        <input id="pvd_street_complement" name="pvd_street_complement" value="{{ old('pvd_street_complement') }}" type="text" class="input w-full border flex-1" placeholder="">
                        @error('pvd_street_complement')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">* {{__('Neighborhood')}}</div>
                        <input id="pvd_neighborhood" name="pvd_neighborhood" value="{{ old('pvd_neighborhood') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required="" required>
                        @error('pvd_neighborhood')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <div class="mb-2">* {{__('City')}}</div>
                        <input id="pvd_city" name="pvd_city" value="{{ old('pvd_city') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required="" required>
                        @error('pvd_city')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                        <div class="mb-2">* {{__('State')}}</div>
                        <input id="pvd_state" name="pvd_state" value="{{ old('pvd_state') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required="" required>
                        @error('pvd_state')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                        <div class="mb-2">* {{__('Postal Code')}}</div>
                        <input id="pvd_postalcode" name="pvd_postalcode" value="{{ old('pvd_postalcode') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required="" required>
                        @error('pvd_postalcode')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                </div>

                <h2 class="text-2xl font-medium mr-auto mt-4">
                    {{__('Additional Information')}}
                </h2>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    {{-- FORCE FALSE --}}
                    <input type="hidden" id="pvd_logo_use" name="pvd_logo_use" value="0">

                    {{-- <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Use Logo')}}</div>
                        <select id="pvd_logo_use" name="pvd_logo_use" class="input w-full border flex-1" aria-required="" required>
                            <option value="" selected>--</option>
                            <option value="1" @if (old('pvd_logo_use') == strval(1)) selected @endif>Sim</option>
                            <option value="0" @if (old('pvd_logo_use') == strval(0)) selected @endif>Não</option>
                        </select>
                        @error('pvd_logo_use')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-10 sm:col-span-10">
                        <div class="mb-2">{{__('Logo Image')}}</div>
                        <input id="pvd_logo" name="pvd_logo" value="{{ old('pvd_logo') }}" type="file" class="input w-full border py-1 flex-1">
                        @error('pvd_logo')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div> --}}

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Use Signature')}}</div>
                        <select id="pvd_signature_use" name="pvd_signature_use" class="input w-full border flex-1" aria-required="" required>
                            <option value="" selected>--</option>
                            <option value="1" @if (old('pvd_signature_use') == strval(1)) selected @endif>Sim</option>
                            <option value="0" @if (old('pvd_signature_use') == strval(0)) selected @endif>Não</option>
                        </select>
                        @error('pvd_signature_use')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-10 sm:col-span-10">
                        <div class="mb-2">{{__('Signature Image')}}</div>
                        <input id="pvd_signature" name="pvd_signature" value="{{ old('pvd_signature') }}" type="file" class="input w-full border py-1 flex-1">
                        @error('pvd_signature')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-12 sm:col-span-12">
                        <div class="mb-2">* {{__('Certificate')}}</div>
                        <input id="certificate" name="certificate" value="{{ old('certificate') }}" type="file" class="input w-full border py-1 flex-1">
                        @error('certificate')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 border-t"></div>
                </div>

                {{-- <h2 class="text-2xl font-medium mr-auto mt-4">
                    {{__('Bank Information')}}
                </h2>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-6">
                        <div class="mb-2">{{__('Bank Name')}}</div>
                        <select id="bank_id" name="bank_id" class="input w-full border flex-1">
                            <option value=""> -- </option>
                            @foreach ($ListBank as $item)
                                <option value="{{ $item->id }}" @if(old('bank_id') == $item->id) selected @endif>{{ $item->ref_options }} - {{ $item->ref_description }}</option>
                            @endforeach
                        </select>
                        @error('bank_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                        <div class="mb-2">{{__('Agence')}}</div>
                        <input id="bank_agency_num" name="bank_agency_num" value="{{ old('bank_agency_num') }}" type="number" class="input w-full border flex-1" placeholder="">
                        @error('bank_agency_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                        <div class="mb-2">{{__('DV')}}</div>
                        <input id="bank_agency_dv" name="bank_agency_dv" value="{{ old('bank_agency_dv') }}" type="number" class="input w-full border flex-1" placeholder="">
                        @error('bank_agency_dv')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-6">
                        <div class="mb-2">{{__('Account Type')}}</div>
                        <select id="bank_account_type_id" name="bank_account_type_id" class="input w-full border flex-1">
                            <option value=""> -- </option>
                            @foreach ($ListBankAccountType as $item)
                                <option value="{{ $item->id }}" @if(old('bank_account_type_id') == $item->id) selected @endif>{{ $item->ref_description }}</option>
                            @endforeach
                        </select>
                        @error('bank_account_type_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                        <div class="mb-2">{{__('Account Number')}}</div>
                        <input id="bank_account_num" name="bank_account_num" value="{{ old('bank_account_num') }}" type="number" class="input w-full border flex-1" placeholder="">
                        @error('bank_account_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                        <div class="mb-2">{{__('DV')}}</div>
                        <input id="bank_account_dv" name="bank_account_dv" value="{{ old('bank_account_dv') }}" type="number" class="input w-full border flex-1" placeholder="">
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
                        <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Create')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        cash(function ()
        {
            let docType = cash('#pvd_doc_type').val()

            if(docType == 'cpf')
            {
                cpf.mask(pvd_doc_num);
                cash('#name').prop('disabled', false);
                cash('#pvd_doc_num').prop('disabled', false);
                cash('#pvd_name_company').prop('disabled', true);
                cash('#pvd_name_company').val(null)
            }

            if(docType == 'cnpj')
            {
                cnpj.mask(pvd_doc_num);
                cash('#name').prop('disabled', false);
                cash('#pvd_doc_num').prop('disabled', false);
                cash('#pvd_name_company').prop('require', true);
                cash('#pvd_name_company').prop('disabled', false);
            }

            if(cash('#name').val())
                $('#name').prop('disabled', false);

            if(cash('#pvd_name_company').val())
                cash('#pvd_name_company').prop('disabled', false);

            phone.mask(input_phone);
            mobile.mask(input_phone_mobile);
            cep.mask(pvd_postalcode);

            cash('#pvd_doc_type').on('change',function()
            {
                let docType = cash('#pvd_doc_type').val()

                if(docType == 'cpf')
                {
                    cpf.mask(pvd_doc_num);
                    cash('#name').prop('disabled', false);
                    cash('#pvd_doc_num').prop('disabled', false);
                    cash('#pvd_name_company').prop('disabled', true);
                    cash('#pvd_name_company').val(null)
                }
                else if(docType == 'cnpj')
                {
                    cnpj.mask(pvd_doc_num);
                    cash('#name').prop('disabled', false);
                    cash('#pvd_doc_num').prop('disabled', false);
                    cash('#pvd_name_company').prop('require', true);
                    cash('#pvd_name_company').prop('disabled', false);
                }
                else
                {
                    remove.mask(pvd_doc_num);
                    cash('#name').prop('disabled', true);
                    cash('#pvd_doc_num').prop('disabled', true);
                    cash('#pvd_name_company').prop('disabled', true);
                }
            })


            cash('#pvd_identity_type').on('change',function()
            {
                if(cash('#pvd_identity_type').val())
                {
                    cash('#pvd_identity_num').prop('disabled', false);
                }
                else
                {
                    cash('#pvd_identity_num').prop('disabled', true);
                    cash('#pvd_identity_num').val('');
                }
            })
        });


        jQuery(document).ready(function()
        {
            if($('#pvd_doc_type').val() == 'CPF')
            {
                cpf.mask(pvd_doc_num);
                $('#name').prop('disabled', false);
                $('#pvd_name_company').prop('disabled', true);
                $('#pvd_name_company').val()
            }

            if($('#pvd_doc_type').val() == 'CNPJ')
            {
                cnpj.mask(pvd_doc_num);
                $('#name').prop('disabled', false);
                $('#pvd_name_company').prop('require', true);
                $('#pvd_name_company').prop('disabled', false);
            }

            if($('#pvd_identity_type').val())
                $('#pvd_identity_num').prop('disabled', false);
        });
</script>
@endsection
