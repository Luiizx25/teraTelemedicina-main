@extends('_layout.side-menu',[
    'title' => __('Customer Contract Create'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('New Contract')}}</h2>
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
    <form action="{{route('toManager.customerContract.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cus_slug" value="{{$customer->cus_slug}}">
        <div class="intro-y box mt-3">
            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('Contract Identification')}}
                    </h2>
                </div>
            </div>
            <div class="px-5 py-2">
                <div class="grid grid-cols-12 gap-4">

                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">* {{__('Contract Type')}}</div>
                        <select id="type_id" name="type_id" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($RefContractCusType as $item)
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

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Volume free')}}</div>
                        <select id="contract_volume_free" name="contract_volume_free" class="input w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($ListBoolean as $item)
                                @if ($item->id == old('contract_volume_free'))
                                    <option value="{{$item->id}}" selected>{{$item->ref_description}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->ref_description}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('contract_volume_free')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Active')}}</div>
                        <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($ListBoolean as $item)
                                @if ($item->id == old('active'))
                                    <option value="{{$item->id}}" selected>{{$item->ref_description}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->ref_description}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('active')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                </div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Contract signing date')}}</div>
                        <input id="contract_date" name="contract_date" value="{{ old('contract_date') }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('contract_date')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Contract start date')}}</div>
                        <input id="contract_date_start" name="contract_date_start" value="{{ old('contract_date_start') }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('contract_date_start')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Contract end date')}}</div>
                        <input id="contract_date_end" name="contract_date_end" value="{{ old('contract_date_end') }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('contract_date_end')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">

                        <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                            <div class="mr-auto">
                                <h2 class="font-medium text-base mr-auto">{{__('Invoicement')}}</h2>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-8">
                                    <div class="mb-2">* {{__('Pay option')}}</div>
                                    <select id="invoice_pay_option_id" name="invoice_pay_option_id" class="input w-full border flex-1" aria-required="" required>
                                        <option value=""> -- </option>
                                        @foreach ($RefInvoicePayOption as $item)
                                            @if ($item->id == old('invoice_pay_option_id'))
                                                <option value="{{$item->id}}" selected>{{$item->ref_description}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->ref_description}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('invoice_pay_option_id')
                                    <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                                <div class="col-span-4">
                                    <div class="intro-y col-span-1 lg:col-span-1 sm:col-span-2">
                                        <div class="mb-2">* {{__('Day')}}</div>
                                        <select id="invoice_day" name="invoice_day" class="input w-full border flex-1" aria-required="" required>
                                            <option value=""> -- </option>
                                            @foreach ($ListMonthDay as $item)
                                            @if ($item->id == old('invoice_day'))
                                            <option value="{{$item->id}}" selected>{{$item->ref_description}}</option>
                                            @else
                                            <option value="{{$item->id}}">{{$item->ref_description}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('invoice_day')
                                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-8 sm:col-span-12">
                        <div class="box shadow-md border border-solid border-gray-300">
                            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                <div class="mr-auto">
                                    <h2 class="font-medium text-base mr-auto">{{__('Contract Comments')}}</h2>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class=" col-span-12 lg:col-span-12 sm:col-span-12">
                                    <textarea id="contract_comments" name="contract_comments" class="input w-full border flex-1 my-2" placeholder="{{__('Internal comments on the contract (Not visible to the customer)')}}">{{ old('contract_comments') }}</textarea>
                                    @error('contract_comments')
                                    <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-12 gap-4 row-gap-5">
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
        jQuery('#cus_doc_type').on('change',function()
        {
            if($('#cus_doc_type').val() == 'CPF')
            {
                cpf.mask(cus_doc_num);
                $('#cus_name').prop('disabled', false);
                $('#cus_name_company').prop('disabled', true);
                $('#cus_name_company').val(null)
            }
            else if($('#cus_doc_type').val() == 'CNPJ')
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
