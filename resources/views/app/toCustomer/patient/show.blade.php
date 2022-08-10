@extends('_layout.side-menu',[
    'title' => 'Patient',
    'useJquery' => false,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => false,
    'useToastr' => false,
])

@section('subcontent')
    <div class="flex items-center mt-2">
        <!-- -->
        @php
            //$orderComplete = (in_array($patient->status_id,[40,50]))?true:false; // 40 = inserindo-itens / 50 = revisando-itens
            //$orderCancel   = (in_array($patient->status_id,[10,20,30,40,50,60]))?true:false; // 10 = paciente-qualificado / 20 = revisando-paciente / 30 = aguardando-itens / 60 = cadastrado
            $orderComplete = false;
            $orderCancel   = false;
        @endphp
    </div>
    <!-- -->
    <div class="intro-y box p-2 mt-2">

        <div class="intro-y col-span-12 lg:col-span-6">

            <div class="grid grid-cols-12 gap-2">
                <div class="intro-y col-span-12">

                    <div class="grid grid-cols-12 gap-2 px-2">

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                            <label class="text-xs text-gray-600">{{__('Name')}}</label>
                            <p class="font-medium">{{ $patient->pat_name??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-4">
                            <label class="text-xs text-gray-600">{{__('Email')}}</label>
                            <p class="font-medium">{{ $patient->pat_email??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Created At')}}</label>
                            <p class="font-medium">{{ $patient->created_at->format('d/m/Y H:i')??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Updated At')}}</label>
                            <p class="font-medium">{{ $patient->updated_at->format('d/m/Y H:i')??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-4">
                            <label class="text-xs text-gray-600">{{ $patient->pat_doc_type??'---' }}</label>
                            <p class="font-medium">{{ $patient->pat_doc_num??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-4">
                            <label class="text-xs text-gray-600">{{__('Identity')}}</label>
                            <p class="font-medium">{{ $patient->pat_identity_num??'---' }} - {{ $patient->pat_identity_emitting??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Date Birth')}}</label>
                            <p class="font-medium">{{ $patient->pat_date_birth->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Age')}}</label>
                            <p class="font-medium">{{ getAge($patient->pat_date_birth) }} {{__('Years')}}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Genre')}}</label>
                            <p class="font-medium">{{ $patient->pat_genre??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-1">
                            <label class="text-xs text-gray-600">{{__('Weight')}}</label>
                            <p class="font-medium">{{ $patient->pat_weight??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-1">
                            <label class="text-xs text-gray-600">{{__('Height')}}</label>
                            <p class="font-medium">{{ $patient->pat_height??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Mobile')}}</label>
                            <p class="font-medium">{{ $patient->pat_phone_mobile??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Phone')}}</label>
                            <p class="font-medium">{{ $patient->pat_phone??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-4">
                            <label class="text-xs text-gray-600">{{__('Work Company / Position')}}</label>
                            <p class="font-medium">{{ $patient->pat_work_company??'---' }} / {{ $patient->pat_work_position??'---' }}</p>
                        </div>

                    </div>
                </div>

                <div class="intro-y col-span-12">
                    <div class="grid grid-cols-12 gap-2 px-2">

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-3">
                            <label class="text-xs text-gray-600">{{__('Address')}}</label>
                            <p class="font-medium">{{ $patient->pat_street??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-1">
                            <label class="text-xs text-gray-600">{{__('Number')}}</label>
                            <p class="font-medium">{{ $patient->pat_street_num??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Complement')}}</label>
                            <p class="font-medium">{{ $patient->pat_street_complement??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Neighborhood')}}</label>
                            <p class="font-medium">{{ $patient->pat_street_neighborhood??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('City')}}</label>
                            <p class="font-medium">{{ $patient->pat_city??'---' }}/{{ $patient->pat_state??'---' }}</p>
                        </div>

                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                            <label class="text-xs text-gray-600">{{__('Postal Code')}}</label>
                            <p class="font-medium">{{ $patient->pat_postalcode??'---' }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- -->
        </div>

        <div class="intro-y flex flex-col sm:flex-row items-center p-2 mx-2">
            <h2 class="text-2xl font-medium mr-auto">
                {{__('Items')}}
            </h2>
        </div>

        <div class="intro-y mx-2 mb-4">
            <div class="overflow-x-auto sm:overflow-x-visible accordion">
                @empty($patient->order->count())
                    <h2 class="text-center p-4 bg-gray-100">{{__('Nenhum item registrado para esse paciente')}}</h2>
                @else
                    @php
                        $orderItens = false;
                    @endphp
                    @foreach ($patient->order as $order)
                        @php
                            if($order->itens->count())
                                $orderItens = true;
                            else
                                continue;
                        @endphp
                        @foreach ($order->itens as $item)
                            <div class="intro-y box shadow-md zoom-in rounded-md mb-4 border">
                                <div class="accordion__pane inbox__item inbox__item--active inline-block sm:block text-gray-700 dark:text-gray-500 bg-{{ $item->status->ref_color_bg??'gray-100' }} border-b border-gray-200 dark:border-dark-1 rounded-md">
                                    <div class="">
                                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 justify-items-stretch h-auto itens-center">
                                            <div class="justify-start items-center py-2">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $order->order_num,'orderItem' => $item->item_num]) }}" class="">
                                                    <p class="inbox__item--highlight truncate ml-4 text-2xl font-semibold hover:text-yellow-600">{{ $item->service->service_name }}</p>
                                                </a>
                                                <p class="inbox__item--highlight truncate ml-4 text-xs text-gray-600">{{ $item->item_num??'---' }} - {{ $item->service->type->ref_description }}</p>
                                                <p class="inbox__item--highlight truncate ml-4 text-base text-gray-600">{{ $item->created_at->format('d/m/Y H:i') }}</p>
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
                                                                                <form action="{{ route('toCustomer.orderItem.destroy',['orderNum'=>$order->order_num])}}" method="post">
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
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    <!-- -->
                    @if (!$orderItens)
                        <h2 class="text-center p-4 bg-gray-100">{{__('Nenhum item registrado para esse paciente')}}</h2>
                    @endif
                    <!-- -->
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
