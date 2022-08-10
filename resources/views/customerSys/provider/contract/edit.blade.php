@extends('_layout.side-menu',[
    'title' => __('Change Provider Contract'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('Change Contract')}}
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12 flex lg:block flex-col-reverse">
            <div class="intro-y box p-2">
                <div class="relative flex items-between">
                    <div class="mr-2">
                        <div class="font-medium text-base">{{$contract->provider->user->name??'--'}}
                            <p class="text-xs text-gray-600">{{ strtoupper($contract->provider->pvd_identity_type??'--') }} {{$contract->provider->pvd_identity_num??'--'}}</p>
                            @if ($contract->provider->cus_name_company)
                                | <p class="text-gray-600 text-sm">{{$contract->provider->cus_name_company}}</p>
                            @endif
                        </div>
                        <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Provider')}} {{$contract->provider->id}}</span>
                    </div>
                    <div class="ml-auto">
                        <div class="w-16 h-16 image-cover">
                            @empty($contract->provider->pvd_logo)
                                <img class="rounded" src="{{asset('/app/images/default_profile.png')}}">
                            @else
                                <img class="rounded" src="{{asset('storage/' . $contract->provider->pvd_logo)}}">
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('toManager.providerContract.update',['providerContract'=>$contract->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="cus_slug" value="{{$contract->provider->cus_slug}}">

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
                            @foreach ($RefContractPvdType as $item)
                                <option value="{{ $item->id }}" @if (old('type_id',$contract->type_id) == $item->id) selected @endif>{{ $item->ref_description }}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Active')}}</div>
                        <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                            <option value="1" @if (old('active',$contract->active) == strval(1)) selected @endif>Sim</option>
                            <option value="0" @if (old('active',$contract->active) == strval(0)) selected @endif>Não</option>
                        </select>
                        @error('active')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                </div>
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">

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

                    <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                        <div class="mb-2">* {{__('Contract end date')}}</div>
                        <input id="contract_date_end" name="contract_date_end" value="{{ old('contract_date_end',$contract->contract_date_end->format('Y-m-d')) }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required="" required>
                        @error('contract_date_end')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">

                        <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                            <div class="mr-auto">
                                <h2 class="font-medium text-base mr-auto">{{__('Payment')}}</h2>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-8">
                                    <div class="mb-2">* {{__('Pay option')}}</div>
                                    <select id="payment_option_id" name="payment_option_id" class="input w-full border flex-1" aria-required="" required>
                                        @foreach ($RefPaymentPvdOption as $item)
                                            <option value="{{$item->id}}" @if ($item->id == old('payment_option_id',$contract->payment_option_id)) selected @endif>{{$item->ref_description}}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_option_id')
                                    <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                    @enderror
                                </div>
                                <div class="col-span-4">
                                    <div class="intro-y col-span-1 lg:col-span-1 sm:col-span-2">
                                        <div class="mb-2">* {{__('Day')}}</div>
                                        <select id="payment_day" name="payment_day" class="input w-full border flex-1" aria-required="" required>
                                            @foreach ($ListMonthDay as $item)
                                                <option value="{{$item->id}}" @if ($item->id == old('payment_day',$contract->payment_day)) selected @endif>{{$item->ref_description}}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_day')
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
                                    <textarea id="contract_comments" name="contract_comments" class="input w-full border flex-1 my-2" placeholder="{{__('Internal comments on the contract (Not visible to the provider)')}}">{{ old('contract_comments',$contract->contract_comments) }}</textarea>
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
                        <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Change')}}</button>
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
