@extends('_layout.side-menu',[
    'title' => 'Orders',
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => false,
    'useDataTable' => true,
    'useToastr' => false,
])

@section('subcontent')
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <h2 class="text-2xl font-medium my-2 truncate">{{__('Orders')}}</h2>
            <div class="ml-auto mt-2">
                <a href="{{route('toCustomer.order.create')}}" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto">
                    {{__('New Order')}}
                </a>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-2">
            <!-- BEGIN: Data List -->
            <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4 mt-2">
                <table id="table" class="table table-report display">
                    <thead>
                        <tr>
                            <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Patient')}}</th>
                            <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Order')}} - {{__('Date/Time')}}</th>
                            <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Status')}}</th>
                            <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Items')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = $orders->count();
                        @endphp
                        @forelse ($orders as $order)
                            <tr class="intro-x shadow hover:shadow-lg">
                                <td>
                                    <a href="{{ route('toCustomer.order.show',['order'=>$order->order_num]) }}" class="font-medium whitespace-no-wrap">
                                        <div class="py-1 px-2 rounded shadow-md bg-gray-200">
                                            <p class="text-xl">{{ $order->pat_name }}</p>
                                            <div class="text-xs text-gray-600">{{ $order->pat_date_birth->format('d/m/Y')??'---' }} - {{ getAge($order->pat_date_birth)??'--' }} {{__('Years')}}</div>
                                        </div>
                                    </a>
                                </td>
                                <td class="">
                                    <a href="{{ route('toCustomer.order.show',['order'=>$order->order_num]) }}" class="font-medium whitespace-no-wrap">
                                        <p class="text-base font-bold">{{ $order->order_num }}</p>
                                        <div class="text-xs text-gray-600 whitespace-no-wrap">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                    </a>
                                </td>
                                <td class="">
                                    <div class="flex items-center justify-start text-theme-9" title="{{ $order->status->id }}" title="{{ $order->status->id }}">
                                        <i data-feather="{{ $order->status->ref_icon??'activity' }}" class="w-5 h-5 mr-1 text-{{ $order->status->ref_color??'theme-1' }}"></i> {{ $order->status->ref_description }}
                                    </div>
                                </td>
                                <td class="text-center text-lg">
                                    {{ $order->itens->count() }}
                                </td>
                            </tr>
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
            { "width": "30%", "targets": 0 },
        ]
    });
</script>
@endsection
