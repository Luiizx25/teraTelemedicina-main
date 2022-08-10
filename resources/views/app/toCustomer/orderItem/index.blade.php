@extends('_layout.side-menu',[
    'title' => __('Orders Items'),
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => false,
    'useDataTable' => true,
    'useToastr' => false,
])

@section('subcontent')
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('Items')}}
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{route('toCustomer.order.create')}}" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto">
                    {{__('New Order')}}
                </a>
            </div>
        </div>
    </div>
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                </div>
            </div>
            <div class="ml-auto">
                <form action="{{route('toCustomer.orderItem.index')}}" method="POST">
                    @csrf
                    <input type="date" id="date_start" name="date_start" data-toggle="modal" data-target="#modal-service-add" class="input border flex-1" value="{{$date_start}}"> -
                    <input type="date" id="date_end" name="date_end" data-toggle="modal" data-target="#modal-service-add" class="input border flex-1" value="{{$date_end}}">
                    <input type="submit" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto" value="{{__('Search')}}">
                </form>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="grid grid-cols-12 gap-2">
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4 mt-2">
            <table id="table" class="table table-report display">
                <thead>
                    <tr>
                        {{--  @if(auth()->user()->id < 1000)
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Customer')}}</th>
                        @endif  --}}
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Patient')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Item')}} / {{__('Number')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $item)
                        {{--  @foreach ($orders as $item)  --}}
                            <tr class="intro-x shadow hover:shadow-lg rounded">
                                {{--  @if(auth()->user()->id < 1000)
                                <td class="">
                                    <div class="text-xs text-gray-600 whitespace-no-wrap">
                                    {{ $order->customer->cus_name }}
                                    </div>
                                </td>
                                @endif  --}}
                                <td>
                                    <a href="{{ route('toCustomer.orderItem.show',['orderNum'=>$item->order_num,'orderItem'=>$item->item_num]) }}" class="font-medium whitespace-no-wrap">
                                        <div class="py-1 px-2 rounded shadow-md bg-gray-200">
                                            <p class="text-xl">{{ $item->pat_name }}</p>
                                            <div class="text-xs text-gray-600">{{ date("d/m/Y", strtotime($item->pat_date_birth))??'---' }} - {{ getAge(date("Y-m-d", strtotime($item->pat_date_birth)))??'--' }} {{__('Years')}}</div>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <div class="flex justify-between">
                                        <div>
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum'=>$item->order_num,'orderItem'=>$item->item_num]) }}" class="">
                                                <p class="text-xl font-bold">{{ $item->service->service_name }}</p>
                                                <div class="text-xs text-gray-600 whitespace-no-wrap">{{ $item->item_num??'---' }}</div>
                                            </a>
                                        </div>
                                        <div>
                                            @empty($item->files)
                                                <i data-feather="cloud-off" class="w-5 h-5 mr-2 text-theme-6"></i>
                                            @else
                                                <div class=" text-theme-9 flex">{{$item->files->count()}} <i data-feather="upload-cloud" class="w-5 h-5 ml-1"></i></div>
                                            @endempty
                                        </div>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="items-center justify-start py-1 px-2 rounded shadow bg-{{$item->status->ref_color_bg??'gray-200'}} text-{{$item->status->ref_color??'gray-200'}}">
                                        <div class="flex font-semibold uppercase" title="{{ $item->status->id }}">
                                            <i data-feather="{{$item->status->ref_icon??'activity'}}" class="w-5 h-5 mr-1 font-bold text-{{$item->status->ref_color??'theme-1'}}"></i>
                                            {{ $item->status->ref_description }}
                                            @php
                                                // acoes possiveis - item_status_id = 10 - aguardando-anexos / 40 - aguardando-atendimento / 60 - devolvido
                                                $attachItems = in_array($item->item_status_id,[10,60])?true:false;
                                                $editItems   = in_array($item->item_status_id,[10,40,60])?true:false;
                                            @endphp
                                            @if($editItems)
                                                <div class="dropdown ml-auto">
                                                    <button class="dropdown-toggle" title=" {{__('Options')}}">
                                                        <i data-feather="menu" class="w-4 h-4 text-theme-6"></i>
                                                    </button>
                                                    <div class="dropdown-box w-48" data-popper-placement="bottom-end">
                                                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                                            <!-- -->
                                                            @if ($attachItems)
                                                                <a href="javascript:;" data-toggle="modal" data-target="#modal-order-item-file-add-{{$item->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                                                    <!-- -->
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
                                                                            <input type="hidden" name="orderNum" value="{{$item->order_num}}">
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
                                                                    <form action="{{route('toCustomer.orderItem.finalizeRegistration',['orderNum'=>$item->order_num,'orderItem'=>$item->id])}}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="flex items-center block p-2 w-full transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                                                            <i data-feather="check-circle" class="flex w-5 h-5 mr-2 text-theme-6"></i> {{__('Finalize Registration')}}
                                                                        </button>
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
                                                                            <form action="{{ route('toCustomer.orderItem.destroy',['orderNum'=>$item->order_num])}}" method="post">
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
                                            @endif
                                        </div>
                                        <!-- -->
                                    </div>
                                    <div class="mt-2 px-2">
                                        @if($item->deleted_at)
                                            {{$item->deleted_at->format('d/m/Y H:i')}}
                                        @elseif($item->item_conclusion_datetime)
                                            {{$item->item_conclusion_datetime->format('d/m/Y H:i')}}
                                        @elseif($item->updated_at)
                                            {{$item->updated_at->format('d/m/Y H:i')}}
                                        @else
                                            --
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        {{--  @endforeach  --}}
                    @empty
                    {{-- <tr class="intro-x shadow rounded"><td colspan="4">{{__('No items registered in the database')}}</td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')
<script>
    $('#table').DataTable({
        dom: 'Bfrtip',
        language: dataOptionsLanguage, pageLength: 50,
        buttons: dataOptionsButtons,
        ordering: true,
        order: [],
        columnDefs: [
        ]
    });
</script>
@endsection
