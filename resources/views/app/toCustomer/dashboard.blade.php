@extends('_layout.side-menu',[
    'title' => 'Dashboard',
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => false,
    'useDataTable' => true,
    'useToastr' => false,
    'fullPage' => false,
])

@section('subcontent')
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('Cycle')}} {{$ciclo}}
                </div>
            </div>
            <div class="ml-auto">
                <form action="{{route('toCustomer.dashboard')}}" method="POST">
                    @csrf
                    <input type="month" id="month_search" name="month_search" data-toggle="modal" data-target="#modal-service-add" class="input border flex-1" value="{{$ciclo}}">
                    <input type="submit" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto" value="{{__('Search')}}">
                </form>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">

            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-2">

                {{-- <div class="intro-y flex items-end h-10">
                    <a href="{{ route('toProvider.dashboard') }}" class="ml-auto flex text-theme-1 dark:text-theme-10 hover:text-yellow-700 hover:font-semibold">
                        <i data-feather="refresh-ccw" class="w-5 h-5 mr-2"></i>
                    </a>
                </div> --}}

                @php
                $pedidos                     = [];
                $pedidosItensCiclo           = [];
                $pedidosItensCicloCadastro   = [];
                $pedidosItensCicloAnexos     = [];
                $pedidosItensCicloAguardando = [];
                $pedidosItensCicloConcluidas = [];
                $pedidosItensCicloCanceladas = [];
                $pedidosItensCicloDevolvidas = [];

                //
                foreach ($orders as $pedido)
                {
                    $pedidos[] = $pedido;

                    foreach ($pedido->itens as $item)
                    {
                        // SE NAO FOR DO CICLO
                        if($item->created_at->format('Y-m') != $ciclo)
                            continue;

                        $pedidosItens[] = $item;

                        $pedidosItensCiclo[] = $item;

                        //
                        if(in_array($item->item_status_id,[15]))
                        {
                            $pedidosItensCicloCadastro[] = $item;
                            continue;
                        }

                        //
                        if(in_array($item->item_status_id,[10]))
                        {
                            $pedidosItensCicloAnexos[] = $item;
                            continue;
                        }

                        //
                        if(in_array($item->item_status_id,[30]))
                        {
                            $pedidosItensCicloCanceladas[] = $item;
                            continue;
                        }

                        //
                        if(in_array($item->item_status_id,[40,50,90]))
                        {
                            $pedidosItensCicloAguardando[] = $item;
                            continue;
                        }

                        //
                        if(in_array($item->item_status_id,[60]))
                        {
                            $pedidosItensCicloDevolvidas[] = $item;
                            continue;
                        }

                        //
                        if(in_array($item->item_status_id,[100,120]))
                        {
                            $pedidosItensCicloConcluidas[] = $item;
                            continue;
                        }
                        /*
                        dd(
                            'URGENTE - AVISE O ADMINISTRADOR',
                            $item->toArray(),
                            $item->status->toArray(),
                        );
                        */
                    }
                }
                @endphp
                <div class="grid grid-cols-10 gap-4 mt-5">

                    <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                        <div class="report-box zoom-in111 h-full">
                            <div class="box p-4 h-full">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    <div class="text-2xl font-bold leading-8 ml-auto">
                                    @if($pedidos ?? false)
                                        {{ count($pedidos) }}
                                    @else
                                        --
                                    @endif
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="text-base text-gray-600">{{ __('Total de Pedidos') }}</div>
                                    <div class="text-xs text-gray-400 ml-1 -mt-1">até o momento</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                        <div class="report-box zoom-in111 h-full">
                            <div class="box p-4 h-full">
                                <div class="flex">
                                    <i data-feather="airplay" class="report-box__icon text-theme-4"></i>
                                    <div class="text-2xl font-bold leading-8 ml-auto">
                                    @if($pedidosItens ?? false)
                                        {{ count($pedidosItens) }}
                                    @else
                                        --
                                    @endif
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="text-base text-gray-600">{{ __('Total de Itens') }}</div>
                                    <div class="text-xs text-gray-400 ml-1 -mt-1">até o momento</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                        <div class="report-box zoom-in111 h-full">

                            <div class="box p-4 flex h-full">
                                <div class="w-1/4 h-full">
                                    <div>
                                        <div class="flex">
                                            <i data-feather="calendar" class="report-box__icon text-theme-10"></i>
                                            <div class="-mt-1">
                                                <div class="text-2xl font-bold ml-2">{{ $ciclo }}</div>
                                                <div class="text-xs text-gray-500 ml-2 -mt-1">Ciclo atual</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex mt-1 pl-2 pr-4">
                                            <div class="flex justify-center w-full bg-theme-1 text-white text-center py-2 px-2 rounded-full" title="">
                                                <div class="text-xs font-bold text-center uppercase">{{ $pedidosItensCiclo ? count($pedidosItensCiclo) : '0' }}</div>
                                                <div class="text-xs font-normal uppercase ml-1">{{ __('Itens') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-3/4 h-full">
                                    <div class="grid md:grid-cols-3 gap-3">

                                        <div class="flex justify-center bg-yellow-600 text-white p-2 rounded">
                                            <div class="text-xs font-bold">{{ $pedidosItensCicloAnexos ? count($pedidosItensCicloAnexos) : '0' }}</div>
                                            <div class="text-xs font-normal uppercase ml-1">{{ __('Anexo(s)') }}</div>
                                        </div>

                                        <div class="flex justify-center border border-blue-300 text-theme-1 p-2 rounded">
                                            <div class="text-xs font-bold">{{ $pedidosItensCicloCadastro ? count($pedidosItensCicloCadastro) : '0' }}</div>
                                            <div class="text-xs font-normal uppercase ml-1">{{ __('Cadastro') }}</div>
                                        </div>

                                        <div class="flex justify-center bg-theme-1 text-white p-2 rounded">
                                            <div class="text-xs font-bold">{{ $pedidosItensCicloAguardando ? count($pedidosItensCicloAguardando) : '0' }}</div>
                                            <div class="text-xs font-normal uppercase ml-1">{{ __('Na Fila') }}</div>
                                        </div>

                                        <div class="flex justify-center bg-green-700 text-white p-2 rounded">
                                            <div class="text-xs font-bold">{{ $pedidosItensCicloConcluidas ? count($pedidosItensCicloConcluidas) : '0' }}</div>
                                            <div class="text-xs font-normal uppercase ml-1">{{ __('Atendidas') }}</div>
                                        </div>

                                        <div class="flex justify-center bg-black text-white p-2 rounded">
                                            <div class="text-xs font-bold">{{ $pedidosItensCicloCanceladas ? count($pedidosItensCicloCanceladas) : '0' }}</div>
                                            <div class="text-xs font-normal uppercase ml-1">{{ __('Canceladas') }}</div>
                                        </div>

                                        @if ($pedidosItensCicloDevolvidas)
                                            <div class="bg-red-700 text-white p-2 rounded animate-bounce">
                                                <a href="{{ route('toCustomer.orderItem.index') }}" class="flex justify-center">
                                                    <div class="text-xs font-bold">{{ $pedidosItensCicloDevolvidas ? count($pedidosItensCicloDevolvidas) : '0' }}</div>
                                                    <div class="text-xs font-normal uppercase ml-1">{{ __('Devolvidas') }}</div>
                                                </a>
                                            </div>
                                        @else
                                            <div class="flex justify-center bg-red-700 text-white p-2 rounded">
                                                <div class="text-xs font-bold">{{ $pedidosItensCicloDevolvidas ? count($pedidosItensCicloDevolvidas) : '0' }}</div>
                                                <div class="text-xs font-normal uppercase ml-1">{{ __('Devolvidas') }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
        </div>

        {{-- DEVOLVIDAS --}}
        @if ($pedidosItensCicloDevolvidas)
            <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-5 pb-10">
                <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                    <!-- BEGIN: Important Notes -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-2xl font-medium truncate ml-4">Itens Devolvidos</h2>
                        </div>
                        <!-- BEGIN: Data List -->
                        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-2 mt-2">
                            <table id="table" class="table table-report display compact">
                                <thead>
                                    <tr>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Data / Hora')}}</th>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Tipo')}}</th>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Item Número')}}</th>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Status')}}</th>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Paciente')}}</th>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Documento')}}</th>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Anexos')}}</th>
                                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Devolvido em')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidosItensCicloDevolvidas as $item)
                                        <tr class="intro-x shadow hover:shadow-lg hover:text-yellow-800">
                                            <td class="text-center">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="text-xs m-0 p-0">{{ $item->created_at->format('d/m/Y H:i') }}</div>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="text-xs m-0 p-0">{{ $item->service->service_name }}</div>
                                                </a>
                                            </td>
                                            <td class="">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="flex justify-center text-xs m-0 p-0">
                                                        @if (in_array($item->status->id,[100]))
                                                            <i data-feather="{{ $item->status->ref_icon??'activity' }}" class="animate-pulse w-4 h-4 mr-1 text-{{ $item->status->ref_color??'theme-1' }}"></i>
                                                        @else
                                                            <i data-feather="{{ $item->status->ref_icon??'activity' }}" class="w-4 h-4 mr-1 text-{{ $item->status->ref_color??'theme-1' }}"></i>
                                                        @endif
                                                        <div class="text-xs m-0 p-0">{{ $item->item_num }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="text-xs m-0 p-0">{{ $item->status->ref_description }}</div>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="text-xs m-0 p-0">{{ $item->order->pat_name }}</div>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="flex justify-center">
                                                        <div class="text-xs m-0 p-0 text-gray-600 mr-1">{{ $item->order->pat_doc_type }}</div>
                                                        <div class="text-xs m-0 p-0">{{ $item->order->pat_doc_num }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="text-xs m-0 p-0">{{ $item->files->count() }}</div>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                    <div class="text-xs m-0 p-0">{{ $item->item_conclusion_datetime->format('d/m/Y H:i') }}</div>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- END: Data List -->
                    </div>
                    <!-- END: Important Notes -->
                </div>
            </div>
        @endif


        <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-5 pb-10">
            <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                <!-- BEGIN: Important Notes -->
                <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto">
                    <div class="intro-x flex items-center">
                        <h2 class="text-2xl font-medium truncate ml-4">Itens Concluídos</h2>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-2 mt-2">
                        <table id="table" class="table table-report display compact">
                            <thead>
                                <tr>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Data / Hora')}}</th>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Tipo')}}</th>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Item Número')}}</th>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Status')}}</th>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Paciente')}}</th>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Documento')}}</th>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Anexos')}}</th>
                                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Atendido em')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidosItensCicloConcluidas as $item)
                                    <tr class="intro-x shadow hover:shadow-lg hover:text-yellow-800">
                                        <td class="text-center">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="text-xs m-0 p-0">{{ $item->created_at->format('d/m/Y H:i') }}</div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="text-xs m-0 p-0">{{ $item->service->service_name }}</div>
                                            </a>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="flex justify-center text-xs m-0 p-0">
                                                    @if (in_array($item->status->id,[100]))
                                                        <i data-feather="{{ $item->status->ref_icon??'activity' }}" class="animate-pulse w-4 h-4 mr-1 text-{{ $item->status->ref_color??'theme-1' }}"></i>
                                                    @else
                                                        <i data-feather="{{ $item->status->ref_icon??'activity' }}" class="w-4 h-4 mr-1 text-{{ $item->status->ref_color??'theme-1' }}"></i>
                                                    @endif
                                                    <div class="text-xs m-0 p-0">{{ $item->item_num }}</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="text-xs m-0 p-0">{{ $item->status->ref_description }}</div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="text-xs m-0 p-0">{{ $item->order->pat_name }}</div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="flex justify-center">
                                                    <div class="text-xs m-0 p-0 text-gray-600 mr-1">{{ $item->order->pat_doc_type }}</div>
                                                    <div class="text-xs m-0 p-0">{{ $item->order->pat_doc_num }}</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="text-xs m-0 p-0">{{ $item->files->count() }}</div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('toCustomer.orderItem.show',['orderNum' => $item->order->order_num,'orderItem'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                                <div class="text-xs m-0 p-0">{{ $item->item_end_datetime ? $item->item_end_datetime->format('d/m/Y H:i') : '--' }}</div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- END: Data List -->
                </div>
                <!-- END: Important Notes -->
            </div>
        </div>




    </div>
@endsection


@section('script')
<script>
    $('#table').DataTable({
        dom: 'Bfrtip',
        language: dataOptionsLanguage, pageLength: 50,
        buttons: dataOptionsButtons,
        ordering: true,
        order: [0],
        columnDefs: [
            // { "width": "30%", "targets": 0 },
            // { "width": "45%", "targets": 1 },
            // { "width": "25%", "targets": 2 },
        ]
    });
</script>
@endsection
