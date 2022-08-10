@extends('_layout.side-menu',[
    'title' => __('Change Customer Contract'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            @if ($additive)
                <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Aditivar Contrato')}}</h2>
            @else
                <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Alterar Contrato')}}</h2>
            @endif
        </div>
    </div>
    {{-- {{dd($additive)}} --}}
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12 flex lg:block flex-col-reverse">
            <div class="intro-y box p-2">
                <div class="relative flex items-between">
                    <div class="mr-2">
                        <div class="font-medium text-base">{{$contract->customer->cus_name??'--'}}
                            @if ($contract->customer->cus_name_company)
                                <div class="text-gray-600 text-sm">{{$contract->customer->cus_name_company}}</div>
                            @endif
                        </div>
                        <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Customer')}} {{$contract->customer->id}}</span>
                    </div>
                    <div class="ml-auto">
                        <div class="w-16 h-16 image-cover">
                            @empty($contract->customer->cus_logo)
                                <img class="rounded" src="{{asset('/app/images/default_profile.png')}}">
                            @else
                                <img class="rounded" src="{{asset('storage/' . $contract->customer->cus_logo)}}">
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    @include('_inc/alertStatus')
    {{--  --}}
    <form action="{{route('toManager.customerContract.update',['customerContract'=>$contract->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="cus_slug" value="{{ $contract->customer->cus_slug }}">
        <input type="hidden" name="additive" value="{{ $additive }}">

        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12 box mt-3">

            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('Contract Information')}}
                        <div class="text-gray-600 text-lg">{{$contract->contract_num}}</div>
                    </h2>
                </div>
            </div>
            <div class="px-5 py-2">
                <div class="grid grid-cols-12 gap-4">

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Contract Type')}}</div>
                        <select id="type_id" name="type_id" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            @foreach ($RefContractCusType as $item)
                                <option value="{{ $item->id }}" @if (old('type_id',$contract->type_id) == $item->id) selected @endif>{{ $item->ref_description }}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Volume free')}}</div>
                        <select id="contract_volume_free" name="contract_volume_free" class="input w-full border flex-1" aria-required="" required>
                            <option value="1" @if (old('contract_volume_free',$contract->contract_volume_free) == 1) selected @endif>Sim</option>
                            <option value="0" @if (old('contract_volume_free',$contract->contract_volume_free) == 0) selected @endif>Não</option>
                        </select>
                        @error('contract_volume_free')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Active')}}</div>
                        <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                            <option value="1" @if (old('active',$contract->active) == 1) selected @endif>Sim</option>
                            <option value="0" @if (old('active',$contract->active) == 0) selected @endif>Não</option>
                        </select>
                        @error('active')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                </div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

                    @if ($additive)
                        <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                            <div class="mb-2">* {{__('Data do aditivo')}}</div>
                            <input id="additive_date" name="additive_date" value="{{ old('additive_date') }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                            @error('additive_date')
                            <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>
                    @else
                        <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                            <div class="mb-2">* {{__('Contract signing date')}}</div>
                            <input id="contract_date" name="contract_date" value="{{ old('contract_date',$contract->contract_date->format('Y-m-d')) }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                            @error('contract_date')
                            <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                            <div class="mb-2">* {{__('Contract start date')}}</div>
                            <input id="contract_date_start" name="contract_date_start" value="{{ old('contract_date_start',$contract->contract_date_start->format('Y-m-d')) }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                            @error('contract_date_start')
                            <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>
                    @endif

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Contract end date')}}</div>
                        <input id="contract_date_end" name="contract_date_end" value="{{ old('contract_date_end',$contract->contract_date_end->format('Y-m-d')) }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('contract_date_end')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                </div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

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
                                        @foreach ($RefInvoicePayOption as $item)
                                            <option value="{{$item->id}}" @if ($item->id == old('invoice_pay_option_id',$contract->invoice_pay_option_id)) selected @endif>{{$item->ref_description}}</option>
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
                                            @foreach ($ListMonthDay as $item)
                                                <option value="{{$item->id}}" @if ($item->id == old('invoice_day',$contract->invoice_day)) selected @endif>{{$item->ref_description}}</option>
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
                                    <textarea id="contract_comments" name="contract_comments" class="input w-full border flex-1 my-2" placeholder="{{__('Internal comments on the contract (Not visible to the customer)')}}">{{ old('contract_comments',$contract->contract_comments) }}</textarea>
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
                        @if ($additive)
                            <button class="button w-auto justify-center block bg-theme-1 text-white ml-2">{{__('Cadastrar Aditivo')}}</button>
                        @else
                            <button class="button w-auto justify-center block bg-theme-1 text-white ml-2">{{__('Change')}}</button>
                        @endif
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
