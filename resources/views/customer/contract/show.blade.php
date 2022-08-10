@extends('_layout.side-menu',[
    'title' => __('Contract View'),
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => true,
    'useToastr' => true,
])

@section('subcontent')

    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium p-2">{{__('Contract')}}</h2>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <div class="intro-y box py-2 px-4">
                <div class="flex justify-between">
                    <div>
                        <div class="font-medium text-base">{{$contract->customer->cus_name??'--'}}
                            @if ($contract->customer->cus_name_company)
                                <div class="text-gray-600 text-xs -mt-1">{{$contract->customer->cus_name_company}}</div>
                            @endif
                        </div>
                        <div class="inline-block text-xs text-white mt-1 px-1 bg-theme-1 rounded">{{__('Customer')}} {{$contract->customer->id}}</div>
                    </div>
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

        <div class="col-span-12 lg:col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12 box">

                    <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Contract Information')}}
                                <div class="text-gray-600 text-lg">{{$contract->contract_num}}</div>
                                @if ($contract->Additives->count())
                                    <div class="flex text-gray-600">
                                        <i data-feather="log-in" class="w-4 h-4 text-yellow-700 mt-1 mr-1"></i>
                                        <div class="text-sm mr-1 font-light">Aditivado em</div>
                                        <div class="text-sm ">{{ $contract->Additives->last()->updated_at->format('d/m/Y') }}</div>
                                        {{--  --}}
                                        @empty($contract->Additives->last()->additive_date_conciliation)
                                            <div class="animate-pulse text-sm text-white bg-red-700 ml-1 py-0 px-2 rounded shadow-md font-semibold ">{{ __('PENDENTE DE RECONCILIAÇÃO') }}</div>
                                        @endempty
                                    </div>
                                @endif
                                {{-- {{dd($contract->Additives->last()->toArray())}} --}}
                            </h2>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                            <div class="dropdown-box">
                                <div class="dropdown-box__content box dark:bg-dark-1">
                                    <div class="p-2">
                                        <a href="{{route('toManager.customerContract.edit',[$contract->contract_num])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="edit" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('Alterar')}}
                                        </a>
                                        <a href="{{route('toManager.customerContract.edit',[$contract->contract_num,'additive'=>true])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="log-in" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('Aditivar')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-2">

                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-1">
                                <div class="text-gray-600 text-xs">{{__('Active')}}</div>
                                <div class="flex {{ $contract->active ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $contract->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i> {{$contract->active?__('Yes'):__('No')}}
                                </div>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-2">
                                <div class="text-gray-600 text-xs">{{__('Contract Type')}}</div>
                                <p class="font-medium">{{$contract->type->ref_description??'--'}}</p>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-4">
                                <div class="text-gray-600 text-xs">{{__('Contract Number')}}</div>
                                <p class="font-medium">{{$contract->contract_num??'--'}}</p>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-3">
                                <div class="text-gray-600 text-xs">{{__('Volume free')}}</div>
                                <p class="font-medium">{{$contract->contract_volume_free?__('Yes'):__('No')}}</p>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-2">
                                <div class="text-gray-600 text-xs">{{__('Current cycle')}}</div>
                                <p class="font-medium">{{ date_format(date_create(),'Y.m') }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-3">
                                <div class="text-gray-600 text-xs">{{__('Signing Date')}}</div>
                                <p class="font-medium">{{$contract->contract_date->format('d/m/Y')}}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-4">
                                <div class="text-gray-600 text-xs">{{__('Validity')}}</div>
                                <span class="text-gray-600">{{ __('From')}}</span>
                                <span class="font-medium">{{ $contract->contract_date_start->format('d/m/Y') }}</span>
                                <span class="text-gray-600">{{ __('to')}}</span>
                                <span class="font-medium">{{ $contract->contract_date_end->format('d/m/Y') }}</span>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-3">
                                <div class="text-gray-600 text-xs">{{__('Pay option')}}</div>
                                <p class="font-medium">{{$contract->payOption->ref_description??'--'}}</p>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-2">
                                <div class="text-gray-600 text-xs">{{__('Due date')}}</div>
                                <p class="font-medium">{{$contract->invoice_day??'--'}}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-12">
                                <div class="text-gray-600 text-xs">{{__('Comments')}}</div>
                                <p class="font-medium">{{$contract->contract_comments??'--'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Side Menu -->
        <div class="col-span-12 lg:col-span-12 xxl:col-span-3">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <div class="chat__tabs nav-tabs justify-center flex">
                        <a data-toggle="tab" data-target="#services" href="javascript:;" class="flex-1 py-2 rounded-md text-center active">{{__('Services')}}</a>
                        <a data-toggle="tab" data-target="#cycles" href="javascript:;" class="flex-1 py-2 rounded-md text-center">{{__('Billing Cycles')}}</a>
                    </div>
                </div>
            </div>
            <div class="tab-content">

                <div class="tab-content__pane active" id="services">

                    <div class="flex justify-between p-2">

                        <h2 class="text-2xl font-medium">{{__('Contract Services')}}</h2>

                        <div class="ml-auto">
                            @if(!$contract->contractCycle->count() || ($contract->Additives->last() && !$contract->Additives->last()->additive_date_conciliation ?? false))
                                <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button py-1 px-2 rounded inline-block bg-theme-1 text-white">
                                    <div class="flex items-center justify-center text-white">
                                        {{__('Add Service')}}
                                    </div>
                                </a>
                                <!-- MODAL -->
                                <div class="modal" id="modal-service-add">
                                    <div class="modal__content modal__content--xl">
                                        <form id="form_service_add" action="{{route('toManager.customerContractCusService.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" id="contract_num" name="contract_num" value="{{$contract->contract_num}}">

                                            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                                                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                                    <div class="mr-auto">
                                                        <h2 class="font-medium text-base mr-auto">{{__('Add Service')}}</h2>
                                                    </div>
                                                    @if (session('service_error'))
                                                    <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                        <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                                        <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('service_error')) }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="p-5">
                                                    <div class="grid grid-cols-12 gap-2">
                                                        <div class="col-span-2 sm:col-span-6 lg:col-span-4">
                                                            <div class="mb-2">{{__('Service Type')}}</div>
                                                            <select id="service_type_id" name="service_type_id" class="input w-full border flex-1" aria-required="" required>
                                                                <option value=""> -- </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-span-2 sm:col-span-6 lg:col-span-4">
                                                            <div class="mb-2">{{__('Service Category')}}</div>
                                                            <select id="service_category_id" name="service_category_id" class="input w-full border flex-1" aria-required="" required>
                                                                <option value=""> -- </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-span-2 sm:col-span-6 lg:col-span-4">
                                                            <div class="mb-2">{{__('Service Name')}}</div>
                                                            <select id="service_id" name="service_id" class="input w-full border flex-1" aria-required="" required>
                                                                <option value=""> -- </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                            <div class="mb-2">{{__('Negotiated Amount')}}</div>
                                                            <select id="service_negotiated_amount" name="service_negotiated_amount" class="input w-full border flex-1" aria-required="" required>
                                                                @foreach (range(1, 1000) as $number)
                                                                    <option value="{{$number}}" @if (old('service_negotiated_amount') == $number) selected @endif >{{$number}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                            <div class="mb-2">{{__('Negotiated Price')}}</div>
                                                            <div class="relative">
                                                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                <input type="text" id="service_negotiated_price" name="service_negotiated_price" value="{{old('service_negotiated_price')}}" class="input pl-12 w-full border col-span-4" />
                                                            </div>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                            <div class="mb-2">{{__('Negotiated Price Over')}}</div>
                                                            <div class="relative">
                                                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                <input type="text" id="service_negotiated_price_over" name="service_negotiated_price_over" value="{{old('service_negotiated_price_over')}}" class="input pl-12 w-full border col-span-4" />
                                                            </div>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                            <div class="mb-2">{{__('Negotiated Time Estimated')}}</div>
                                                            <input type="time" id="service_negotiated_time_estimated" name="service_negotiated_time_estimated" value="{{old('service_negotiated_time_estimated')}}" class="input w-full border flex-1" aria-required="" required>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-12 lg:col-span-12">
                                                            <div class="mb-2">{{__('Comments')}}</div>
                                                            <input type="text" id="service_negotiated_comments" name="service_negotiated_comments" value="{{old('service_negotiated_comments')}}" class="input w-full border flex-1">
                                                        </div>

                                                        <div class="intro-y col-span-12 mt-2 text-right">
                                                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                            <button class="button bg-theme-1 text-white">{{__('Add')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- MODAL -->
                            @endif
                        </div>
                    </div>

                    <div class="">
                        <div class="chat_box box p-5">

                            <!-- BEGIN:ALERTS -->
                            @include('_inc/alertService')
                            <!-- END:ALERTS -->

                            <!-- BEGIN: Data List -->
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table id="tableService" class="table table-report -mt-2 display" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-no-wrap">{{__('Name')}}</th>
                                            <th class="text-center whitespace-no-wrap">{{__('Amount')}}</th>
                                            <th class="text-center whitespace-no-wrap">{{__('Value')}}</th>
                                            <th class="text-center whitespace-no-wrap">{{__('Extra Value')}}</th>
                                            <th class="text-center whitespace-no-wrap">{{__('Time')}}</th>
                                            <th class="text-center whitespace-no-wrap">{{__('Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $countService = $contract->contractService()->count();
                                        @endphp
                                        @forelse ($contract->contractService as $serviceKey => $serviceItem)
                                            <tr class="intro-x shadow hover:shadow-lg">
                                                {{-- <td class="text-center">
                                                    <div class="flex items-center justify-center {{ $serviceItem->active ? 'text-theme-9' : 'text-theme-6' }}">
                                                        <i data-feather="{{ $serviceItem->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i>
                                                    </div>
                                                </td> --}}
                                                <td class="flex">
                                                    <div>
                                                        <i data-feather="{{ $serviceItem->active?'activity':'slash'}}" class="w-4 h-4 m-2"></i>
                                                    </div>
                                                    <div>
                                                        {{$serviceItem->service->service_name}}
                                                        <p class="text-xs whitespace-normal">{{$serviceItem->service->category->ref_description}}</p>
                                                    </div>

                                                </td>
                                                <td class="text-center">
                                                    {{$serviceItem->service_negotiated_amount}}
                                                </td>
                                                <td class="text-center">
                                                    R$ {{number_format($serviceItem->service_negotiated_price, 2, ',', '.')}}
                                                </td>
                                                <td class="text-center">
                                                    R$ {{number_format($serviceItem->service_negotiated_price_over, 2, ',', '.')}}
                                                </td>
                                                <td class="text-center">
                                                    {{$serviceItem->service_negotiated_time_estimated}}
                                                </td>
                                                <td class="text-center">
                                                    @if(!$contract->contractCycle->count() || ($contract->Additives->last() && !$contract->Additives->last()->additive_date_conciliation ?? false))
                                                        <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-edit-{{$serviceItem->id}}" class="">
                                                            <div class="flex items-center justify-center {{ $serviceItem->active ? 'text-theme-9' : 'text-theme-6' }}">
                                                                <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit
                                                            </div>
                                                        </a>
                                                        <!-- MODAL -->
                                                        <div class="modal" id="modal-service-edit-{{$serviceItem->id}}">
                                                            <div class="modal__content modal__content--xl">

                                                                <form id="form_service_add" action="{{route('toManager.customerContractCusService.update',['customerContractCusService'=>$serviceItem->id])}}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" id="contract_num" name="contract_num" value="{{$contract->contract_num}}">

                                                                    <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">

                                                                        <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                                                            <div class="mr-auto">
                                                                                <h2 class="font-medium text-base mr-auto">{{__('Change Service')}}</h2>
                                                                            </div>
                                                                            <div class="ml-auto">
                                                                                <span class="flex inline-block text-white px-2 bg-theme-4 rounded">{{$serviceItem->service->type->ref_description.' \ '.$serviceItem->service->category->ref_description.' \ '.$serviceItem->service->service_name}}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-5">
                                                                            <div class="grid grid-cols-12 gap-2">
                                                                                <input type="hidden" id="active" name="active" value="1" />
                                                                                {{-- <div class="col-span-2 sm:col-span-6 lg:col-span-2">
                                                                                    <div class="mb-2">{{__('Active')}}</div>
                                                                                    <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                                                                                        <option value="1" @if (old('active',$serviceItem->active) == 1) selected @endif>Sim</option>
                                                                                        <option value="0" @if (old('active',$serviceItem->active) == 0) selected @endif>Não</option>
                                                                                    </select>
                                                                                </div> --}}
                                                                                <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                                                    <div class="mb-2">{{__('Amount')}}</div>
                                                                                    <select id="service_negotiated_amount-{{$serviceKey}}" name="service_negotiated_amount" class="input w-full border flex-1" aria-required="" required>
                                                                                        @foreach (range(1, 1000) as $number)
                                                                                            <option value="{{$number}}" @if (old('service_negotiated_amount',$serviceItem->service_negotiated_amount) == $number) selected @endif >{{$number}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                                                    <div class="mb-2">{{__('Negotiated Price')}}</div>
                                                                                    <div class="relative">
                                                                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                                        <input type="text" id="service_negotiated_price-{{$serviceKey}}" name="service_negotiated_price" value="{{old('service_negotiated_price',$serviceItem->service_negotiated_price)}}" class="input pl-12 w-full border col-span-4" />
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                                                    <div class="mb-2">{{__('Negotiated Price Over')}}</div>
                                                                                    <div class="relative">
                                                                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                                        <input type="text" id="service_negotiated_price_over-{{$serviceKey}}" name="service_negotiated_price_over" value="{{old('service_negotiated_price_over',$serviceItem->service_negotiated_price_over)}}" class="input pl-12 w-full border col-span-4" />
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                                                    <div class="mb-2">{{__('Negotiated Time Estimated')}}</div>
                                                                                    <input type="time" id="service_negotiated_time_estimated-{{$serviceKey}}" name="service_negotiated_time_estimated" value="{{$serviceItem->service_negotiated_time_estimated}}" class="input w-full border flex-1" aria-required="" required>
                                                                                </div>

                                                                                <div class="col-span-2 sm:col-span-12 lg:col-span-12">
                                                                                    <div class="mb-2">{{__('Comments')}}</div>
                                                                                    <input type="text" id="service_negotiated_comments-{{$serviceKey}}" name="service_negotiated_comments" value="{{$serviceItem->service_negotiated_comments}}" class="input w-full border flex-1">
                                                                                </div>
                                                                            </div>
                                                                            @if($contract->Additives->last())
                                                                                <div class="flex justify-end mt-2">
                                                                                    <div class="flex intro-y">
                                                                                        <div>
                                                                                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                                                        </div>
                                                                                        <div>
                                                                                            <button class="button bg-theme-1 text-white">{{__('Change')}}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="flex justify-between mt-2">
                                                                                    <div class="intro-y">
                                                                                        <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-{{$serviceKey}}" class="button inline-block bg-theme-6 text-white">{{__('Delete Service')}}</a>
                                                                                    </div>

                                                                                    <div class="flex intro-y">
                                                                                        <div>
                                                                                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                                                        </div>
                                                                                        <div>
                                                                                            <button class="button bg-theme-1 text-white">{{__('Change')}}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!-- -->
                                                                <div class="modal" id="delete-modal-{{$serviceKey}}">
                                                                    <div class="modal__content">
                                                                        <form action="{{route('toManager.customerContractCusService.destroy',['customerContractCusService'=>$serviceItem->id])}}" method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" id="contract_num" name="contract_num" value="{{$contract->contract_num}}">

                                                                            <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                                                <div class="text-2xl mt-5">{{__('Are you sure?')}}</div>
                                                                                <div class="text-gray-600 mt-2">{{__('This process cannot be undone')}}</div>
                                                                            </div>
                                                                            <div class="px-5 pb-8 text-center">
                                                                                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                                                <button type="submit" class="button w-24 bg-theme-6 text-white">{{__('Delete')}}</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- -->
                                                            </div>
                                                        </div>
                                                        <!-- MODAL -->
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- END: Data List -->
                        </div>
                    </div>
                </div>


                <div class="tab-content__pane" id="cycles">

                    <div class="flex items-center m-2">
                        <div class="mr-auto">
                            <h2 class="text-2xl font-medium mr-5">{{__('Cycles')}}</h2>
                        </div>
                        <div class="ml-auto">
                            @if ($contract->contractCycle->count())
                                @if($contract->Additives->last() && !$contract->Additives->last()->additive_date_conciliation)
                                    <a href="{{route('toManager.customerContractCusCycle.reconciliation',['contractNum'=>$contract->contract_num])}}" class="button-sm py-1 px-2 rounded inline-block bg-theme-1 text-white">
                                        <div class="flex items-center justify-center text-white">
                                            <i data-feather="compass" class="w-4 h-4 mr-1"></i> {{__('Reconciliar Aditivo')}}
                                        </div>
                                    </a>
                                @endif
                                {{-- <div class="dropdown">
                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                                    <div class="dropdown-box">
                                        <div class="dropdown-box__content box dark:bg-dark-1">
                                            <div class="p-2">
                                                <a href="{{route('toManager.customerContractCusCycle.reconciliation',['contractNum'=>$contract->contract_num])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                    <i data-feather="compass" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('Reconciliation')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            @else
                                <a href="{{route('toManager.customerContractCusCycle.generate',['contractNum'=>$contract->contract_num])}}" class="button-sm py-1 px-2 rounded inline-block bg-theme-1 text-white">
                                    <div class="flex items-center justify-center text-white">
                                        <i data-feather="refresh-cw" class="flex w-4 h-4 mr-1 text-white"></i> {{__('Generate Cycles')}}
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="chat_box box py-2 px-4 mt-2">

                        <!-- BEGIN:ALERTS -->
                        @include('_inc/alertCycle')
                        <!-- END:ALERTS -->

                        <!-- -->
                        <div class="intro-y chat grid grid-cols-12 gap-3 mt-2">
                            <!-- BEGIN: Side Menu -->
                            <div class="col-span-12 lg:col-span-4 xxl:col-span-3">
                                <div class="chat__tabs nav-tabs overflow-y-auto scrollbar-hidden pt-1 pr-4">

                                    @forelse ($contract->contractCycle as $CycleKey => $CycleItem)

                                        <a data-toggle="tab" data-target="#{{$CycleItem->cycle_slug}}"  href="javascript:;" class="intro-x">

                                            <div class="cursor-pointer box py-1 px-2 mb-3 flex items-center zoom-out shadow border cycle-item-lnk ">
                                                <div class="overflow-hidden w-full">
                                                    <div class="flex justify-between">
                                                        <div class="font-medium">{{ $CycleItem->cycle_slug }}</div>
                                                        <div class="text-gray-600 text-xs">
                                                            {{ $CycleItem->cycle_date_start->format('d/m/Y') }} - {{ $CycleItem->cycle_date_end->format('d/m/Y') }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">{{ $CycleItem->cycle_date_start->diffInDays( $CycleItem->cycle_date_end )+1 }} {{__('Days')}}</div>
                                                    </div>
                                                </div>
                                                @if ($now->format('Y-m') == $CycleItem->cycle_slug)
                                                    <div class="w-5 h-5 flex items-center justify-center absolute top-0 right-0 text-xs text-white rounded-full bg-theme-1 font-medium -mt-2 -mr-2"><i data-feather="star" class="w-3 h-3"></i></div>
                                                @endif
                                            </div>

                                        </a>
                                    @empty
                                        <p class="font-medium">{{ __('No Cycles') }}</p>
                                    @endforelse
                                </div>
                            </div>
                            <!-- END: Side Menu -->

                            <!-- BEGIN: SERVICES DISPLAY-->
                            <div class="intro-y col-span-12 lg:col-span-8 xxl:col-span-9">
                                <div class="tab-content">

                                    <!-- BEGIN: SERVICE ITEM -->
                                    <div class="tab-content__pane active">
                                        <div class="mx-auto text-center mt-10">
                                            <i data-feather="activity" class="w-16 h-16 flex-none rounded-full overflow-hidden mx-auto text-gray-600"></i>
                                            <div class="mt-5">
                                                <div class="text-2xl">{{__('No cycle selected')}}</div>
                                                <div class="text-gray-600 mt-1">{{__('Please select a opton to view')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: SERVICE ITEM-->

                                    @forelse ($contract->contractCycle as $CycleKey => $CycleItem)
                                        <!-- BEGIN: SERVICE ITEM -->
                                        <div class="tab-content__pane h-full rounded shadow bg-gray-200" id="{{$CycleItem->cycle_slug}}">
                                            <div class="h-full flex flex-col">
                                                <div class="flex flex-col sm:flex-row dark:border-dark-5 pt-2 px-2">
                                                    <div class="flex items-center">
                                                        <div class="mr-auto">
                                                            <div class="font-medium text-base uppercase">{{__('Cycle')}} {{$CycleItem->cycle_slug}}</div>
                                                            <div class="text-gray-600 text-xs sm:text-sm">
                                                                {{ $CycleItem->cycle_date_start->format('d/m/Y') }} - {{ $CycleItem->cycle_date_end->format('d/m/Y') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="overflow-y-scroll scrollbar-hidden flex-1">
                                                    <!-- -->
                                                    <div class="intro-y">
                                                        <div class="overflow-x-auto sm:overflow-x-visible">

                                                            @forelse ($CycleItem->cycleService as $cycleService)
                                                                <!-- BEGIN: SERVICE ITEM -->
                                                                <div class="intro-y mt-2 border-t-2">
                                                                    <div class="inline-block sm:block text-gray-700 dark:text-gray-500 border-b border-gray-200 dark:border-dark-1">
                                                                        <div class="flex px-4 py-2">

                                                                            <div class="w-56 flex-none flex items-center">
                                                                                <p class="truncate">{{$cycleService->service->service_name}}</p>
                                                                            </div>

                                                                            @if (!$contract->contract_volume_free)
                                                                                <div class="w-64 h-4 bg-gray-400 dark:bg-dark-1 rounded">
                                                                                    @php
                                                                                        $percentual = porcentagemNxRound( $cycleService->cycle_amount_used, $cycleService->cycle_amount_negotiated );
                                                                                    @endphp
                                                                                    <div class="w-{{$percentual}}/100 h-full bg-theme-1 rounded text-center text-xs text-white">{{$percentual}}%</div>
                                                                                </div>
                                                                            @endif

                                                                            {{-- {{dd(
                                                                                $cycleService->toArray(),
                                                                                $cycleService->service->toArray(),
                                                                                $cycleService->service->orderItem->toArray(),
                                                                                )}} --}}
                                                                            <div class="inbox__item--time whitespace-no-wrap ml-auto">
                                                                                @if ($contract->contract_volume_free)
                                                                                    {{ $cycleService->cycle_amount_used }} {{ $cycleService->cycle_amount_used==1?'Pedido':'Pedidos' }}
                                                                                @else
                                                                                    {{$cycleService->cycle_amount_used}} / {{$cycleService->cycle_amount_negotiated}}
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- END: SERVICE ITEM-->
                                                            @empty
                                                                <!-- BEGIN: SERVICE ITEM -->
                                                                <div class="mx-auto text-center mt-10">
                                                                    <i data-feather="slash" class="w-16 h-16 flex-none rounded-full overflow-hidden mx-auto text-gray-600"></i>
                                                                    <div class="my-5">
                                                                        <div class="text-2xl">{{__('nenhum serviço cadastrado')}}</div>
                                                                    </div>
                                                                </div>
                                                                <!-- END: SERVICE ITEM-->
                                                            @endforelse

                                                        </div>
                                                    </div>
                                                    <!-- -->
                                                    <div class="chat__box__text-box w-full flex items-end float-left mb-4 hidden">
                                                        <div class="w-full bg-gray-200 dark:bg-dark-5 px-2 y-3 text-gray-700 dark:text-gray-300">
                                                            <pre>
                                                                {{print_r($CycleItem->cycleService->toArray())}}
                                                            </pre>
                                                            <div class="mt-1 text-xs text-gray-600">2 mins ago</div>
                                                        </div>

                                                    </div>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: SERVICE ITEM-->
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <!-- END: SERVICES DISPLAY -->
                        </div>
                        <!-- -->
                    </div>
                </div>

            </div>
        </div>
        <!-- END: Side Menu -->
    </div>

@endsection

@section('script')
    <script>
        $('#tableService').DataTable({
            dom: '',
            language: dataOptionsLanguage, pageLength: 50,
            buttons: dataOptionsButtons,
            ordering: true,
            order: [],
            columnDefs: [
                { orderable: false, targets: [5] },
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4 },
            ],
        });

        // $('#tableCycle').DataTable({
        //     dom: '',
        //     language: dataOptionsLanguage, pageLength: 50,
        //     buttons: dataOptionsButtons,
        //     ordering: true,
        //     order: [],
        //     columnDefs: [
        //         { orderable: false, targets: [4] },
        //         { "width": "5%", "targets": 4 },
        //     ],
        // });

        if("{{old('service_type_id')??false}}" && "{{old('service_category_id')??false}}" && "{{old('service_id')??false}}")
        {
            console.log('old service_type_id');
            console.log("{{old('service_type_id')}}");

            console.log('old service_category_id');
            console.log("{{old('service_category_id')}}");

            console.log('old service_id');
            console.log("{{old('service_id')}}");

            $.getJSON('/api/serviceType', function(serviceType)
            {
                console.log('serviceType');
                console.log(serviceType);

                if(serviceType == '')
                {
                    toastr.error("{{__('No service type to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceType, function (i, item) {

                    if(item.id == '{{old('service_type_id')}}')
                    {
                        $('#service_type_id').append(`<option value="${item.id}" selected>${item.ref_description}</option>`);
                    }
                    else
                    {
                        $('#service_type_id').append(`<option value="${item.id}">${item.ref_description}</option>`);
                    }
                });
            });

            $.getJSON('/api/serviceCategory/type/'+'{{old('service_type_id')}}', function(serviceCategory)
            {
                console.log('serviceCategory');
                console.log(serviceCategory);

                if(serviceCategory == '')
                {
                    toastr.error("{{__('No category to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceCategory, function (i, item) {

                    if(item.id == '{{old('service_category_id')}}')
                    {
                        $('#service_category_id').append(`<option value="${item.id}" selected>${item.ref_description}</option>`);
                    }
                    else
                    {
                        $('#service_category_id').append(`<option value="${item.id}">${item.ref_description}</option>`);
                    }
                });
            });

            $.getJSON('/api/service/category/'+'{{old('service_category_id')}}', function(services)
            {
                console.log('services');
                console.log(services);

                service = services;

                if(services == '')
                {
                    toastr.error("{{__('No service to display')}}", 'Ops!')
                    return;
                }

                $.each(services, function (i, item) {

                    if(item.id == '{{old('service_id')}}')
                    {
                        $('#service_id').append(`<option value="${item.id}" selected>${item.service_name}</option>`);
                    }
                    else
                    {
                        $('#service_id').append(`<option value="${item.id}">${item.service_name}</option>`);
                    }
                });
            });

            // OPEN MODAL
            cash('#modal-service-add').modal('show')
        }

        $('#btn-service-open-modal').on('click', function()
        {
            // using the function:
            selectOptionsRemove(document.getElementById('service_id'));
            selectOptionsRemove(document.getElementById('service_category_id'));
            selectOptionsRemove(document.getElementById('service_type_id'));

            document.getElementById("service_id").disabled = true;
            document.getElementById("service_category_id").disabled = true;

            $("#service_id").addClass('bg-gray-100 cursor-not-allowed');
            $("#service_category_id").addClass('bg-gray-100 cursor-not-allowed');

            $.getJSON('/api/serviceType', function(serviceType)
            {
                console.log('serviceType');
                console.log(serviceType);

                if(serviceType == '')
                {
                    toastr.error("{{__('No service type to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceType, function (i, item) {
                    $('#service_type_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });

        });

        $('#service_type_id').on('change', function()
        {
            // using the function:
            selectOptionsRemove(document.getElementById('service_id'));
            selectOptionsRemove(document.getElementById('service_category_id'));
            //
            $('#service_negotiated_amount').val(null);
            $('#service_negotiated_price').val(null);
            $('#service_negotiated_price_over').val(null);
            $('#service_negotiated_time_estimated').val(null);

            if($('#service_type_id').val() == '')
            {
                document.getElementById("service_id").disabled = true;
                document.getElementById("service_category_id").disabled = true;

                $("#service_id").addClass('bg-gray-100 cursor-not-allowed');
                $("#service_category_id").addClass('bg-gray-100 cursor-not-allowed');
                return;
            }

            $("#service_category_id").removeClass('bg-gray-100 cursor-not-allowed');
            document.getElementById("service_category_id").disabled = false;

            $.getJSON('/api/serviceCategory/type/'+$('#service_type_id').val(), function(serviceCategory)
            {
                console.log('serviceCategory');
                console.log(serviceCategory);

                if(serviceCategory == '')
                {
                    toastr.error("{{__('No category to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceCategory, function (i, item) {
                    $('#service_category_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });
        });

        let service;

        $('#service_category_id').on('change', function()
        {
            // using the function:
            selectOptionsRemove(document.getElementById('service_id'));
            //
            $('#service_negotiated_amount').val(null);
            $('#service_negotiated_price').val(null);
            $('#service_negotiated_price_over').val(null);
            $('#service_negotiated_time_estimated').val(null);

            if($('#service_category_id').val() == '')
            {
                $("#service_id").addClass('bg-gray-100 cursor-not-allowed');
                document.getElementById("service_id").disabled = true;
            }

            $("#service_id").removeClass('bg-gray-100 cursor-not-allowed');
            document.getElementById("service_id").disabled = false;

            $.getJSON('/api/service/category/'+$('#service_category_id').val(), function(services)
            {
                console.log('services');
                console.log(services);

                service = services;

                if(services == '')
                {
                    toastr.error("{{__('No service to display')}}", 'Ops!')
                    return;
                }

                $.each(services, function (i, item) {
                    $('#service_id').append($('<option>', {
                        value: item.id,
                        text : item.service_name
                    }));
                });
            });
        });

        $('#service_id').on('change', function()
        {
            let serviceId = $('#service_id').val();

            if(serviceId == '')
            {
                // SET VALUES DEFAULT
                $('#service_negotiated_amount').val('');
                $('#service_negotiated_price').val('');
                $('#service_negotiated_price_over').val('');
                $('#service_negotiated_time_estimated').val('');
                return;
            }

            console.log('service');
            console.log(service[serviceId]);

            // SET VALUES DEFAULT
            $('#service_negotiated_amount').val(1);
            $('#service_negotiated_price').val(service[serviceId].service_price);
            $('#service_negotiated_price_over').val(service[serviceId].service_price_over);
            $('#service_negotiated_time_estimated').val(service[serviceId].service_time_estimated);
        });

        $('#service_negotiated_price').maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
        });

        $('#service_negotiated_price_over').maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
        });

        let countService = "{{$countService}}";

        console.log('countService');
        console.log(countService);

        var i, L = countService - 1;

        for(i = L; i >= 0; i--) {

            $('#service_negotiated_price-'+i).maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });

            $('#service_negotiated_price_over-'+i).maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });
        }


        $('#tableCycle').DataTable({
            dom: '',
            language: dataOptionsLanguage, pageLength: 50,
            buttons: dataOptionsButtons,
            ordering: true,
            order: [],
            columnDefs: [
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4 },
                { orderable: false, targets: [6] },
            ],
        });

        //alert('EndAll');
    </script>
@endsection
