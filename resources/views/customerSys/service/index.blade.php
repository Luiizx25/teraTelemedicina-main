@extends('_layout.side-menu',[
    'title' => __('Services'),
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => true,
    'useToastr' => true,
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-2">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <h2 class="text-2xl font-medium my-2 truncate">{{__('Services')}}</h2>
            <div class="ml-auto mt-2">
                <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto">
                    {{__('New Service')}}
                </a>
            </div>
            <!-- MODAL -->
            <div class="modal" id="modal-service-add">
                <div class="modal__content modal__content--xl">
                    <form id="form_service_add" action="{{route('toManager.service.store')}}" method="post">
                        @csrf
                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                <div class="mr-auto">
                                    <h2 class="font-medium text-base mr-auto">{{__('New Service')}}</h2>
                                </div>
                                @if (session('status_error'))
                                <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-2">
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-6">
                                        <div class="mb-2">{{__('Service Type')}}</div>
                                        <select id="type_id" name="type_id" class="input w-full border flex-1" aria-required="" required>
                                            <option value=""> -- </option>
                                        </select>
                                    </div>

                                    <div class="col-span-12 sm:col-span-12 lg:col-span-6">
                                        <div class="mb-2">{{__('Service Category')}}</div>
                                        <select id="category_id" name="category_id" class="input w-full border flex-1" aria-required="" required>
                                            <option value=""> -- </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-4">
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-4">
                                        <div class="mb-2">{{__('Service Name')}}</div>
                                        <input type="text" id="service_name" name="service_name" value="{{old('service_name')}}" class="input w-full border flex-1" aria-required="" required>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-8">
                                        <div class="mb-2">{{__('Service Description')}}</div>
                                        <input type="text" id="service_description" name="service_description" value="{{old('service_description')}}" class="input w-full border flex-1">
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-4">
                                    <div class="input w-full col-span-12 sm:col-span-12 lg:col-span-6 box border shadow-md">
                                        <h2 class="font-medium text-base mr-auto border-b pb-1">{{__('For Customers')}}</h2>
                                        <div class="grid grid-cols-6 gap-2 mt-4">
                                            <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                <div class="mb-2">{{__('Price Unit')}}</div>
                                                <div class="relative">
                                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                    <input type="text" id="service_price" name="service_price" value="{{old('service_price')}}" class="input pl-12 w-full border col-span-4" />
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                <div class="mb-2">{{__('Price Over')}}</div>
                                                <div class="relative">
                                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                    <input type="text" id="service_price_over" name="service_price_over" value="{{old('service_price_over')}}" class="input pl-12 w-full border col-span-4" />
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                <div class="mb-2">{{__('Time Estimated')}}</div>
                                                <input type="time" id="service_time_estimated" name="service_time_estimated" value="{{old('service_time_estimated')}}" class="input w-full border flex-1" min="00:00" aria-required="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input w-full col-span-12 sm:col-span-12 lg:col-span-6 box border shadow-md">
                                        <h2 class="font-medium text-base mr-auto border-b pb-1">{{__('For Providers')}}</h2>
                                        <div class="grid grid-cols-6 gap-2 mt-4">
                                            <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                <div class="mb-2">{{__('Price Unit')}}</div>
                                                <div class="relative">
                                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                    <input type="text" id="service_pvd_price" name="service_pvd_price" value="{{old('service_pvd_price')}}" class="input pl-12 w-full border col-span-4" />
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                <div class="mb-2">{{__('Price Over')}}</div>
                                                <div class="relative">
                                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                    <input type="text" id="service_pvd_price_over" name="service_pvd_price_over" value="{{old('service_pvd_price_over')}}" class="input pl-12 w-full border col-span-4" />
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                <div class="mb-2">{{__('Time Estimated')}}</div>
                                                <input type="time" id="service_pvd_time_estimated" name="service_pvd_time_estimated" value="{{old('service_pvd_time_estimated')}}" class="input w-full border flex-1" min="00:00" aria-required="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-4">
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
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4">
            <table id="table_services" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Status')}}</th>
                        <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Category')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Name')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Unit')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Over')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Time')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = $services->count();
                    @endphp
                    @foreach ($services as $serviceKey => $serviceItem)
                        <tr class="intro-x shadow hover:shadow-lg">
                            <td class="">
                                <div class="flex items-center justify-center {{ $serviceItem->active ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $serviceItem->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i>
                                </div>
                            </td>
                            <td class="text-center">
                                {{$serviceItem->category->ref_description}}
                                <p class="text-gray-600 text-xs ">{{$serviceItem->type->ref_description}}</p>
                            </td>
                            <td>
                                {{$serviceItem->service_name}}
                                <p class="text-gray-600 text-xs whitespace-normal">{{$serviceItem->service_description}}</p>
                            </td>
                            <td class="text-center w-25">
                                <p class="flex py-2 text-xs whitespace-no-wrap" title="{{__('Customer')}}">
                                    <i data-feather="briefcase" class="w-4 h-4 mr-1"></i> R$ {{$serviceItem->service_price?number_format($serviceItem->service_price, 2, ',', '.'):'--'}}
                                </p>
                                <hr>
                                <p class="flex py-2 text-xs whitespace-no-wrap" title="{{__('Provider')}}">
                                    <i data-feather="pen-tool" class="w-4 h-4 mr-1"></i> R$ {{$serviceItem->service_pvd_price?number_format($serviceItem->service_pvd_price, 2, ',', '.'):'--'}}
                                </p>
                            </td>
                            <td class="text-center w-25">
                                <p class="flex py-2 text-xs whitespace-no-wrap" title="{{__('Customer')}}">
                                    <i data-feather="briefcase" class="w-4 h-4 mr-1"></i> R$ {{$serviceItem->service_price_over?number_format($serviceItem->service_price_over, 2, ',', '.'):'--'}}
                                </p>
                                <hr>
                                <p class="flex py-2 text-xs whitespace-no-wrap" title="{{__('Provider')}}">
                                    <i data-feather="pen-tool" class="w-4 h-4 mr-1"></i> R$ {{$serviceItem->service_pvd_price_over?number_format($serviceItem->service_pvd_price_over, 2, ',', '.'):'--'}}
                                </p>
                            </td>
                            <td class="text-center w-25">
                                <p class="flex py-2 text-xs whitespace-no-wrap" title="{{__('Customer')}}">
                                    <i data-feather="briefcase" class="w-4 h-4 mr-1"></i> {{$serviceItem->service_time_estimated}}
                                </p>
                                <hr>
                                <p class="flex py-2 text-xs whitespace-no-wrap" title="{{__('Provider')}}">
                                    <i data-feather="pen-tool" class="w-4 h-4 mr-1"></i> {{$serviceItem->service_pvd_time_estimated}}
                                </p>
                            </td>
                            <td class="table-report__action w-20">
                                <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-edit-{{$serviceItem->id}}" class="">
                                    <div class="flex items-center justify-center {{ $serviceItem->active ? 'text-theme-9' : 'text-theme-6' }}">
                                        <i data-feather="edit" class="w-4 h-4 mr-1"></i> {{__('Edit')}}
                                    </div>
                                </a>
                                <!-- MODAL -->
                                <div class="modal" id="modal-service-edit-{{$serviceItem->id}}">
                                    <div class="modal__content modal__content--xl">
                                        <form id="form_service_add" action="{{route('toManager.service.update',['service'=>$serviceItem->id])}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="service_slug" value="{{$serviceItem->service_slug}}">

                                            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                                                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                                    <div class="mr-auto">
                                                        <h2 class="font-medium text-base mr-auto">{{__('Edit Service')}}</h2>
                                                    </div>
                                                    @if (session('status_error'))
                                                    <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                        <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                                        <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="p-5">
                                                    <div class="grid grid-cols-12 gap-2">
                                                        <div class="col-span-12 sm:col-span-12 lg:col-span-6">
                                                            <div class="mb-2">{{__('Service Type')}}</div>
                                                            <input value="{{ $serviceItem->type->ref_description }}" class="input w-full border flex-1" disabled>
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-12 lg:col-span-6">
                                                            <div class="mb-2">{{__('Service Category')}}</div>
                                                            <select id="category_id-{{$serviceKey}}" name="category_id" class="input w-full border flex-1" aria-required="" required>
                                                                <option value=""> -- </option>
                                                                @foreach ($RefServiceCategory as $category)
                                                                <option value="{{$category->id}}" {{($category->id==old('category_id',$serviceItem->category_id))?'selected':null}}>{{$category->ref_description}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="col-span-12 sm:col-span-4 lg:col-span-4">
                                                            <div class="mb-2">{{__('Service Name')}}</div>
                                                            <input type="text" id="service_name-{{$serviceKey}}" name="service_name" value="{{old('service_name',$serviceItem->service_name)}}" class="input w-full border flex-1" aria-required="" required>
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-8 lg:col-span-8">
                                                            <div class="mb-2">{{__('Service Description')}}</div>
                                                            <input type="text" id="service_description-{{$serviceKey}}" name="service_description" value="{{old('service_description',$serviceItem->service_description)}}" class="input w-full border flex-1">
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="input w-full col-span-12 sm:col-span-12 lg:col-span-6 box border shadow-md">
                                                            <h2 class="font-medium text-base mr-auto border-b pb-1">{{__('For Customers')}}</h2>
                                                            <div class="grid grid-cols-6 gap-2 mt-4">
                                                                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Price Unit')}}</div>
                                                                    <div class="relative">
                                                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                        <input type="text" id="service_price-{{$serviceKey}}" name="service_price" value="{{old('service_price',$serviceItem->service_price)}}" class="input pl-12 w-full border col-span-4" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Price Over')}}</div>
                                                                    <div class="relative">
                                                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                        <input type="text" id="service_price_over-{{$serviceKey}}" name="service_price_over" value="{{old('service_price_over',$serviceItem->service_price_over)}}" class="input pl-12 w-full border col-span-4" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Time Estimated')}}</div>
                                                                    <input type="time" id="service_time_estimated" name="service_time_estimated" value="{{old('service_time_estimated',$serviceItem->service_time_estimated)}}" class="input w-full border flex-1" min="00:00" aria-required="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input w-full col-span-12 sm:col-span-12 lg:col-span-6 box border shadow-md">
                                                            <h2 class="font-medium text-base mr-auto border-b pb-1">{{__('For Providers')}}</h2>
                                                            <div class="grid grid-cols-6 gap-2 mt-4">
                                                                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Price Unit')}}</div>
                                                                    <div class="relative">
                                                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                        <input type="text" id="service_pvd_price-{{$serviceKey}}" name="service_pvd_price" value="{{old('service_pvd_price',$serviceItem->service_pvd_price)}}" class="input pl-12 w-full border col-span-4" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Price Over')}}</div>
                                                                    <div class="relative">
                                                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                                        <input type="text" id="service_pvd_price_over-{{$serviceKey}}" name="service_pvd_price_over" value="{{old('service_pvd_price_over',$serviceItem->service_pvd_price_over)}}" class="input pl-12 w-full border col-span-4" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                                                                    <div class="mb-2">{{__('Time Estimated')}}</div>
                                                                    <input type="time" id="service_pvd_time_estimated" name="service_pvd_time_estimated" value="{{old('service_pvd_time_estimated',$serviceItem->service_pvd_time_estimated)}}" class="input w-full border flex-1" min="00:00" aria-required="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-left">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-{{$serviceKey}}" class="button inline-block bg-theme-6 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Delete Service')}}</a>
                                                        </div>
                                                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-right">
                                                            <button type="button" data-dismiss="modal" class="button w-full sm:w-1/2 lg:w-auto border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1 mt-2">{{__('Cancel')}}</button>
                                                            <button class="button bg-theme-1 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Change')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- -->
                                        <div class="modal" id="delete-modal-{{$serviceKey}}">
                                            <div class="modal__content">
                                                <form action="{{route('toManager.service.destroy',['service'=>$serviceItem->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
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
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')
    <script>
        $('#table_services').DataTable({
            dom: 'Bfrtip',
            language: dataOptionsLanguage, pageLength: 50,
            buttons: dataOptionsButtons,
            ordering: true,
            order: [],
            columnDefs: [
                { "width": "5%", "targets": 0 },
                { orderable: false, targets: [6] },
            ]
        });

        if("{{old('type_id')??false}}" && "{{old('category_id')??false}}")
        {
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

                    if(item.id == '{{old('type_id')}}')
                    {
                        $('#type_id').append(`<option value="${item.id}" selected>${item.ref_description}</option>`);
                    }
                    else
                    {
                        $('#type_id').append(`<option value="${item.id}">${item.ref_description}</option>`);
                    }
                });
            });

            $.getJSON('/api/serviceCategory/type/'+'{{old('type_id')}}', function(serviceCategory)
            {
                console.log('serviceCategory');
                console.log(serviceCategory);

                if(serviceCategory == '')
                {
                    toastr.error("{{__('No category to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceCategory, function (i, item) {

                    if(item.id == '{{old('category_id')}}')
                    {
                        $('#category_id').append(`<option value="${item.id}" selected>${item.ref_description}</option>`);
                    }
                    else
                    {
                        $('#category_id').append(`<option value="${item.id}">${item.ref_description}</option>`);
                    }
                });
            });

            // OPEN MODAL
            cash('#modal-service-add').modal('show')
        }

        $('#btn-service-open-modal').on('click', function()
        {
            if("{{old('type_id')??false}}" && "{{old('category_id')??false}}")
                return;

            // using the function:
            selectOptionsRemove(document.getElementById('category_id'));
            selectOptionsRemove(document.getElementById('type_id'));

            document.getElementById("category_id").disabled = true;

            $("#category_id").addClass('bg-gray-100 cursor-not-allowed');

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
                    $('#type_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });

        });

        $('#type_id').on('change', function()
        {
            // using the function:
            selectOptionsRemove(document.getElementById('category_id'));

            if($('#type_id').val() == '')
            {
                document.getElementById("category_id").disabled = true;
                $("#category_id").addClass('bg-gray-100 cursor-not-allowed');
                return;
            }

            $("#category_id").removeClass('bg-gray-100 cursor-not-allowed');
            document.getElementById("category_id").disabled = false;

            $.getJSON('/api/serviceCategory/type/'+$('#type_id').val(), function(serviceCategory)
            {
                console.log('serviceCategory');
                console.log(serviceCategory);

                if(serviceCategory == '')
                {
                    toastr.error("{{__('No category to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceCategory, function (i, item) {
                    $('#category_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });
        });

        $('#service_price').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });
        $('#service_price_over').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });
        $('#service_pvd_price').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });
        $('#service_pvd_price_over').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });

        let count = "{{$count}}";

        console.log('count');
        console.log(count);

        var i, L = count - 1;

        for(i = L; i >= 0; i--) {

            $('#service_price-'+i).maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });

            $('#service_price_over-'+i).maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });

            $('#service_pvd_price-'+i).maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });

            $('#service_pvd_price_over-'+i).maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });
        }

    </script>
@endsection
