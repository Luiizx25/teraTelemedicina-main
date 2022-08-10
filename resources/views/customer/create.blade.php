@extends('_layout.side-menu',[
    'title' => __('Customer Create'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <h2 class="text-2xl font-medium my-2 mr-5">{{__('New Customer')}}</h2>
    <form action="{{route('toManager.customer.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="intro-y box mt-2">
            <div class="p-5">
                <div class="font-medium text-base">{{__('Identification')}}</div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                        <div class="mb-2">* {{__('Customer Type')}}</div>
                        <select id="type_id" name="type_id" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                            <option value=""> -- </option>
                            @foreach ($RefCustomerType as $item)
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
                        <div class="mb-2">* {{__('Document Type')}}</div>
                        <select id="cus_doc_type" name="cus_doc_type" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                            <option value=""> -- </option>
                            @foreach ($RefDocTypeCus as $item)
                                @if (old('cus_doc_type') == $item->ref_slug)
                                    <option value="{{ $item->ref_slug }}" selected>{{ $item->ref_description }}</option>
                                @else
                                    <option value="{{ $item->ref_slug }}">{{ $item->ref_description }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('cus_doc_type')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-6">
                        <div class="mb-2">* {{__('Document Number')}}</div>
                        <input id="cus_doc_num" name="cus_doc_num" value="{{ old('cus_doc_num') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" disabled="true" aria-required111="" required111>
                        @error('cus_doc_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-12">
                        <div class="mb-2">* {{__('Name')}}</div>
                        <input id="cus_name" name="cus_name" value="{{ old('cus_name') }}" type="text" class="input order-none sm:order-3 w-full border flex-1" placeholder="" disabled="true" aria-required111="" required111>
                        @error('cus_name')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-12">
                        <div class="mb-2">* {{__('Name Company')}}</div>
                        <input id="cus_name_company" name="cus_name_company" value="{{ old('cus_name_company') }}" type="text" class="input order-none order-none sm:order-4 w-full border flex-1" placeholder="" disabled="true">
                        @error('cus_name_company')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-6">
                        <div class="mb-2">* {{__('Phone')}}</div>
                        <input id="cus_phone" name="cus_phone" value="{{ old('cus_phone') }}" type="text" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_phone')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-6">
                        <div class="mb-2">* {{__('Email')}}</div>
                        <input id="cus_email" name="cus_email" value="{{ old('cus_email') }}" type="text" class="input order-none sm:order-6 w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_email')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 border-t"></div>
                </div>

                <div class="font-medium text-base mt-5">{{__('Address')}}</div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-5 sm:col-span-12">
                        <div class="mb-2">* {{__('Street')}}</div>
                        <input id="cus_street" name="cus_street" value="{{ old('cus_street') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_street')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-12">
                        <div class="mb-2">* {{__('Number')}}</div>
                        <input id="cus_street_num" name="cus_street_num" value="{{ old('cus_street_num') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_street_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">{{__('Complement')}}</div>
                        <input id="cus_street_complement" name="cus_street_complement" value="{{ old('cus_street_complement') }}" type="text" class="input w-full border flex-1" placeholder="">
                        @error('cus_street_complement')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">* {{__('Neighborhood')}}</div>
                        <input id="cus_neighborhood" name="cus_neighborhood" value="{{ old('cus_neighborhood') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_neighborhood')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <div class="mb-2">* {{__('City')}}</div>
                        <input id="cus_city" name="cus_city" value="{{ old('cus_city') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_city')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                        <div class="mb-2">* {{__('State')}}</div>
                        <input id="cus_state" name="cus_state" value="{{ old('cus_state') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_state')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                        <div class="mb-2">* {{__('Postal Code')}}</div>
                        <input id="cus_postalcode" name="cus_postalcode" value="{{ old('cus_postalcode') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_postalcode')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-12">
                        <div class="box shadow-md border border-solid border-gray-300">
                            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                <div class="mr-auto">
                                    <h2 class="font-medium text-base mr-auto">{{__('Manager Contact')}}</h2>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-4 row-gap-5">
                                    <div class=" col-span-12 lg:col-span-12 sm:col-span-12">
                                        <div class="mb-2">* {{__('Name')}}</div>
                                        <input id="cus_manager_name" name="cus_manager_name" value="{{ old('cus_manager_name') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_manager_name')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-4 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Phone')}}</div>
                                        <input id="cus_manager_phone" name="cus_manager_phone" value="{{ old('cus_manager_phone') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_manager_phone')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-8 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Email')}}</div>
                                        <input id="cus_manager_email" name="cus_manager_email" value="{{ old('cus_manager_email') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_manager_email')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-12">
                        <div class="box shadow-md border border-solid border-gray-300">
                            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                <div class="mr-auto">
                                    <h2 class="font-medium text-base mr-auto">{{__('Financial Contact')}}</h2>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-4 row-gap-5">
                                    <div class=" col-span-12 lg:col-span-12 sm:col-span-12">
                                        <div class="mb-2">* {{__('Name')}}</div>
                                        <input id="cus_financial_name" name="cus_financial_name" value="{{ old('cus_financial_name') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_financial_name')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-4 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Phone')}}</div>
                                        <input id="cus_financial_phone" name="cus_financial_phone" value="{{ old('cus_financial_phone') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_financial_phone')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-8 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Email')}}</div>
                                        <input id="cus_financial_email" name="cus_financial_email" value="{{ old('cus_financial_email') }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_financial_email')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="font-medium text-base mt-5">{{__('Additional Information')}}</div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-4">
                        <div class="mb-2">* {{__('Use Logo')}}</div>
                        <select id="cus_logo_use" name="cus_logo_use" class="input w-full border flex-1" aria-required111="" required111>
                            <option> -- </option>
                            @foreach (['customerSys' => 'Sim - Logo da TeraTelemedicina','customer' => 'Sim - Logo da Empresa', 'none'=>'Não - Não quero usar logo'] as $value => $item)
                                <option value="{{$value}}" @if ($value == old('cus_logo_use')) selected @endif>{{$item}}</option>
                            @endforeach
                        </select>
                        @error('cus_logo_use')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-8 sm:col-span-8">
                        <div class="mb-2">{{__('Image')}}</div>
                        <input id="cus_logo" name="cus_logo" value="{{ old('cus_logo') }}" type="file" class="input w-full border py-1 flex-1">
                        @error('cus_logo')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    {{-- <div class="intro-y col-span-12 border-t"></div> --}}
                </div>

                {{-- <div class="font-medium text-base mt-5">{{__('Bank information')}}</div>
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
            let docType = cash('#cus_doc_type').val()

            if(docType == 'cpf')
            {
                cpf.mask(cus_doc_num);
                cash('#cus_name').prop('disabled', false);
                cash('#cus_doc_num').prop('disabled', false);
                cash('#cus_name_company').prop('disabled', true);
                cash('#cus_name_company').val(null)
            }

            if(docType == 'cnpj')
            {
                cnpj.mask(cus_doc_num);
                cash('#cus_name').prop('disabled', false);
                cash('#cus_doc_num').prop('disabled', false);
                cash('#cus_name_company').prop('require', true);
                cash('#cus_name_company').prop('disabled', false);
            }

            if(cash('#cus_name').val())
                $('#cus_name').prop('disabled', false);

            if(cash('#cus_name_company').val())
                cash('#cus_name_company').prop('disabled', false);

            phoneMobile.mask(cus_phone);
            email.mask(cus_email);
            phoneMobile.mask(cus_manager_phone);
            email.mask(cus_manager_email);
            phoneMobile.mask(cus_financial_phone);
            email.mask(cus_financial_email);
            uf.mask(cus_state);
            cep.mask(cus_postalcode);

            cash('#cus_doc_type').on('change',function()
            {
                let docType = cash('#cus_doc_type').val()

                if(docType == 'cpf')
                {
                    cpf.mask(cus_doc_num);
                    cash('#cus_name').prop('disabled', false);
                    cash('#cus_doc_num').prop('disabled', false);
                    cash('#cus_name_company').prop('disabled', true);
                    cash('#cus_name_company').val(null)
                }
                else if(docType == 'cnpj')
                {
                    cnpj.mask(cus_doc_num);
                    cash('#cus_name').prop('disabled', false);
                    cash('#cus_doc_num').prop('disabled', false);
                    cash('#cus_name_company').prop('require', true);
                    cash('#cus_name_company').prop('disabled', false);
                }
                else
                {
                    remove.mask(cus_doc_num);
                    cash('#cus_name').prop('disabled', true);
                    cash('#cus_doc_num').prop('disabled', true);
                    cash('#cus_name_company').prop('disabled', true);
                }





            })



        });


        jQuery(document).ready(function()
        {
            if($('#cus_doc_type').val() == 'CPF')
            {
                cpf.mask(cus_doc_num);
                $('#cus_name').prop('disabled', false);
                $('#cus_name_company').prop('disabled', true);
                $('#cus_name_company').val()
            }

            if($('#cus_doc_type').val() == 'CNPJ')
            {
                cnpj.mask(cus_doc_num);
                $('#cus_name').prop('disabled', false);
                $('#cus_name_company').prop('require', true);
                $('#cus_name_company').prop('disabled', false);
            }


        });
</script>
@endsection
