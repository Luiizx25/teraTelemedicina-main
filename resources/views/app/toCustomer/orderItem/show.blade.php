@extends('_layout.side-menu',[
    'title' => 'Order Item',
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => false,
    'useToastr' => false,
])

@section('subcontent')
    @php
        $orderComplete = (in_array($order->status_id,[40,50]))?true:false; // 40 = inserindo-itens / 50 = revisando-itens
        $orderCancel   = (in_array($order->status_id,[10,20,30,40,50,60]))?true:false; // 10 = paciente-qualificado / 20 = revisando-paciente / 30 = aguardando-itens / 60 = cadastrado
    @endphp
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{ $orderItem->Service->service_name }}
                    @if($orderItem->serviceVariation ?? false)
                         - {{ $orderItem->serviceVariation->variation_name }}
                    @endif
                </div>
                <div class="text-base text-gray-600 mt-1">{{ $orderItem->item_num }}</div>
            </div>
            <div class="ml-auto">
            @if($order->deleted_at)
                <p class="inline-block px-2 bg-red-600 shadow-md rounded">
                    <span class="font-semibold text-1xl text-white">{{__('Canceled at')}} {{ $order->deleted_at?$order->deleted_at->format('d/m/Y H:i'):'---' }}</span>
                </p>
            @else
                <div class="inline-block p-2 bg-{{ $orderItem->status->ref_color_bg }} text-{{ $orderItem->status->ref_color}} shadow-md rounded">
                    <div class="px-2">
                        <span class="font-semibold text-1xl text-{{$orderItem->status->ref_color??'current'}} text-white flex">
                            <i data-feather="{{ $orderItem->status->ref_icon??'activity' }}" class="w-5 h-5 mr-1"></i>
                            <span class="uppercase">{{ $orderItem->status->ref_description }}</span>
                            <span class="font-light text-md ml-1">{{ $orderItem->updated_at->format('d/m/Y H:i') }}</span>
                        </span>
                    </div>
                    @if ($orderItem->item_conclusion_comment)
                        <div class="font-light text-gray-100 border-t mt-1 pt-1 ml-1">
                            {{ $orderItem->item_conclusion_comment }}
                        </div>
                    @endif
                </div>
            @endif
            </div>
        </div>
    </div>
    <!-- -->
    <div class="box text-lg font-medium mt-2 p-3 w-full shadow-md rounded-md border">
        <!-- -->
        <div class="intro-y col-span-12 text-sm">
            <!-- -->
            <div class="flex flex-col sm:flex-row items-center p-1">

                {{-- <div class="p-1">
                    <!-- -->
                    <a href="javascript:;" onclick="divShowHide('div-anexos','show')" class="hover:text-orange-600" title="{{__('Attachments')}}">
                        <i data-feather="paperclip" class="w-5 h-5"></i>
                    </a>
                    <!-- -->
                </div> --}}

                {{-- <div class="dropdown hidden">
                    <button class="dropdown-toggle button">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <i data-feather="menu" class="w-5 h-5"></i>
                        </span>
                    </button>
                    <div class="dropdown-box w-56" id="_18hgyyal8" data-popper-placement="top-end" style="position: absolute; top: auto; right: auto; bottom: 0px; left: 0px; transform: translate(-124px, -37px);" data-popper-reference-hidden="" data-popper-escaped="">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                            <a href="{{ route('toCustomer.order.show',['order'=>$order->order_num]) }}" class="flex my-1 p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 bg-gray-200 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="layers" class="w-5 h-5 text-theme-9 pt-1 mr-1"></i> {{__('View Order Full')}}
                            </a>
                        </div>
                    </div>
                </div> --}}

            </div>
            <!-- -->
            @include('app.toCustomer._inc.orderItem-details')
        </div>
        <!-- -->
        <div class="intro-y grid grid-cols-1 md:grid-cols-5 gap-2 flex rounded-sm text-sm">
            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full">
                <p class="text-gray-600 text-xs">{{__('Created_at')}}</p>
                <p class="font-medium">{{ $orderItem->created_at?$orderItem->created_at->format('d/m/Y H:i'):'--' }}</p>
            </div>
            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full">
                <p class="text-gray-600 text-xs">{{__('Updated_at')}}</p>
                <p class="font-medium">{{ $orderItem->updated_at?$orderItem->updated_at->format('d/m/Y H:i'):'--' }}</p>
            </div>
            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full">
                <p class="text-gray-600 text-xs">{{__('Start of service')}}</p>
                <p class="font-medium">{{ $orderItem->item_start_datetime?$orderItem->item_start_datetime->format('d/m/Y H:i'):'--' }}</p>
            </div>
            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full">
                <p class="text-gray-600 text-xs">{{__('End of service')}}</p>
                <p class="font-medium">{{ $orderItem->item_end_datetime?$orderItem->item_end_datetime->format('d/m/Y H:i'):'--' }}</p>
            </div>
            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full">
                <p class="text-gray-600 text-xs">{{__('Conclusion')}}</p>
                <p class="font-medium">{{ $orderItem->item_conclusion_datetime?$orderItem->item_conclusion_datetime->format('d/m/Y H:i'):'--' }}</p>
            </div>
        </div>
        <div class="intro-y grid grid-cols-12 gap-2 flex my-2 rounded-sm text-sm">
            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12">
                <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                <p class="font-medium">{{ $orderItem->item_comments??'--' }}</p>
            </div>
        </div>
        <!-- -->
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: Ticket -->
            <div class="col-span-12 lg:col-span-12">
                <div class="intro-y pr-1">
                    <div class="box p-2">
                        <div class="pos__tabs nav-tabs justify-center flex">
                            <a data-toggle="tab" data-target="#order_item_request" href="javascript:;" class="active flex-1 py-2 rounded-md text-center">Solicitação</a>
                            @if ($orderItem->item_conclusion_datetime)
                                <a data-toggle="tab" data-target="#order_item_conclusion" href="javascript:;" class=" flex-1 py-2 rounded-md text-center">Conclusão</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <!-- -->
                    <div class="tab-content__pane active" id="order_item_request">

                        <div class="intro-y flex flex-col sm:flex-row items-center p-2 mt-2 mx-2">
                            <h2 class="text-2xl font-medium mr-auto">{{__('Anexos do Pedido')}}</h2>
                            <!-- -->
                            @php
                                // ativo para editar
                                $itemEditActive     = in_array($orderItem->item_status_id,[10])?true:false;
                                $itemCompleteReturn = in_array($orderItem->item_status_id,[60])?true:false;
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
                                            <input type="hidden" name="orderItem" value="{{$orderItem->id}}">
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
                                @empty($orderItem->files->count())
                                    <div class="mt-2 p-4 bg-gray-200 flex">
                                        <i data-feather="cloud-off" class="w-5 h-5 text-theme-6 mr-2"></i> {{__('No Attachments')}}
                                    </div>
                                @else
                                    <div class="intro-y grid grid-cols-12 sm:gap-6 mt-2">
                                        @foreach ($orderItem->files as $file)
                                            <!-- -->
                                            <div class="intro-y col-span-6 sm:col-span-6 md:col-span-2 xxl:col-span-1 text-sm">
                                                <div class="file box rounded-md px-2 py-4 sm:px-5 relative zoom-in border shadow">
                                                    <a href="javascript:openWindow('{{ route('toCustomer.app.showFile',['orderNum'=>$order->order_num,'orderItem'=>$orderItem->item_num,'fileId'=>$file->id]) }}')" class="w-3/5 file__icon file__icon--file mx-auto">
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
                                                                                        <input type="hidden" name="orderItem" value="{{ $orderItem->id }}">
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
                                @if($orderItem->files->count())
                                    <form action="{{route('toCustomer.orderItem.finalizeRegistration',['orderNum'=>$order->order_num,'orderItem'=>$orderItem->id])}}" method="post">
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
                                                        <input type="hidden" name="orderItem" value="{{ $orderItem->id }}">
                                                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                        <button type="submit" class="button w-24 bg-theme-6 text-white">{{__('Delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- MODAL CANCEL -->

                                    {{--  --}}
                                    <form action="{{route('toCustomer.orderItem.finalizeCompleteReturn',['orderNum'=>$order->order_num,'orderItem'=>$orderItem->id])}}" method="post">
                                        @csrf
                                        <button type="submit" class="button zoom-in w-auto bg-theme-1 text-white">{{__('Complete Return')}}</button>
                                    </form>
                                    {{--  --}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- -->
                    @if ($orderItem->item_conclusion_datetime)
                    <div class="tab-content__pane " id="order_item_conclusion">
                        {{--  --}}
                        <div class="intro-y items-center p-1 mt-2 mx-2">

                            <div class="flex justify-between">
                                <div>
                                    <h2 class="text-2xl font-medium mr-auto">{{__('Conclusion')}}</h2>
                                </div>
                                @if ( $orderItem->ConclusionReport && $orderItem->ConclusionReport->report_conclusion_file_path && $orderItem->ConclusionReport->report_conclusion_file_name )
                                    <div class="flex">
                                        @php
                                        $url  = asset($orderItem->ConclusionReport->report_conclusion_file_path .'/'. $orderItem->ConclusionReport->report_conclusion_file_name);
                                        $file = $orderItem->ConclusionReport->report_conclusion_file_name;
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
                                    <div class="text-sm font-medium">{{ $orderItem->item_conclusion_datetime->format('d/m/Y H:i') }}</div>
                                </div>

                                <div class="w-5/6 text-center md:text-left">
                                    <div>
                                        <div class="text-xs">{{ __('Conclusion note') }}</div>
                                        <div class="text-sm font-medium">
                                            @if ($orderItem->ConclusionReport)
                                                {{ $orderItem->ConclusionReport->status->ref_placeholder ?? null }}
                                            @endif
                                            @if ($orderItem->item_conclusion_comment)
                                                - {{ $orderItem->item_conclusion_comment }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            @if ($orderItem->ConclusionReportFiles->count())
                                <div class="mt-4 text-2xl font-medium">{{__('Anexos do Médico')}}</div>
                                <div class="w-full bg-gray-200 rounded my-2 p-2">
                                    @foreach ($orderItem->ConclusionReportFiles as $reportFile)
                                        {{-- <div class="w-full flex gap-2">
                                            @dump($reportFile->toArray())
                                        </div>
                                        <hr> --}}
                                        <div class="intro-y">
                                            <div class="flex justify-between gap-3 box rounded-md py-2 px-2 sm:px-2 relative border shadow text-center">
                                                <div class="flex w-full gap-2">
                                                    <div class="w-9/12 text-xs text-left truncate">
                                                        <div class="bg-gray-100 rounded shadow px-1 w-full font-medium truncate" >{{ $reportFile->file_description??'---' }}</div>
                                                        <div class="px-1 truncate" title="{{ $reportFile->file_description??'---' }}">{{ $reportFile->file_comments??'---' }}</div>
                                                    </div>
                                                    <div class="w-3/12 flex justify-end">
                                                        {{-- <span class="inline-block align-middle text-lg m-0 p-0">{{ strtoupper($reportFile->file_type??'ND') }}</span> --}}
                                                        @php
                                                        $url  = asset($orderItem->ConclusionReport->report_conclusion_file_path .'/'. $orderItem->ConclusionReport->report_conclusion_file_name);
                                                        $url  = asset('storage/'. $reportFile->file);
                                                        $file = $reportFile->file_description;
                                                        // dd(
                                                        //     $reportFile->file_description,
                                                        //     $reportFile->file,
                                                        //     $orderItem->ConclusionReport->report_conclusion_file_path,
                                                        // );
                                                        @endphp
                                                        <a href="{{ $url }}" target="_blank" class="m-1 flex button text-center text-sm text-white bg-theme-1 shadow-md hover:bg-green-500 hover:shadow-lg">
                                                            <i data-feather="external-link" class="w-5 h-5 mr-1"></i> EXIBIR
                                                        </a>
                                                        <a href="{{ $url }}" download="{{$file}}" class="m-1 flex button text-center text-sm text-white bg-theme-1 shadow-md hover:bg-green-500 hover:shadow-lg">
                                                            <i data-feather="download" class="w-5 h-5 mr-1"></i> BAIXAR
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    <!-- -->
                </div>
            </div>
            <!-- END: Ticket -->
        </div>
    </div>
@endsection



@section('script')
    <script>

    </script>
@endsection
