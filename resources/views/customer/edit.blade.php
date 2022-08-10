@extends('_layout.side-menu',[
    'title' => __('Customer Edit'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Change Customer')}}</h2>
        </div>
    </div>
    <div class="intro-y box py-2 px-4">
        <div class="flex justify-between">
            <div>
                <div class="font-medium text-base">
                    <div>{{$customer->cus_name??'--'}}</div>
                    @if ($customer->cus_name_company)
                        <div class="text-gray-600 text-sm -mt-1">{{$customer->cus_name_company}}</div>
                    @endif
                </div>
                <p class="inline-block text-xs text-white mt-1 px-1 bg-theme-1 rounded">{{__('Customer')}} Id: {{$customer->id}}</span>
            </div>
            <div>
                <div class="image-cover h-16 w-full">
                    @empty($customer->cus_logo)
                        <img class="rounded h-16" src="{{asset('/app/images/default_profile.png')}}">
                    @else
                        <img class="rounded h-16" src="{{asset('storage/' . $customer->cus_logo)}}">
                    @endempty
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('toManager.customer.update',['customer'=>$customer->cus_slug])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="intro-y box mt-3">
            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('Identification')}}
                    </h2>
                </div>
            </div>
            <div class="px-5 py-2">
                <div class="grid grid-cols-12 gap-2 mt-2">
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-3">
                        <div class="mb-2">* {{__('Customer Type')}}</div>
                        <select id="type_id" name="type_id" class="input order-none sm:order-1 w-full border flex-1" aria-required111="" required111>
                            @foreach ($RefCustomerType as $item)
                                @if (old('type_id',$customer->type_id) == $item->id)
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
                            @foreach ($RefDocTypeCus as $item)
                                <option value="{{ $item->ref_slug }}" @if ($item->ref_slug == old('cus_doc_type',$customer->cus_doc_type)) selected @endif>{{ $item->ref_description }}</option>
                            @endforeach
                        </select>
                        @error('cus_doc_type')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-6">
                        <div class="mb-2">* {{__('Document Number')}}</div>
                        <input id="cus_doc_num" name="cus_doc_num" value="{{ old('cus_doc_num',$customer->cus_doc_num) }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_doc_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-12">
                        <div class="mb-2">* {{__('Name')}}</div>
                        <input id="cus_name" name="cus_name" value="{{ old('cus_name',$customer->cus_name) }}" type="text" class="input order-none sm:order-3 w-full border flex-1" placeholder="" disabled="true" aria-required111="" required111>
                        @error('cus_name')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 sm:col-span-12">
                        <div class="mb-2">* {{__('Name Company')}}</div>
                        <input id="cus_name_company" name="cus_name_company" value="{{ old('cus_name_company',$customer->cus_name_company) }}" type="text" class="input order-none order-none sm:order-4 w-full border flex-1" placeholder="" disabled="true">
                        @error('cus_name_company')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-6">
                        <div class="mb-2">* {{__('Phone')}}</div>
                        <input id="cus_phone" name="cus_phone" value="{{ old('cus_phone',$customer->cus_phone) }}" type="text" class="input order-none sm:order-5 w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_phone')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-6">
                        <div class="mb-2">* {{__('Email')}}</div>
                        <input id="cus_email" name="cus_email" value="{{ old('cus_email',$customer->cus_email) }}" type="email" class="input order-none sm:order-6 w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_email')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                </div>

                <div class="font-medium text-base mt-5">{{__('Address')}}</div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-5 sm:col-span-12">
                        <div class="mb-2">* {{__('Street')}}</div>
                        <input id="cus_street" name="cus_street" value="{{ old('cus_street',$customer->cus_street) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_street')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-12">
                        <div class="mb-2">* {{__('Number')}}</div>
                        <input id="cus_street_num" name="cus_street_num" value="{{ old('cus_street_num',$customer->cus_street_num) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_street_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">{{__('Complement')}}</div>
                        <input id="cus_street_complement" name="cus_street_complement" value="{{ old('cus_street_complement',$customer->cus_street_complement) }}" type="text" class="input w-full border flex-1" placeholder="">
                        @error('cus_street_complement')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">* {{__('Neighborhood')}}</div>
                        <input id="cus_neighborhood" name="cus_neighborhood" value="{{ old('cus_neighborhood',$customer->cus_neighborhood) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_neighborhood')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                        <div class="mb-2">* {{__('City')}}</div>
                        <input id="cus_city" name="cus_city" value="{{ old('cus_city',$customer->cus_city) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_city')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                        <div class="mb-2">* {{__('State')}}</div>
                        <input id="cus_state" name="cus_state" value="{{ old('cus_state',$customer->cus_state) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                        @error('cus_state')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                        <div class="mb-2">* {{__('Postal Code')}}</div>
                        <input id="cus_postalcode" name="cus_postalcode" value="{{ old('cus_postalcode',$customer->cus_postalcode) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
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
                                        <input id="cus_manager_name" name="cus_manager_name" value="{{ old('cus_manager_name',$customer->cus_manager_name) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_manager_name')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-4 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Phone')}}</div>
                                        <input id="cus_manager_phone" name="cus_manager_phone" value="{{ old('cus_manager_phone',$customer->cus_manager_phone) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_manager_phone')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-8 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Email')}}</div>
                                        <input id="cus_manager_email" name="cus_manager_email" value="{{ old('cus_manager_email',$customer->cus_manager_email) }}" type="email" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
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
                                        <input id="cus_financial_name" name="cus_financial_name" value="{{ old('cus_financial_name',$customer->cus_financial_name) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_financial_name')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-4 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Phone')}}</div>
                                        <input id="cus_financial_phone" name="cus_financial_phone" value="{{ old('cus_financial_phone',$customer->cus_financial_phone) }}" type="text" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
                                        @error('cus_financial_phone')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class=" col-span-12 lg:col-span-8 sm:col-span-12 mt-4">
                                        <div class="mb-2">* {{__('Email')}}</div>
                                        <input id="cus_financial_email" name="cus_financial_email" value="{{ old('cus_financial_email',$customer->cus_financial_email) }}" type="email" class="input w-full border flex-1" placeholder="" aria-required111="" required111>
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
                                <option value="{{$value}}" @if ($value == old('cus_logo_use', $customer->cus_logo_use)) selected @endif >{{$item}}</option>
                            @endforeach
                        </select>
                        @error('cus_logo_use')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-8 sm:col-span-8">
                        <div class="mb-2">{{__('Image')}}</div>
                        @if ($customer->cus_logo)
                            <div class="grid grid-cols-12 gap-2">
                                <img alt="Customer Logo" class="rounded w-10 h-10 col-span-1" src="{{asset('storage/'.$customer->cus_logo)}}">
                                <input id="cus_logo" name="cus_logo" value="{{ $customer->cus_logo }}" type="text" class="input w-full border py-1 flex-1 col-span-10" readonly>
                            </div>
                        @else
                            <input id="cus_logo" name="cus_logo" value="{{ old('cus_logo') }}" type="file" class="input w-full border py-1 flex-1">
                        @endif
                        @error('cus_logo')
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
                                <option value="{{ $item->id }}" @if(old('bank_id',$customer->bank_id) == $item->id) selected @endif>{{ $item->ref_options }} - {{ $item->ref_description }}</option>
                            @endforeach
                        </select>
                        @error('bank_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                        <div class="mb-2">{{__('Agence')}}</div>
                        <input id="bank_agency_num" name="bank_agency_num" value="{{ old('bank_agency_num',$customer->bank_agency_num) }}" type="number" class="input w-full border flex-1" placeholder="">
                        @error('bank_agency_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                        <div class="mb-2">{{__('DV')}}</div>
                        <input id="bank_agency_dv" name="bank_agency_dv" value="{{ old('bank_agency_dv',$customer->bank_agency_dv) }}" type="number" class="input w-full border flex-1" placeholder="">
                        @error('bank_agency_dv')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-6">
                        <div class="mb-2">{{__('Account Type')}}</div>
                        <select id="bank_account_type_id" name="bank_account_type_id" class="input w-full border flex-1">
                            <option value=""> -- </option>
                            @foreach ($ListBankAccountType as $item)
                            @if(old('bank_account_type_id',$customer->bank_account_type_id) == $item->id)
                                <option value="{{ $item->id }}" selected>{{ $item->ref_description }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->ref_description }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('bank_account_type_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-4">
                        <div class="mb-2">{{__('Account Number')}}</div>
                        <input id="bank_account_num" name="bank_account_num" value="{{ old('bank_account_num',$customer->bank_account_num) }}" type="number" class="input w-full border flex-1" placeholder="">
                        @error('bank_account_num')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-1 sm:col-span-2">
                        <div class="mb-2">{{__('DV')}}</div>
                        <input id="bank_account_dv" name="bank_account_dv" value="{{ old('bank_account_dv',$customer->bank_account_dv) }}" type="number" class="input w-full border flex-1" placeholder="">
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
                        <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Change')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
        <div class="intro-y box col-span-4 lg:col-span-4 sm:col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">{{__('Customer Logo')}}</h2>
                <div class="intro-x">
                    <form id="formRemoveCustomerImage" action="{{route('toManager.customerimage.remove',['customerSlug'=>$customer->cus_slug])}}" method="post">
                        @if ($customer->cus_logo)
                            @csrf
                            <input type="hidden" name="cus_logo" value="{{$customer->cus_logo}}"/>
                            <button id="btn-send" class="button button--sm w-100 xl:w-100 text-white bg-theme-1 ml-auto align-top">
                                {{__('Remove')}}
                            </button>
                        @endif
                    </form>
                </div>
            </div>
            <div class="p-5 text-center">
                @if ($customer->cus_logo)
                    <img alt="Customer Logo" class="rounded" src="{{asset('storage/'.$customer->cus_logo)}}">
                @else
                    {{__('No Image')}}
                @endif
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

        jQuery('#cus_doc_type').on('change',function()
        {
            if($('#cus_doc_type').val() == 'cpf')
            {
                cpf.mask(cus_doc_num);
                $('#cus_name').prop('disabled', false);
                $('#cus_name_company').prop('disabled', true);
                $('#cus_name_company').val(null)
            }
            else if($('#cus_doc_type').val() == 'cnpj')
            {
                cnpj.mask(cus_doc_num);
                $('#cus_name').prop('disabled', false);
                $('#cus_name_company').prop('require', true);
                $('#cus_name_company').prop('disabled', false);
            }
            else
            {
                remove.mask(cus_doc_num);
                $('#cus_name').prop('disabled', true);
                $('#cus_name_company').prop('disabled', true);
            }
        });

        jQuery(document).ready(function()
        {
            if($('#cus_doc_type').val() == 'cpf')
            {
                cpf.mask(cus_doc_num);
                $('#cus_name').prop('disabled', false);
                $('#cus_name_company').prop('disabled', true);
                $('#cus_name_company').val()
            }

            if($('#cus_doc_type').val() == 'cnpj')
            {
                cnpj.mask(cus_doc_num);
                $('#cus_name').prop('disabled', false);
                $('#cus_name_company').prop('require', true);
                $('#cus_name_company').prop('disabled', false);
            }

            if($('#cus_name').val())
                $('#cus_name').prop('disabled', false);

            if($('#cus_name_company').val())
                $('#cus_name_company').prop('disabled', false);

            phone.mask(cus_phone);
            phone.mask(cus_manager_phone);
            phone.mask(cus_financial_phone);
            cep.mask(cus_postalcode);
        });
</script>
@endsection
