@extends('_layout.side-menu',[
    'title' => 'Orders',
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
                    {{__('Orders')}}
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
                <form action="{{route('toCustomer.order.search')}}" method="POST">
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
                        @if(auth()->user()->id < 1000)
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Customer')}}</th>
                        @endif
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Patient')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Order')}} - {{__('Date/Time')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Status')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Items')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = $orders->count();
                    @endphp
                    @forelse ($orders as $order)
                        <tr class="intro-x shadow hover:shadow-lg">
                            @if(auth()->user()->id < 1000)
                            <td class="">
                                <div class="text-xs text-gray-600 whitespace-no-wrap">
                                {{ $order->customer->cus_name }}
                                </div>
                            </td>
                            @endif
                            <td>
                                <a href="{{ route('toCustomer.order.show',['order'=>$order->order_num]) }}" class="font-medium">
                                    <div class="py-1 px-2 rounded shadow-md bg-gray-200">
                                        <div class="text-xl">{{ $order->pat_name }}</div>
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
                                <div class="flex items-center justify-start text-theme-9" title="{{ $order->status->id }}">
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
            
        ]
    });
</script>
@endsection
