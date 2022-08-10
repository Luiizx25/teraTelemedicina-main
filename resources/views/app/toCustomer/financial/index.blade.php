@extends('_layout.side-menu',[
    'title' => __('Services'),
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => true,
    'useDataTable' => true,
    'useToastr' => true,
])

@section('subcontent')
<!-- título -->
<div class="mt-2 p-2 intro-y">
    <div class="flex">
        <div class="">
            <div class="text-2xl font-bold leading-8">
                {{__('Cycle')}} {{$cycle}}
            </div>
        </div>
        <div class="ml-auto">
            <form action="{{route('toCustomer.financial')}}" method="POST">
                @csrf
                <input type="month" id="month_search" name="month_search" data-toggle="modal" data-target="#modal-service-add" class="input border flex-1" value="{{str_replace('.','-',$cycle)}}">
                <input type="submit" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto" value="{{__('Search')}}">
            </form>
        </div>
    </div>
</div>
<!-- table -->
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
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Item Price')}}</th>
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Items')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = $financials->count();
                @endphp
                @forelse ($financials as $financial)
                    <tr class="intro-x shadow hover:shadow-lg">
                        @if(auth()->user()->id < 1000)
                        <td class="">
                            <div class="text-xs text-gray-600 whitespace-no-wrap">
                            {{ $financial->customer->cus_name }}
                            </div>
                        </td>
                        @endif
                        <td>
                            <a href="{{ route('toCustomer.order.show',['order'=>$financial->order_num]) }}" class="font-medium whitespace-no-wrap">
                                <div class="py-1 px-2 rounded shadow-md bg-gray-200">
                                    <p class="text-xl">{{ $financial->pat_name }}</p>
                                    <div class="text-xs text-gray-600"></div>
                                </div>
                            </a>
                        </td>
                        <td class="">
                            <a href="{{ route('toCustomer.order.show',['order'=>$financial->order_num]) }}" class="font-medium whitespace-no-wrap">
                                <p class="text-base font-bold">{{ $financial->order_num }}</p>
                                <div class="text-xs text-gray-600 whitespace-no-wrap">{{ $financial->item_run_datetime->format('d/m/Y H:i') }} - {{ $financial->item_conclusion_datetime->format('d/m/Y H:i') }}</div>
                            </a>
                        </td>
                        <td class="">
                            {{ number_format($financial->item_conclusion_price, 2, ",", ".") }}
                        </td>
                        <td class="text-center text-lg">
                            {{ $financial->service_name }}
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
<!-- Valor total -->
<div class="mt-2 p-2 intro-y">
    <div class="flex">
        <div class="">
            <div class="text-2xl font-bold leading-8">
                Total: R${{number_format($financial_total->financial_total_price, 2, ",", ".")}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#table').DataTable({
        dom: 'Bfrtip',
        language: dataOptionsLanguage,
        buttons: dataOptionsButtons,
        ordering: true,
        order: [],
        columnDefs: [
            
        ]
    });
</script>
@endsection
