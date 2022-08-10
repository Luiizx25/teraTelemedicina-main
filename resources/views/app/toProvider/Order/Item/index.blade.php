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
    <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4 mt-4">
        <table id="table" class="table table-report display compact">
            <thead>
                <tr>
                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Ciclo')}}</th>
                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Data / Hora')}}</th>
                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Tipo')}}</th>
                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Item')}}</th>
                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Status')}}</th>
                    <th class="hover:text-yellow-800 whitespace-no-wrap text-center">{{__('Duração')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($OrderItemReports as $report)

                {{-- pzn OrderItemReports
                {{dd(
                    $report->OrderItem->order->toArray(),
                    $report->toArray(),
                    $report->OrderItem->toArray(),
                    $report->OrderItem->item_num,
                    )}} --}}

                    <tr class="intro-x shadow hover:shadow-lg hover:text-yellow-800">
                        <td class="text-center hover:text-yellow-700">
                            <div class="text-xs m-0 p-0">{{ $report->report_cycle }}</div>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('toProvider.orderItem.show',[ 'orderItemNum'=>$report->OrderItem->item_num,'reportId'=>$report->id ]) }}" class="hover:text-yellow-700">
                                <div class="text-xs m-0 p-0">{{ $report->created_at->format('d/m/Y H:i') }}</div>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('toProvider.orderItem.show',[ 'orderItemNum'=>$report->OrderItem->item_num,'reportId'=>$report->id ]) }}" class="hover:text-yellow-700">
                                <div class="text-xs m-0 p-0">{{ $report->OrderItem->service->service_name }}</div>
                            </a>
                        </td>
                        <td class="">
                            <a href="{{ route('toProvider.orderItem.show',[ 'orderItemNum'=>$report->OrderItem->item_num,'reportId'=>$report->id ]) }}" class="hover:text-yellow-700">
                                <div class="flex justify-center text-xs m-0 p-0">
                                    @if (in_array($report->OrderItem->status->id,[100]))
                                        <i data-feather="{{ $report->OrderItem->status->ref_icon??'activity' }}" class="animate-pulse w-4 h-4 mr-1 text-{{ $report->OrderItem->status->ref_color??'theme-1' }}"></i>
                                    @else
                                        <i data-feather="{{ $report->OrderItem->status->ref_icon??'activity' }}" class="w-4 h-4 mr-1 text-{{ $report->OrderItem->status->ref_color??'theme-1' }}"></i>
                                    @endif
                                    <div class="text-xs m-0 p-0">{{ $report->OrderItem->item_num }}-{{ $report->id }}</div>
                                </div>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('toProvider.orderItem.show',[ 'orderItemNum'=>$report->OrderItem->item_num,'reportId'=>$report->id ]) }}" class="hover:text-yellow-700">
                                <div class="text-xs m-0 p-0">{{ $report->status->ref_description }}</div>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('toProvider.orderItem.show',[ 'orderItemNum'=>$report->OrderItem->item_num,'reportId'=>$report->id ]) }}" class="hover:text-yellow-700">
                                <div class="text-xs m-0 p-0">
                                    {{ $report->OrderItem->item_end_datetime?$report->OrderItem->item_start_datetime->shortAbsoluteDiffForHumans($report->OrderItem->item_end_datetime):'--' }}
                                </div>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
        </table>
    </div>
@endsection

@section('script')
<script>
    $('#table').DataTable({
        dom: 'Bfrtip',
        language: dataOptionsLanguage, pageLength: 50,
        buttons: dataOptionsButtons,
        ordering: true,
        order: [0,1],
        columnDefs: [
            // { "width": "30%", "targets": 0 },
            // { "width": "45%", "targets": 1 },
            // { "width": "25%", "targets": 2 },
        ]
    });
</script>
@endsection
