@extends('_layout.side-menu',[
    'title' => __('Contract View'),
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => true,
    'useToastr' => true,
])

@section('subcontent')
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('Provider Contract')}}
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <div class="intro-y box p-4">
                <div class="relative flex items-between">
                    <div class="mr-2">
                        <div class="font-medium text-base">{{$contract->provider->user->name??'--'}}
                            <p class="text-xs text-gray-600">{{ strtoupper($contract->provider->pvd_identity_type??'--') }} {{$contract->provider->pvd_identity_num??'--'}}</p>
                            @if ($contract->provider->cus_name_company)
                                <p class="text-gray-600 text-sm">{{$contract->provider->cus_name_company}}</p>
                            @endif
                        </div>
                        <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Provider')}} {{$contract->provider->id}}</span>
                    </div>
                    <div class="ml-auto">
                        <div class="w-16 h-16 image-fit">
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

        <div class="col-span-12 lg:col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12 box">

                    <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Contract Information')}}
                                <div class="text-gray-600 text-lg break-all">{{$contract->contract_num}}</div>
                            </h2>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                            <div class="dropdown-box">
                                <div class="dropdown-box__content box dark:bg-dark-1">
                                    <div class="p-2">
                                        <a href="{{route('toManager.providerContract.edit',[$contract->contract_num])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="edit-3" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('Edit')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-2">

                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-6 sm:col-span-2 lg:col-span-1">
                                <div class="text-gray-600 text-xs">{{__('Active')}}</div>
                                <div class="flex {{ $contract->active ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $contract->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i> {{$contract->active?__('Yes'):__('No')}}
                                </div>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-6 sm:col-span-3 lg:col-span-2">
                                <div class="text-gray-600 text-xs">{{__('Contract Type')}}</div>
                                <p class="font-medium">{{$contract->type->ref_description??'--'}}</p>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-7 lg:col-span-4">
                                <div class="text-gray-600 text-xs">{{__('Contract Number')}}</div>
                                <p class="font-medium">{{$contract->contract_num??'--'}}</p>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-4 sm:col-span-4 lg:col-span-3">
                                <div class="text-gray-600 text-xs">{{__('Pay option')}}</div>
                                <p class="font-medium">{{$contract->paymentOption->ref_description??'--'}}</p>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-4 sm:col-span-4 lg:col-span-2">
                                <div class="text-gray-600 text-xs">{{__('Payment date')}}</div>
                                <p class="font-medium">{{$contract->payment_day??'--'}}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-4 sm:col-span-4 lg:col-span-2">
                                <div class="text-gray-600 text-xs">{{__('Signing Date')}}</div>
                                <p class="font-medium">{{$contract->contract_date->format('d/m/Y')}}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-3">
                                <div class="text-gray-600 text-xs">{{__('Validity')}}</div>
                                <span class="text-gray-600">{{ __('From')}}</span>
                                <span class="font-medium">{{ $contract->contract_date_start->format('d/m/Y') }}</span>
                                <span class="text-gray-600">{{ __('to')}}</span>
                                <span class="font-medium">{{ $contract->contract_date_end->format('d/m/Y') }}</span>
                            </div>
                            <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-7">
                                <div class="text-gray-600 text-xs">{{__('Comments')}}</div>
                                <p class="font-medium">{{$contract->contract_comments??'--'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y chat grid grid-cols-12 gap-2">
        <!-- BEGIN: Side Menu -->
        <div class="col-span-12 lg:col-span-12 xxl:col-span-3 mt-3">
            <div class="chat_box box p-5">
                <div class="flex items-center">
                    <div class="mr-auto">
                        <h2 class="text-2xl font-medium mr-5">{{__('Services')}}</h2>
                    </div>
                    <div class="ml-auto">
                        <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button-sm py-1 px-2 rounded inline-block bg-theme-1 text-white">
                            <div class="flex items-center justify-center text-white">
                                <i data-feather="plus-square" class="flex w-4 h-4 mr-1 text-white"></i> {{__('Add')}}
                            </div>
                        </a>
                    </div>
                    <!-- MODAL -->
                    <div class="modal" id="modal-service-add">
                        <div class="modal__content modal__content--xl">
                            <form id="form_service_add" action="{{route('toManager.providerContractPvdService.store')}}" method="post">
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
                                                <div class="mb-2">{{__('Negotiated Price')}}</div>
                                                <div class="relative">
                                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                    <input type="text" id="service_negotiated_price" name="service_negotiated_price" value="{{old('service_negotiated_price')}}" class="input pl-12 w-full border col-span-4" />
                                                </div>
                                            </div>

                                            <div class="col-span-2 sm:col-span-6 lg:col-span-3">
                                                <div class="mb-2">{{__('Negotiated Time Estimated')}}</div>
                                                <input type="time" id="service_negotiated_time_estimated" name="service_negotiated_time_estimated" value="{{old('service_negotiated_time_estimated')}}" class="input w-full border flex-1" aria-required="" required>
                                            </div>

                                            <div class="col-span-2 sm:col-span-12 lg:col-span-6">
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
                </div>

                <!-- BEGIN:ALERTS -->
                @include('_inc/alertService')
                <!-- END:ALERTS -->

                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table id="tableService" class="table table-report -mt-2 display" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center whitespace-no-wrap">{{__('Active')}}</th>
                                <th class="whitespace-no-wrap">{{__('Name')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Value')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Time')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Edit')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $countService = $contract->contractService()->count();
                                //dd($contract->contractService);
                            @endphp
                            @forelse ($contract->contractService as $serviceKey => $serviceItem)
                                <tr class="intro-x shadow hover:shadow-lg">
                                    <td class="text-center">
                                        <div class="flex items-center justify-center {{ $serviceItem->active ? 'text-theme-9' : 'text-theme-6' }}">
                                            <i data-feather="{{ $serviceItem->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i>
                                        </div>
                                    </td>
                                    <td class="">
                                        {{$serviceItem->service->service_name}}
                                        <p class="text-xs whitespace-normal">{{$serviceItem->service->category->ref_description}}</p>
                                    </td>
                                    <td class="text-center">
                                        R$ {{number_format($serviceItem->service_negotiated_price, 2, ',', '.')}}
                                    </td>
                                    <td class="text-center">
                                        {{$serviceItem->service_negotiated_time_estimated}}
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-edit-{{$serviceItem->id}}" class="">
                                            <div class="flex items-center justify-center {{ $serviceItem->active ? 'text-theme-9' : 'text-theme-6' }}">
                                                <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit
                                            </div>
                                        </a>
                                        <!-- MODAL -->
                                        <div class="modal" id="modal-service-edit-{{$serviceItem->id}}">
                                            <div class="modal__content modal__content--xl">

                                                <form id="form_service_add" action="{{route('toManager.providerContractPvdService.update',['providerContractPvdService'=>$serviceItem->id])}}" method="post">
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
                                                                <div class="col-span-2 sm:col-span-6 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Active')}}</div>
                                                                    <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                                                                        <option value="1" @if (old('active',$serviceItem->active) == strval(1)) selected @endif>Sim</option>
                                                                        <option value="0" @if (old('active',$serviceItem->active) == strval(0)) selected @endif>Não</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-span-2 sm:col-span-6 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Negotiated Price')}}</div>
                                                                    <div class="relative">
                                                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                        <input type="text" id="service_negotiated_price-{{$serviceKey}}" name="service_negotiated_price" value="{{old('service_negotiated_price',$serviceItem->service_negotiated_price)}}" class="input pl-12 w-full border col-span-4" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-span-2 sm:col-span-6 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Negotiated Time Estimated')}}</div>
                                                                    <input type="time" id="service_negotiated_time_estimated-{{$serviceKey}}" name="service_negotiated_time_estimated" value="{{$serviceItem->service_negotiated_time_estimated}}" class="input w-full border flex-1" aria-required="" required>
                                                                </div>

                                                                <div class="col-span-2 sm:col-span-12 lg:col-span-6">
                                                                    <div class="mb-2">{{__('Comments')}}</div>
                                                                    <input type="text" id="service_negotiated_comments-{{$serviceKey}}" name="service_negotiated_comments" value="{{$serviceItem->service_negotiated_comments}}" class="input w-full border flex-1">
                                                                </div>

                                                                <div class="intro-y col-span-6 mt-2 text-left">
                                                                    <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-{{$serviceKey}}" class="button inline-block bg-theme-6 text-white">{{__('Delete Service')}}</a>
                                                                </div>

                                                                <div class="intro-y col-span-6 mt-2 text-right">
                                                                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                                    <button class="button bg-theme-1 text-white">{{__('Change')}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- -->
                                                <div class="modal" id="delete-modal-{{$serviceKey}}">
                                                    <div class="modal__content">
                                                        <form action="{{route('toManager.providerContractPvdService.destroy',['providerContractPvdService'=>$serviceItem->id])}}" method="post">
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
                { orderable: false, targets: [4] },
                { "width": "15%", "targets": 1 },
                { "width": "15%", "targets": 2 },
            ],
        });

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
            $('#service_negotiated_price').val(null);
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
            $('#service_negotiated_price').val(null);
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
                $('#service_negotiated_price').val('');
                $('#service_negotiated_time_estimated').val('');
                return;
            }

            console.log('service');
            console.log(service[serviceId]);

            // SET VALUES DEFAULT
            $('#service_negotiated_price').val(service[serviceId].service_price);
            $('#service_negotiated_time_estimated').val(service[serviceId].service_time_estimated);
        });

        $('#service_negotiated_price').maskMoney({
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

        //alert('EndAll');
    </script>
@endsection
