@extends('_layout.side-menu',[
    'title' => 'Order',
    'useJquery' => false,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => false,
    'useToastr' => false,
])

@section('subcontent')
    <div class="flex items-center mt-2">
        <h2 class="intro-y text-2xl font-medium mr-auto">
            {{__('Order')}}
        </h2>
        <!-- -->
        @php
            $orderComplete = (in_array($order->status_id,[40,50]))?true:false; // 40 = inserindo-itens / 50 = revisando-itens
            $orderCancel   = (in_array($order->status_id,[10,20,30,40,50,60]))?true:false; // 10 = paciente-qualificado / 20 = revisando-paciente / 30 = aguardando-itens / 60 = cadastrado
        @endphp
    </div>
    <!-- -->
    <div class="intro-y box p-2 mt-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="flex flex-1 items-center justify-center lg:justify-start">
                    <div class="m-2 shadow-md">
                        <div class="w-20 h-20 image-fit">
                            @empty($customer->cus_logo)
                            <img class="rounded" src="{{asset('/app/images/default_profile.png')}}">
                            @else
                            <img class="rounded" src="{{asset('storage/' . $customer->cus_logo)}}">
                            @endempty
                        </div>
                    </div>
                    <div class="mr-auto">
                        <div class="font-medium text-base">{{$customer->cus_name??'---'}}
                            @if ($customer->cus_name_company)
                                <p class="text-gray-600 text-xs">{{$customer->cus_name_company}}</p>
                            @endif
                        </div>
                        <p class="text-xs">{{ strtoupper($customer->cus_doc_type) }} {{$customer->cus_doc_num}}</p>
                        <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Customer')}} {{$customer->id}}</p>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6 text-right p-2">
                @if($order->deleted_at)
                <p class="inline-block bg-red-600 text-white rounded shadow py-1 px-2">
                    <span class="text-xs text-white">{{__('Canceled at')}}</span>
                    <span class="font-medium text-white">{{ $order->deleted_at?$order->deleted_at->format('d/m/Y H:i'):'---' }}</span>
                </p>
                @endif
            </div>
        </div>

        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- -->
            <div class="intro-y flex flex-col sm:flex-row items-center p-1 mx-2 mt-1">
                <h2 class="text-2xl font-medium mr-auto">
                    {{__('Details')}}
                </h2>
                @empty($order->deleted_at)
                    <!-- -->
                    @if (empty($order->deleted_at) && ($orderComplete || $orderCancel) )
                        <div class="dropdown">
                            <button class="dropdown-toggle button">
                                <span class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="menu" class="w-5 h-5"></i>
                                </span>
                            </button>
                            <div class="dropdown-box w-48" id="_18hgyyal8" data-popper-placement="top-end" style="position: absolute; top: auto; right: auto; bottom: 0px; left: 0px; transform: translate(-124px, -37px);" data-popper-reference-hidden="" data-popper-escaped="">
                                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                    @if ($orderComplete)
                                        <a href="javascript:;" data-toggle="modal" data-target="#success-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="check-circle" class="flex w-5 h-5 mr-2 text-theme-9"></i> {{__('Complete Order')}}
                                        </a>
                                        <!-- MODAL COMPLETE -->
                                        <div class="modal" id="success-modal-preview">
                                            <div class="modal__content">
                                                <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                                                    <div class="text-2xl mt-5">{{__('Can we finalize your order?')}}</div>
                                                    <div class="text-gray-600 mt-2">{{__('Click confirm to finish')}}</div>
                                                </div>
                                                <div class="px-5 pb-8 text-center">
                                                    <form action="{{ route('toCustomer.order.confirm',['orderNum'=>$orderNum])}}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                        <button type="submit" class="button w-24 bg-theme-9 text-white">{{__('Confirm')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- MODAL COMPLETE -->
                                    @endif
                                    @if ($orderCancel)
                                        <a href="javascript:;" id="btn-modal-order-cancel" data-toggle="modal" data-target="#modal-order-cancel" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="x-circle" class="flex w-5 h-5 mr-2 text-theme-6"></i> {{__('Cancel Order')}}
                                        </a>
                                        <!-- MODAL CANCEL -->
                                        <div class="modal" id="modal-order-cancel">
                                            <div class="modal__content">
                                                <div class="p-5 text-center">
                                                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                    <div class="text-2xl mt-5">{{__('Are you sure?')}}</div>
                                                    <div class="text-gray-600 mt-2">{{__('This process cannot be undone')}}</div>
                                                    <div class="mt-4 p-2 bg-gray-100 border-b border-gray-200 shadow-md">
                                                        <p class="text-sm">{{__('Order')}}</p>
                                                        <p class="text-xl">{{ $order->order_num }}</p>
                                                    </div>
                                                </div>
                                                <div class="px-5 pb-8 text-center">
                                                    <form action="{{ route('toCustomer.order.destroy',['order'=>$orderNum])}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Voltar')}}</button>
                                                        <button type="submit" class="button w-24 bg-theme-6 text-white">{{__('Cancel')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- MODAL CANCEL -->
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- -->
                @endempty
            </div>
            <!-- -->
            @include('app.toCustomer._inc.order-details')
        </div>

        <div class="intro-y flex flex-col sm:flex-row items-center p-2 mx-2">
            <h2 class="text-2xl font-medium mr-auto">
                {{__('Items')}}
            </h2>
            @php
                $insertItems = (in_array($order->status_id,[40]))?true:false;
            @endphp
            @if ($insertItems)
                <a  href="javascript:;" data-toggle="modal" data-target="#modal-order-item-add" class="button py-1 px-2 rounded inline-block bg-theme-1 text-white">
                    <div class="flex items-center justify-center text-white">
                        {{__('Add Item')}}
                    </div>
                </a>
                <!-- BEGIN: Add Order Item -->
                <div class="modal" id="modal-order-item-add">
                    <div class="modal__content modal__content--xl">
                        <!-- -->
                        <div class="py-2 px-5 border-b">
                            <div class="text-xl mt-2">{{__('Add Order Item')}}</div>
                            @if (session('status_error'))
                            <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                            </div>
                            @endif
                        </div>
                        @empty($cycleServices)
                            <div class="p-3">
                                <div class="text-xl p-2 rounded bg-theme-6 text-white">{{__('No Service this Contract')}}</div>
                            </div>
                        @else
                            <!-- -->
                            <form id="form_add" action="{{route('toCustomer.orderItem.store',['orderNum'=>$orderNum])}}" method="post">
                                @csrf
                                <input type="hidden" name="id_control" value="{{$idControle}}">
                                <div class="grid grid-cols-12 gap-2 p-3">
                                    <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12">
                                        <div class="p-2">
                                            <div class="grid grid-cols-12 gap-2">
                                                <div class="col-span-12 sm:col-span-12 lg:col-span-12">
                                                    <div class="mb-2">{{__('Select Service')}}</div>
                                                    <select id="item_service_id" name="item_service_id" class="input w-full border flex-1" aria-required="" required>
                                                        <option value=""> -- </option>
                                                        @foreach ($cycleServices as $cycleService)
                                                            <option value="{{$cycleService->id}}" @if($cycleService->id == old('item_service_id')) selected @endif>
                                                                {{ $cycleService->service->category->ref_description }} - {{ $cycleService->service->service_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-12 gap-2 mt-4">
                                                <div class="col-span-12 sm:col-span-12 lg:col-span-3">
                                                    <div class="mb-2">{{__('Date Run')}}</div>
                                                    <input type="date" id="item_run_datetime" name="item_run_datetime" value="{{old('item_run_datetime')}}" class="input w-full border flex-1" required aria-required="">
                                                </div>
                                                <div class="col-span-12 sm:col-span-12 lg:col-span-9">
                                                    <div class="mb-2">{{__('Comments')}}</div>
                                                    <input type="text" id="item_comments" name="item_comments" value="{{old('item_comments')}}" class="input w-full border flex-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- -->
                                <div class="px-5 pb-8 text-center">
                                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">{{__('Cancel')}}</button>
                                    <button type="submit" class="button w-24 bg-theme-1 text-white">{{__('Add')}}</button>
                                </div>
                            </form>
                            <!-- -->
                        @endempty


                    </div>
                </div>
                <!-- END: Add Order Item -->
            @endif
        </div>

        <div class="intro-y p-1 mx-2 mb-4">
            <div class="overflow-x-auto sm:overflow-x-visible accordion">
                @empty($order->itens->count())
                    <h2 class="text-center p-4 bg-gray-100">{{__('No Items registred')}}</h2>
                @else
                    @foreach ($order->itens as $item)
                        <div class="intro-y box shadow-md zoom-in rounded-md mb-4">
                            <div class="accordion__pane inbox__item inbox__item--active inline-block sm:block text-gray-700 dark:text-gray-500 bg-{{ $item->status->ref_color_bg??'gray-100' }} border-b border-gray-200 dark:border-dark-1 rounded-md">
                                <div class="">
                                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 justify-items-stretch h-auto itens-center">
                                        <div class="justify-start items-center py-2">
                                            <a href="javascript:;" class="accordion__pane__toggle">
                                                <p class="inbox__item--highlight truncate ml-4 text-xl">{{ $item->service->service_name }}</p>
                                            </a>
                                            <p class="inbox__item--highlight truncate ml-4 text-xs text-gray-600">{{ $item->item_num??'---' }} - {{ $item->service->type->ref_description }}</p>
                                        </div>
                                        <div class="justify-self-end flex justify-center items-center px-4 py-2 flex">
                                            <a href="javascript:;" class="accordion__pane__toggle">
                                                <div class="flex items-center">
                                                    <div class="flex-none text-right">
                                                        <div class="text-lg font-medium m-0 p-0">{{__($item->status->ref_description??'---')}}</div>
                                                        @if ($item->deleted_at)
                                                            <div class="text-gray-600 m-0 p-0">
                                                            {{$item->deleted_at->format('d/m/Y H:i')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-none ml-2 relative text-green-500">
                                                        <i data-feather="{{$item->status->ref_icon??'watch'}}" class="w-6 h-6"></i>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="w-10 ml-4 pl-4 flex-none flex items-center border-l">
                                                @empty($item->files)
                                                    <i data-feather="cloud-off" class="w-5 h-5 mr-2 text-theme-6"></i>
                                                @else
                                                    <div class=" text-theme-9 flex">
                                                        {{$item->files->count()}} <i data-feather="upload-cloud" class="w-5 h-5 ml-1"></i>
                                                    </div>
                                                @endempty
                                            </div>
                                            <div class="w-10 ml-6 pl-4 flex-none flex items-center border-l">
                                                <!-- -->
                                                @php
                                                    // ativo para editar
                                                    $editItems = in_array($item->item_status_id,[10])?true:false;
                                                @endphp
                                                <!-- -->
                                                @if($editItems)
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle" title=" {{__('Options')}}">
                                                            <i data-feather="menu" class="w-5 h-5 text-theme-6"></i>
                                                        </button>
                                                        <div class="dropdown-box w-48" data-popper-placement="bottom-end">
                                                            <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                                                <a href="javascript:;" data-toggle="modal" data-target="#modal-order-item-file-add-{{$item->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                                                    <div class="flex items-center justify-center flex">
                                                                        <i data-feather="paperclip" class="flex w-5 h-5 mr-2 text-theme-6"></i> {{__('Attach')}}
                                                                    </div>
                                                                </a>
                                                                <!-- BEGIN: Add Order Item -->
                                                                <div class="modal" id="modal-order-item-file-add-{{$item->id}}">
                                                                    <div class="modal__content modal__content--xl">
                                                                        <!-- -->
                                                                        <div class="py-2 px-5 border-b">
                                                                            <div class="text-xl mt-2">{{__('Attach file')}}</div>
                                                                            @if (session('status_error'))
                                                                            <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                                                <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                                                                <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                        <!-- -->
                                                                        <form id="form_add" action="{{route('toCustomer.orderItemFile.store')}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="orderNum" value="{{$order->order_num}}">
                                                                            <input type="hidden" name="orderItem" value="{{$item->id}}">
                                                                            <input type="hidden" name="itemNum" value="{{$item->item_num}}">
                                                                            <div class="grid grid-cols-12 gap-2 p-3">
                                                                                <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12">
                                                                                    <div class="grid grid-cols-12 gap-2 p-2">
                                                                                        <div class="col-span-12 sm:col-span-12 lg:col-span-12">
                                                                                            <div class="mb-2">{{__('Files')}}</div>
                                                                                            <input id="file" name="file" value="{{ old('file') }}" type="file" class="input w-full border py-1 flex-1">
                                                                                            @error('file')
                                                                                            <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-span-12 sm:col-span-12 lg:col-span-12">
                                                                                            <div class="mb-2">{{__('Description')}}</div>
                                                                                            <input type="text" id="file_description" name="file_description" value="{{old('file_description')}}" class="input w-full border flex-1">
                                                                                            @error('file_description')
                                                                                                <div id="error-name" class="input-error text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- -->
                                                                            <div class="px-5 pb-8 text-center">
                                                                                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">{{__('Cancel')}}</button>
                                                                                <button type="submit" class="button zoom-in w-24 bg-theme-1 text-white">{{__('Add')}}</button>
                                                                            </div>
                                                                        </form>
                                                                        <!-- -->
                                                                    </div>
                                                                </div>
                                                                <!-- END: Add Order Item -->
                                                                @if($item->files->count())
                                                                    <form action="{{route('toCustomer.orderItem.finalizeRegistration',['orderNum'=>$order->order_num,'orderItem'=>$item->id])}}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="flex items-center block p-2 w-full transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                                                            <i data-feather="check-circle" class="flex w-5 h-5 mr-2 text-theme-6"></i> {{__('Finalize Registration')}}
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                <a href="javascript:;" data-toggle="modal" data-target="#modal-order-item-cancel-{{$item->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="x-circle" class="flex w-5 h-5 mr-2 text-theme-6"></i> {{__('Cancel')}}
                                                                </a>
                                                                <!-- MODAL CANCEL -->
                                                                <div class="text-center">
                                                                    <div class="modal" id="modal-order-item-cancel-{{$item->id}}">
                                                                        <div class="modal__content">
                                                                            <div class="p-5 text-center">
                                                                                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                                                <div class="text-2xl mt-5">{{__('Are you sure?')}}</div>
                                                                                <div class="text-gray-600 mt-2">{{__('This process cannot be undone')}}</div>
                                                                                <p class="text-xl mt-4 p-2 bg-gray-100 border-b border-gray-200 shadow-md">{{ $item->service->service_name }}</p>
                                                                            </div>
                                                                            <div class="px-5 pb-8 text-center">
                                                                                <form action="{{ route('toCustomer.orderItem.destroy',['orderNum'=>$orderNum])}}" method="post">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input type="hidden" name="orderItem" value="{{ $item->id }}">
                                                                                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Voltar')}}</button>
                                                                                    <button type="submit" class="button w-24 bg-theme-6 text-white">{{__('Cancel')}}</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- MODAL CANCEL -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <i data-feather="menu" class="w-5 h-5 text-theme-4"></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion__pane__content px-2 pb-2">
                                        <div class="grid grid-cols-12 gap-2 flex m-2 rounded-sm">
                                            <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                            <p class="text-gray-600 text-xs">{{__('Created_at')}}</p>
                                            <p class="font-medium">{{ $item->created_at?$item->created_at->format('d/m/Y H:i'):'---' }}</p>
                                        </div>
                                        <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                            <p class="text-gray-600 text-xs">{{__('Updated_at')}}</p>
                                            <p class="font-medium">{{ $item->updated_at?$item->updated_at->format('d/m/Y H:i'):'---' }}</p>
                                        </div>
                                        <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                            <p class="text-gray-600 text-xs">{{__('Start of service')}}</p>
                                            <p class="font-medium">{{ $item->item_start_datetime?$item->item_start_datetime->format('d/m/Y H:i'):'---' }}</p>
                                        </div>
                                        <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                            <p class="text-gray-600 text-xs">{{__('End of service')}}</p>
                                            <p class="font-medium">{{ $item->item_end_datetime?$item->item_end_datetime->format('d/m/Y H:i'):'---' }}</p>
                                        </div>
                                        <div class="bg-white rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                            <p class="text-gray-600 text-xs">{{__('Conclusion')}}</p>
                                            <p class="font-medium">{{ $item->item_conclusion_datetime?$item->item_conclusion_datetime->format('d/m/Y H:i'):'---' }}</p>
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
                                            <p class="font-medium">{{ $item->item_comments??'---' }}</p>
                                        </div>
                                        <div class="rounded-sm w-full col-span-12">
                                            <p class="text-gray-600 m-1">{{__('Files')}}</p>
                                            @empty($item->files->count())
                                                <div class="bg-white text-center flex p-4 text-theme-6">
                                                    <i data-feather="cloud-off" class="w-5 h-5 mr-2"></i> {{__('No files attachment')}}
                                                </div>
                                            @else
                                                <div class="intro-y grid grid-cols-12 sm:gap-6 mt-2">
                                                    @foreach ($item->files as $file)
                                                        <!-- -->
                                                        <div class="intro-y col-span-6 sm:col-span-4 md:col-span-2 xxl:col-span-2">
                                                            <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in border shadow">
                                                                <a href="#" class="w-3/5 file__icon file__icon--file mx-auto">
                                                                    <div class="file__icon__file-name">{{ strtoupper($file->file_type??'ND') }}</div>
                                                                </a>
                                                                <span class="block text-xs mt-1 text-center truncate">{{ $file->file_name??'---' }}</span>
                                                                <div class="text-gray-600 text-xs text-center">{{ number_format(($file->file_size??'0')/1024, 2, ',', '.') }} KB</div>
                                                                <a href="#" class="block bg-gray-100 rounded-md shadow px-2 py-1 w-full font-medium mt-2 text-center truncate" title="{{ $file->file_description??'---' }}">{{ $file->file_description??'---' }}</a>
                                                                <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                                                    @if($editItems??false)
                                                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;">
                                                                            <i data-feather="more-vertical" class="w-5 h-5 mr-2"></i>
                                                                        </a>
                                                                        <div class="dropdown-box w-40" style="z-index: 50;">
                                                                            <div class="dropdown-box__content box dark:bg-dark-1 p-2 z-10">
                                                                                <a href="javascript:;" data-toggle="modal" data-target="#modal-order-item-file-delete-{{$file->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><i data-feather="trash" class="w-5 h-5 mr-2"></i> {{__('Delete')}} </a>
                                                                                <!-- MODAL CANCEL -->
                                                                                <div class="text-center">
                                                                                    <div class="modal" id="modal-order-item-file-delete-{{$file->id}}">
                                                                                        <div class="modal__content z-50">
                                                                                            <div class="p-5 text-center">
                                                                                                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                                                                <div class="text-2xl mt-5">{{__('Are you sure?')}}</div>
                                                                                                <div class="text-gray-600 mt-2">{{__('This process cannot be undone')}}</div>
                                                                                                <p class="text-xl mt-4 p-2 bg-gray-100 border-b border-gray-200 shadow-md">{{ $file->file_name??'---' }}</p>
                                                                                            </div>
                                                                                            <div class="px-5 pb-8 text-center">
                                                                                                <form action="{{ route('toCustomer.orderItemFile.destroy',['orderItemFile'=>$file->id])}}" method="post">
                                                                                                    @csrf
                                                                                                    @method('DELETE')
                                                                                                    <input type="hidden" name="orderNum" value="{{ $orderNum }}">
                                                                                                    <input type="hidden" name="orderItem" value="{{ $item->id }}">
                                                                                                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                                                                    <button type="submit" class="button w-24 bg-theme-6 text-white">{{__('Delete')}}</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- MODAL CANCEL -->
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- -->
                                                    @endforeach
                                                </div>
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
    </div>

@endsection



@section('script')
    <script>

        function modalOpenOrderItemAdd()
        {
            // OPEN MODAL
            cash('#modal-order-item-add').modal('show');
        }

        cash('#btn-modal-order-cancel').on('click', function()
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
