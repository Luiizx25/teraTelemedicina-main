@extends('_layout.side-menu',[
    'title' => 'Add Item Order',
    'useJquery' => false,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => false,
    'useToastr' => false,
])

@section('subcontent')
    <!-- BEGIN: Content -->
    <div class="">
        <div class="flex items-center mt-2">
            <h2 class="intro-y text-2xl font-medium mr-auto">
                {{__('Add Items')}}
            </h2>
        </div>
        <!-- -->
        <div class="intro-y box p-1 mt-4">

            <div class="grid grid-cols-12 gap-2">
                <div class="intro-y col-span-12 lg:col-span-6 px-2">
                    <div class="flex flex-1 pb-0 items-center justify-center lg:justify-start">
                        <div class="m-4">
                            <div class="image-cover h-16 w-full">
                                @empty($customer->cus_logo)
                                <img class="rounded h-16" src="{{asset('/app/images/default_profile.png')}}">
                                @else
                                <img class="rounded h-16" src="{{asset('storage/' . $customer->cus_logo)}}">
                                @endempty
                            </div>
                        </div>
                        <div class="mr-auto">
                            <div class="font-medium text-base">{{$customer->cus_name??'--'}}
                                @if ($customer->cus_name_company)
                                    | <span class="text-gray-600">{{$customer->cus_name_company}}</span>
                                    @endif
                                </div>
                                <p class="text-xs">{{ strtoupper($customer->cus_doc_type) }} {{$customer->cus_doc_num}}</p>
                                <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Customer')}} {{$customer->id}}</span></p>
                            </div>
                        </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6 p-2">
                    <!-- -->
                    <div class="intro-y col-span-12 lg:col-span-6">
                        @include('app.toCustomer._inc.wizard-steps')
                    </div>
                    <!-- -->
                </div>
            </div>

            <div class="intro-y flex flex-col sm:flex-row items-center p-2 mx-2">
                <h2 class="text-2xl font-medium mr-auto">
                    {{__('Order Details')}}
                </h2>

                <div class="dropdown">
                    <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <i data-feather="menu" class="w-5 h-5"></i>
                        </span>
                    </button>
                    <div class="dropdown-box w-40" id="_18hgyyal8" data-popper-placement="top-end" style="position: absolute; top: auto; right: auto; bottom: 0px; left: 0px; transform: translate(-124px, -37px);" data-popper-reference-hidden="" data-popper-escaped="">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4 mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Contacts </a>
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings w-4 h-4 mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> Settings </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2">
                <div class="intro-y col-span-12">
                    <div class="grid grid-cols-12 gap-2 p-2">
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                            <label class="text-xs text-gray-600">{{__('Order')}}</label>
                            <p class="font-medium">{{ $order->order_num }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Created at')}}</label>
                            <p class="font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('User')}}</label>
                            <p class="font-medium">{{ $order->user->name }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Type')}}</label>
                            <p class="font-medium">{{ $order->type->ref_description }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Status')}}</label>
                            <p class="font-medium">{{ $order->status->ref_description }}</p>
                        </div>


                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                            <label class="text-xs text-gray-600">{{__('Patient')}}</label>
                            <p class="font-medium">{{ $order->pat_name }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Genre')}}</label>
                            <p class="font-medium">{{ $order->pat_genre }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Age')}}</label>
                            <p class="font-medium">{{ getAge($order->pat_date_birth) }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Weight')}}</label>
                            <p class="font-medium">{{ $order->pat_weight }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Height')}}</label>
                            <p class="font-medium">{{ $order->pat_height }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="intro-y flex flex-col sm:flex-row items-center p-2 mx-2">
                <h2 class="text-2xl font-medium mr-auto">
                    {{__('Order Items')}}
                </h2>

                <a  href="javascript:;" data-toggle="modal" data-target="#modal-order-item-add" class="button px-2 box text-gray-700 dark:text-gray-300 shadow">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i data-feather="plus" class="w-5 h-5"></i>
                    </span>
                </a>
                <!-- BEGIN: Delete Confirmation Modal -->
                <div class="modal" id="modal-order-item-add">
                    <div class="modal__content modal__content--xl">
                        <!-- -->
                        <form id="form_service_add" action="{{route('toManager.service.store')}}" method="post">
                            @csrf

                            <div class="grid grid-cols-12 gap-2 mt-4">
                                <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12">

                                    <div class="py-2 px-5 border-b">
                                        <div class="text-2xl mt-2">{{__('Add Item')}}</div>
                                        @if (session('status_error'))
                                        <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                            <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                            <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="p-5">
                                        <div class="grid grid-cols-12 gap-2">
                                            <div class="col-span-12 sm:col-span-12 lg:col-span-12">
                                                <div class="mb-2">{{__('Service')}}</div>
                                                <select id="item_service_id" name="item_service_id" class="input w-full border flex-1" aria-required="" required>
                                                    <option value=""> -- </option>
                                                    @foreach ($services as $service_id => $service)
                                                        <option value="{{$service_id}}" @if($service_id == old('item_service_id')) selected @endif>{{ $service }}</option>
                                                    @endforeach
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
                                    </div>
                                </div>
                            </div>
                            <!-- -->
                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                                <button type="button" class="button w-24 bg-theme-1 text-white">{{__('Add')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->
            </div>

            <div class="intro-y mx-2 mt-2 mb-4">
                <div class="overflow-x-auto sm:overflow-x-visible accordion">
                    @empty($order->itens->count())
                        <h2 class="text-center p-4 bg-gray-100">{{__('Wait Items')}}</h2>
                    @else
                        @foreach ($order->itens as $item)
                            <div class="intro-y box shadow">
                                <div class="accordion__pane inbox__item inbox__item--active inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 dark:bg-dark-1 border-b border-gray-200 dark:border-dark-1">
                                    <div class="flex px-5 py-3">
                                        <div class="w-24 flex-none flex items-center mr-4 text-theme-6">
                                            <i data-feather="watch" class="w-5 h-5 mr-2"></i> {{__($item->status->ref_description??'--')}}
                                        </div>
                                        <div class="w-6/12 items-center">
                                            <a href="javascript:;" class="accordion__pane__toggle">
                                                <p class="inbox__item--highlight truncate ml-3">{{ $item->service->service_name }}</p>
                                                <p class="inbox__item--highlight truncate ml-3 text-xs text-gray-600">{{ $item->service->type->ref_description }}</p>
                                            </a>
                                        </div>

                                        <div class="inbox__item--time whitespace-no-wrap ml-auto pl-5 flex-none flex items-center">
                                            @empty($item->files)
                                                <i data-feather="cloud-off" class="w-5 h-5 mr-2 text-theme-6"></i>
                                            @else
                                                <div class=" text-theme-9 flex">
                                                    {{$item->files->count()}} <i data-feather="upload-cloud" class="w-5 h-5 ml-1"></i>
                                                </div>
                                            @endempty

                                        </div>
                                    </div>

                                    <div class="accordion__pane__content px-2 pb-2">
                                        <div class="grid grid-cols-12 gap-2 flex m-2 rounded-sm">

                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                                <p class="text-gray-600 text-xs">{{__('Created_at')}}</p>
                                                <p class="font-medium">{{ $item->created_at?$item->created_at->format('d/m/Y H:i'):'--' }}</p>
                                            </div>

                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                                <p class="text-gray-600 text-xs">{{__('Updated_at')}}</p>
                                                <p class="font-medium">{{ $item->updated_at?$item->updated_at->format('d/m/Y H:i'):'--' }}</p>
                                            </div>

                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                                <p class="text-gray-600 text-xs">{{__('Start of service')}}</p>
                                                <p class="font-medium">{{ $item->item_start_datetime?$item->item_start_datetime->format('d/m/Y H:i'):'--' }}</p>
                                            </div>

                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                                <p class="text-gray-600 text-xs">{{__('End of service')}}</p>
                                                <p class="font-medium">{{ $item->item_end_datetime?$item->item_end_datetime->format('d/m/Y H:i'):'--' }}</p>
                                            </div>

                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                                <p class="text-gray-600 text-xs">{{__('Conclusion')}}</p>
                                                <p class="font-medium">{{ $item->item_conclusion_datetime?$item->item_conclusion_datetime->format('d/m/Y H:i'):'--' }}</p>
                                            </div>

                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                                <p class="text-gray-600 text-xs">{{__('Item Price')}}</p>
                                                <p class="font-medium">
                                                    @empty($item->item_conclusion_price)
                                                        --
                                                    @else
                                                        R$ {{ number_format($item->item_conclusion_price, 2, '.', ',')}}
                                                    @endempty
                                                </p>
                                            </div>

                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12">
                                                <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                                                <p class="font-medium">{{ $item->item_comments??'--' }}</p>
                                            </div>

                                            <div class="rounded-sm w-full col-span-12">
                                                <p class="text-gray-600 text-xs ml-1">{{__('Files')}}</p>
                                                @empty($item->files)
                                                    <div class="bg-white text-center flex py-2 px-2 text-theme-6">
                                                        <i data-feather="cloud-off" class="w-5 h-5 mr-2"></i> {{__('No files attachment')}}
                                                    </div>
                                                @else
                                                    @foreach ($item->files as $file)
                                                        <div class="bg-white grid grid-cols-12 gap-2 flex my-2 p-2 rounded-sm shadow">

                                                            <div class="rounded-sm w-full col-span-12 sm:col-span-12 lg:col-span-2 flex-none flex items-center ">
                                                                <i data-feather="file" class="w-5 h-5 mr-2 text-theme-9"></i> {{ strtoupper($file->file_type) }}
                                                            </div>

                                                            <div class="rounded-sm w-full col-span-12 sm:col-span-12 lg:col-span-4 items-center">
                                                                <p class="text-gray-600 text-xs">{{__('File Description')}}</p>
                                                                <p class="inbox__item--highlight truncate">{{ $file->file_description }}</p>
                                                            </div>

                                                            <div class="rounded-sm w-full col-span-12 sm:col-span-12 lg:col-span-5 items-center">
                                                                <p class="text-gray-600 text-xs">{{__('File Comments')}}</p>
                                                                <p class="font-medium">{{ $file->file_comments??'--' }}</p>
                                                            </div>
                                                            <div class="rounded-sm w-full col-span-12 sm:col-span-12 lg:col-span-1 items-center text-right">
                                                                <div class="dropdown">
                                                                    <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300 border border-1 border-gray-300">
                                                                        <span class="w-5 h-5 flex items-center justify-center">
                                                                            <i data-feather="menu" class="w-4 h-4 text-theme-9"></i>
                                                                        </span>
                                                                    </button>
                                                                    <div class="dropdown-box w-40" data-popper-placement="bottom-end">
                                                                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                                                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md"><i data-feather="eye" class="flex w-5 h-5 mr-2 text-theme-9"></i> {{__('View')}}</a>
                                                                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md"><i data-feather="trash-2" class="flex w-5 h-5 mr-2 text-theme-9"></i> {{__('Delete')}}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endempty
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -->
                        @endforeach
                    @endempty
                </div>
            </div>

            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end m-5">
                <a href="#" class="button w-24 justify-center block bg-gray-100 text-gray-600 dark:bg-dark-1 dark:text-gray-300">Anterior</a>
                <button type="submit" class="button w-24 justify-center block bg-theme-1 text-white ml-2">Próximo</button>
            </div>

        </div>

@endsection



@section('script')
    <script>

        function modalOpenOrderItemAdd()
        {
            // OPEN MODAL
            cash('#modal-order-item-add').modal('show');
        }

        cash('#btn-modal-pat-search').on('click', function()
        {

        });

        cash(function ()
        {
            /*
            cpf.mask(pat_doc_num);
            mobile.mask(pat_phone_mobile);
            phone.mask(pat_phone);
            email.mask(pat_email);
            cep.mask(pat_postalcode);
            uf.mask(pat_state);

            $('#pat_weight').maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.',precision:3
            });

            $('#pat_height').maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });
            */
        });

    </script>
@endsection
