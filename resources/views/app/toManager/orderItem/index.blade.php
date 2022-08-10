@extends('_layout.side-menu',[
    'title' => __('Orders Items'),
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => false,
    'useDataTable' => true,
    'useToastr' => false,
    'fullPage' => true,
])

@section('subcontent')
<div class="mt-2 p-2 intro-y">
    <div class="flex">
        <div class="">
            <div class="text-2xl font-bold leading-8">
                {{__('Items')}}
            </div>
        </div>
        <div class="ml-auto">
            <form action="{{route('toManager.orderItem.index')}}" method="POST">
                @csrf
                <input type="date" id="date_start" name="date_start" data-toggle="modal" data-target="#modal-service-add" class="input border flex-1" value="{{$date_start}}"> -
                <input type="date" id="date_end" name="date_end" data-toggle="modal" data-target="#modal-service-add" class="input border flex-1" value="{{$date_end}}">
                <input type="submit" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto" value="{{__('Search')}}">
            </form>
        </div>
    </div>
</div>

    <div class="grid grid-cols-12 gap-2">
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4 mt-2">
            <table id="table" class="table table-report display compact">
                <thead>
                    <tr>
                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Data / Hora')}}</th>
                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Empresa')}}</th>
                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Tipo')}}</th>
                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Item Número')}}</th>
                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Status')}}</th>
                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Paciente')}}</th>
                        <th class="hover:text-yellow-800 whitespace-no-wrap text-center">
                        <i data-feather="paperclip" class="w-4 h-4 mr-1"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItens as $item)
                        <tr class="intro-x shadow hover:shadow-lg hover:text-yellow-800">
                            <td class="text-center">
                                <span class="hidden">ref.{{ $item->created_at->format('YmdHi') }}</span>
                                <a href="{{ route('toManager.orderItem.show',['itemNum'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                    <div class="text-xs m-0 p-0">{{ $item->created_at->format('d/m/Y H:i') }}</div>
                                    <div class="text-xs m-0 p-0 text-gray-600 font-medium">CICLO {{ $item->created_at->format('Y-m') }}</div>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('toManager.orderItem.show',['itemNum'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                    <div class="text-xs m-0 p-0">{{ $item->order->customer->cus_name }}</div>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('toManager.orderItem.show',['itemNum'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                    <div class="text-xs m-0 p-0">{{ $item->service->service_name }}</div>
                                </a>
                            </td>
                            <td class="">
                                <a href="{{ route('toManager.orderItem.show',['itemNum'=>$item->item_num]) }}" class="hover:text-yellow-700">
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
                                <a href="{{ route('toManager.orderItem.show',['itemNum'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                    <div class="text-xs m-0 p-0">{{ $item->status->ref_description }}</div>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('toManager.orderItem.show',['itemNum'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                    <div class="text-xs m-0 p-0">{{ $item->order->pat_name }}</div>
                                    <div class="flex justify-center">
                                        <div class="text-xs m-0 p-0 text-gray-600 mr-1">{{ $item->order->pat_doc_type }}</div>
                                        <div class="text-xs m-0 p-0">{{ $item->order->pat_doc_num }}</div>
                                    </div>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('toManager.orderItem.show',['itemNum'=>$item->item_num]) }}" class="hover:text-yellow-700">
                                    <div class="text-xs m-0 p-0">{{ $item->files->count() }}</div>
                                </a>
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
