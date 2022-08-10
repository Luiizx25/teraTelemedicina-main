@extends('_layout.side-menu',[
    'title' => __('Provider Contract Create'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('New Contract')}}</h2>
        </div>
    </div>
    <div class="intro-y box p-4">
        <div class="relative flex items-between">
            <div class="mr-2">
                <div class="font-medium text-base">{{$provider->user->name??'--'}}
                    <p class="text-xs text-gray-600">
                        {{ strtoupper($provider->pvd_identity_type??'--') }} {{$provider->pvd_identity_num??'--'}}
                        {{-- @if ($provider->pvd_name_company)
                            | <span class="text-gray-600 text-sm">{{$provider->pvd_name_company}}</span>
                        @endif --}}
                    </p>
                </div>
                <p class="inline-block text-xs text-white px-1 bg-theme-7 rounded">{{__('Provider')}} {{$provider->id}}</span>
            </div>
            <div class="ml-auto">
                <div class="w-16 h-16 image-fit">
                    @empty($provider->pvd_logo)
                        <img class="rounded" src="{{asset('/app/images/default_profile.png')}}">
                    @else
                        <img class="rounded" src="{{asset('storage/' . $provider->pvd_logo)}}">
                    @endempty
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('toManager.providerContract.store')}}" method="post">
        @csrf
        <input type="hidden" name="pvd_slug" value="{{$provider->pvd_slug}}">
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

                    <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-2">
                        <div class="mb-2">* {{__('Active')}}</div>
                        <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                            <option value="" selected>--</option>
                            <option value="1" @if (old('active') == strval(1)) selected @endif>Sim</option>
                            <option value="0" @if (old('active') == strval(0)) selected @endif>Não</option>
                        </select>
                        @error('active')
                        <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                        <div class="mb-2">* {{__('Type')}}</div>
                        <select id="type_id" name="type_id" class="input order-none sm:order-1 w-full border flex-1" aria-required="" required>
                            <option value=""> -- </option>
                            @foreach ($RefContractPvdType as $item)
                                <option value="{{ $item->id }}" @if (old('type_id') == $item->id) selected @endif >{{ $item->ref_description }}</option>
                            @endforeach
                        </select>
                        @error('type_id')
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
                                <h2 class="font-medium text-base mr-auto">{{__('Payment')}}</h2>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-8">
                                    <div class="mb-2">* {{__('Pay option')}}</div>
                                    <select id="payment_option_id" name="payment_option_id" class="input w-full border flex-1" aria-required="" required>
                                        <option value=""> -- </option>
                                        @foreach ($RefPaymentPvdOption as $item)
                                        <option value="{{$item->id}}" @if ($item->id == old('payment_option_id')) selected @endif>{{$item->ref_description}}</option>
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
                                            <option value=""> -- </option>
                                            @foreach ($ListMonthDay as $item)
                                            <option value="{{$item->id}}" @if ($item->id == old('payment_day')) selected @endif>{{$item->ref_description}}</option>
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
        jQuery('#pvd_doc_type').on('change',function()
        {
            if($('#pvd_doc_type').val() == 'CPF')
            {
                cpf.mask(pvd_doc_num);
                $('#pvd_name').prop('disabled', false);
                $('#pvd_name_company').prop('disabled', true);
                $('#pvd_name_company').val(null)
            }
            else if($('#pvd_doc_type').val() == 'CNPJ')
            {
                cnpj.mask(pvd_doc_num);
                $('#pvd_name').prop('disabled', false);
                $('#pvd_name_company').prop('require', true);
                $('#pvd_name_company').prop('disabled', false);
            }
            else
            {
                remove.mask(pvd_doc_num);
                $('#pvd_name').prop('disabled', true);
                $('#pvd_name_company').prop('disabled', true);
            }
        });

        jQuery(document).ready(function()
        {
            if($('#pvd_doc_type').val() == 'CPF')
            {
                cpf.mask(pvd_doc_num);
                $('#pvd_name').prop('disabled', false);
                $('#pvd_name_company').prop('disabled', true);
                $('#pvd_name_company').val()
            }

            if($('#pvd_doc_type').val() == 'CNPJ')
            {
                cnpj.mask(pvd_doc_num);
                $('#pvd_name').prop('disabled', false);
                $('#pvd_name_company').prop('require', true);
                $('#pvd_name_company').prop('disabled', false);
            }

            if($('#pvd_name').val())
                $('#pvd_name').prop('disabled', false);

            if($('#pvd_name_company').val())
                $('#pvd_name_company').prop('disabled', false);

        });

        phone.mask(phone);
        mobile.mask(phone_mobile);
        cep.mask(pvd_postalcode);
</script>
@endsection
