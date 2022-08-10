@extends('_layout.side-menu',[
    'title' => 'Order',
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => false,
    'useToastr' => false,
])

@section('subcontent')
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('Order')}}
                </div>
                <div class="text-base text-gray-600 mt-1">{{ $order->order_num }}</div>
            </div>
            @if($order->deleted_at)
            <div class="ml-auto">
                <p class="inline-block px-2 bg-red-600 shadow-md rounded">
                    <span class="font-semibold text-1xl text-white">{{__('Canceled at')}} {{ $order->deleted_at?$order->deleted_at->format('d/m/Y H:i'):'---' }}</span>
                </p>
            </div>
            @endif
        </div>
    </div>
    <!-- -->
    <div class="intro-y box p-2 mt-2">

        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- -->
            <div class="intro-y flex flex-col sm:flex-row items-center p-1 mx-2 mt-1">
                <h2 class="text-2xl font-medium mr-auto">
                    {{__('Details')}}
                </h2>
            </div>
            <!-- -->
            @include('app.toCustomer._inc.order-details')
        </div>

        <div class="intro-y flex flex-col sm:flex-row items-center p-2 mx-2">
            <h2 class="text-2xl font-medium mr-auto">
                {{__('Items')}}
            </h2>
        </div>

        <div class="intro-y p-1 mx-2 mb-4">
            <div class="overflow-x-auto sm:overflow-x-visible accordion">
                @empty($order->itens->count())
                    <h2 class="text-center p-4 bg-gray-100">{{__('No Items registred')}}</h2>
                @else
                    @foreach ($order->itens as $item)
                        <div class="intro-y box shadow-md zoom-in rounded-md mb-4 border-{{ $item->status->ref_color_bg }}">
                            <div class="accordion__pane inbox__item inbox__item--active inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 }} border-b border-gray-200 dark:border-dark-1 rounded-md">
                                <div class="">
                                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 justify-items-stretch h-auto itens-center">
                                        <div class="justify-start items-center ml-4 py-2">
                                            <a href="javascript:;" class="accordion__pane__toggle">
                                                <p class="text-xl font-bold">{{ $item->service->service_name }}</p>
                                                <p class="text-sm font-light"><span class="text-xs text-gray-600">Exame realizado em:</span>  {{ $item->item_run_datetime->format('d/m/Y')}}</p>
                                            </a>
                                            <p class="inbox__item--highlight mt-1 pt-1 border-t truncate text-xs text-gray-600">{{ $item->item_num??'---' }} - {{ $item->service->type->ref_description }}</p>
                                        </div>
                                        <div class="justify-self-end flex justify-center items-center px-4 py-2 flex">
                                            <a href="javascript:;" class="accordion__pane__toggle">
                                                <div class="flex items-center text-{{ $item->status->ref_color_bg=='gray-100'?'theme-1':$item->status->ref_color_bg}}">

                                                    <div class="flex-none text-center">
                                                        <div class="flex text-base font-medium m-0 p-0 uppercase">
                                                            {{__($item->status->ref_description??'---')}}
                                                            <i data-feather="{{ $item->status->ref_icon??'watch'}}" class="w-6 h-6 ml-2"></i>
                                                        </div>
                                                        @if ($item->deleted_at)
                                                            <div class="m-0 p-0">{{$item->deleted_at->format('d/m/Y H:i')}}</div>
                                                        @endif
                                                        @if ( in_array($item->status->id,[100]) )
                                                            <div class="m-0 p-0">{{$item->updated_at->format('d/m/Y H:i')}}</div>
                                                        @endif
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
                                                    $editItems          = in_array($item->item_status_id,[10])?true:false;
                                                    $itemCompleteReturn = in_array($item->item_status_id,[60])?true:false;
                                                @endphp
                                                <!-- -->
                                                @if($editItems || $itemCompleteReturn)
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle" title=" {{__('Options')}}">
                                                            <i data-feather="menu" class="w-5 h-5 text-theme-4"></i>
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

                                                                @if($editItems)
                                                                    <form action="{{route('toCustomer.orderItem.finalizeRegistration',['orderNum'=>$order->order_num,'orderItem'=>$item->id])}}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="flex items-center block p-2 w-full transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                                                            <i data-feather="check-circle" class="flex w-5 h-5 mr-2 text-theme-6"></i> {{__('Finalize Registration')}}
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                @if($itemCompleteReturn)
                                                                    <form action="{{route('toCustomer.orderItem.finalizeCompleteReturn',['orderNum'=>$order->order_num,'orderItem'=>$item->id])}}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="flex items-center block p-2 w-full transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                                                            <i data-feather="check-circle" class="flex w-5 h-5 mr-2 text-theme-6"></i>  {{__('Concluir')}}</button>
                                                                    </form>
                                                                @endif



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
                                                    <i data-feather="award" class="w-5 h-5 text-theme-4"></i>
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
                                    </div>
                                    {{--  --}}
                                    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                                        <!-- BEGIN: Ticket -->
                                        <div class="col-span-12 lg:col-span-12">
                                            <div class="intro-y pr-1">
                                                <div class="box p-2">
                                                    <div class="pos__tabs nav-tabs justify-center flex">
                                                        <a data-toggle="tab" data-target="#order_item_request-{{$item->id}}" href="javascript:;" class="active flex-1 py-2 rounded-md text-center">Solicitação</a>
                                                        @if ($item->item_conclusion_datetime)
                                                            <a data-toggle="tab" data-target="#order_item_conclusion-{{$item->id}}" href="javascript:;" class=" flex-1 py-2 rounded-md text-center">Conclusão</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-content">
                                                <!-- -->
                                                <div class="tab-content__pane active" id="order_item_request-{{$item->id}}">

                                                    <div class="intro-y flex flex-col sm:flex-row items-center p-2 mt-2 mx-2">
                                                        <h2 class="text-2xl font-medium mr-auto">{{__('Anexos do Pedido')}}</h2>
                                                        <!-- -->
                                                        @php
                                                            // ativo para editar
                                                            $itemEditActive     = in_array($item->item_status_id,[10])?true:false;
                                                            $itemCompleteReturn = in_array($item->item_status_id,[60])?true:false;
                                                        @endphp
                                                        <!-- -->
                                                        @if($itemEditActive || $itemCompleteReturn)
                                                        <div class="ml-auto">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#modal-order-item-file-add" class="button zoom-in py-1 px-2 rounded shadow inline-block bg-theme-1 text-white">
                                                                <div class="flex items-center justify-center text-white flex">
                                                                    <i data-feather="paperclip" class="w-4 h-4 mr-1"></i> {{__('Add')}}
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <!-- BEGIN: Add Order Item -->
                                                            <div class="modal" id="modal-order-item-file-add">
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
                                                        @endif
                                                    </div>
                                                    <div class="intro-y mx-2 mb-4">
                                                        <div class="overflow-x-auto sm:overflow-x-visible accordion">
                                                            @empty($item->files->count())
                                                                <div class="mt-2 p-4 bg-gray-200 flex">
                                                                    <i data-feather="cloud-off" class="w-5 h-5 text-theme-6 mr-2"></i> {{__('No Attachments')}}
                                                                </div>
                                                            @else
                                                                <div class="intro-y grid grid-cols-12 sm:gap-6 mt-2">
                                                                    @foreach ($item->files as $file)
                                                                        <!-- -->
                                                                        <div class="intro-y col-span-6 sm:col-span-6 md:col-span-2 xxl:col-span-1 text-sm">
                                                                            <div class="file box rounded-md px-2 py-4 sm:px-5 relative zoom-in border shadow">
                                                                                <a href="javascript:openWindow('{{ route('toCustomer.app.showFile',['orderNum'=>$order->order_num,'orderItem'=>$item->item_num,'fileId'=>$file->id]) }}')" class="w-3/5 file__icon file__icon--file mx-auto">
                                                                                    <div class="file__icon__file-name">{{ strtoupper($file->file_type??'ND') }}</div>
                                                                                </a>
                                                                                <span class="block text-xs mt-1 text-center truncate">{{ $file->file_name??'--' }}</span>
                                                                                <div class="text-gray-600 text-xs text-center">{{ number_format(($file->file_size??'0')/1024, 2, ',', '.') }} KB</div>
                                                                                <a href="#" class="block bg-gray-200 rounded-md shadow px-2 py-1 w-full mt-2 text-xs text-center truncate" title="{{ $file->file_description??'--' }}">
                                                                                    {{ $file->file_description??'--' }}
                                                                                </a>
                                                                                <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                                                                    @if($itemEditActive || $itemCompleteReturn)
                                                                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"><i data-feather="more-vertical" class="w-5 h-5 mr-2"></i></a>
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
                                                                                                                <p class="text-xl mt-4 p-2 bg-gray-200 border-b border-gray-200 shadow-md">{{ $file->file_name??'--' }}</p>
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
                                                    <div class="intro-y mx-2 mb-4 text-right">
                                                        @if($itemEditActive)
                                                            @if($item->files->count())
                                                                <form action="{{route('toCustomer.orderItem.finalizeRegistration',['orderNum'=>$order->order_num,'orderItem'=>$item->id])}}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="button zoom-in w-auto bg-theme-1 text-white">{{__('Finalize Registration')}}</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                        @if($itemCompleteReturn)
                                                            <div class="flex justify-end">
                                                                {{--  --}}
                                                                <a href="javascript:;" data-toggle="modal" data-target="#modal-order-item-delete" class="flex items-center block py-2 px-3 transition duration-300 ease-in-out button zoom-in w-auto bg-red-700 text-white dark:hover:bg-dark-2 rounded-md mr-2">
                                                                    <i data-feather="trash" class="w-5 h-5 mr-2"></i> {{__('Cancel item')}}
                                                                </a>
                                                                <!-- MODAL CANCEL -->
                                                                <div class="text-center">
                                                                    <div class="modal" id="modal-order-item-delete">
                                                                        <div class="modal__content z-50">
                                                                            <div class="p-5 text-center">
                                                                                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                                                <div class="text-2xl mt-5">{{__('Are you sure?')}}</div>
                                                                                <div class="text-gray-600 mt-2">{{__('This process cannot be undone')}}</div>
                                                                            </div>
                                                                            <div class="px-5 pb-8 text-center">
                                                                                <form action="{{ route('toCustomer.orderItem.destroy',['orderNum'=>$orderNum])}}" method="post">
                                                                                    @csrf
                                                                                    @method('PUT')
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

                                                                {{--  --}}
                                                                <form action="{{route('toCustomer.orderItem.finalizeCompleteReturn',['orderNum'=>$order->order_num,'orderItem'=>$item->id])}}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="button zoom-in w-auto bg-theme-1 text-white">{{__('Complete Return')}}</button>
                                                                </form>
                                                                {{--  --}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- -->
                                                @if ($item->item_conclusion_datetime)
                                                <div class="tab-content__pane " id="order_item_conclusion-{{$item->id}}">
                                                    {{--  --}}
                                                    <div class="intro-y items-center p-1 mt-2 mx-2">

                                                        <div class="flex justify-between">
                                                            <div>
                                                                <h2 class="text-2xl font-medium mr-auto" title="ReportId: {{$item->ConclusionReport->id??'ND'}}">{{__('Conclusion')}}</h2>
                                                            </div>

                                                            @if ( $item->ConclusionReport->report_conclusion_file_path && $item->ConclusionReport->report_conclusion_file_name )
                                                                <div class="flex">
                                                                    @php
                                                                    $url  = asset($item->ConclusionReport->report_conclusion_file_path .'/'. $item->ConclusionReport->report_conclusion_file_name);
                                                                    $file = $item->ConclusionReport->report_conclusion_file_name;
                                                                    @endphp
                                                                    <a href="{{ $url }}" target="_blank" class="m-1 flex button text-sm text-white bg-theme-1 shadow-md hover:bg-green-500 hover:shadow-lg">
                                                                        <i data-feather="external-link" class="w-5 h-5 mr-1"></i> EXIBIR
                                                                    </a>
                                                                    <a href="{{ $url }}" download="{{$file}}" class="m-1 flex button text-sm text-white bg-theme-1 shadow-md hover:bg-green-500 hover:shadow-lg">
                                                                        <i data-feather="download" class="w-5 h-5 mr-1"></i> BAIXAR
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="flex my-2 gap-2 bg-gray-200 p-2 rounded shadow">

                                                            <div class="w-1/6 text-center md:text-left">
                                                                <div class="text-xs">{{ __('date time') }}</div>
                                                                <div class="text-sm font-medium">{{ $item->item_conclusion_datetime->format('d/m/Y H:i') }}</div>
                                                            </div>

                                                            <div class="w-5/6 text-center md:text-left">
                                                                <div>
                                                                    <div class="text-xs">{{ __('Conclusion note') }}</div>
                                                                    <div class="text-sm font-medium">
                                                                        {{ $item->ConclusionReport->status->ref_placeholder??'--' }}
                                                                        @if ($item->item_conclusion_comment)
                                                                            - {{ $item->item_conclusion_comment }}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <!-- -->
                                            </div>
                                        </div>
                                        <!-- END: Ticket -->
                                    </div>
                                    {{--  --}}
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
