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
            <form action="{{route('toManager.financial')}}" method="POST">
                @csrf
                <select name="customer_name" id="customer_name" class="input border col-span-4 ">
                    <option value="">Select Customer</option>
                        @foreach ($customers as $customer)
                        @if ($customer->id==$customer_name)
                            <option value="{{$customer->id}}" selected>{{$customer->id}} - {{$customer->cus_name}}</option>
                        @else
                            <option value="{{$customer->id}}">{{$customer->id}} - {{$customer->cus_name}}</option>
                        @endif
                    @endforeach
                </select>
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
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Customer')}}</th>
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Total')}}</th>
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Total Items')}}</th>
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Items')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = count($financial_items);
                @endphp
                @forelse ($financial_items as $financial_item)
                    <tr class="intro-x shadow hover:shadow-lg">
                        <td class="">
                            <div class="py-1 px-2 rounded shadow-md bg-gray-200">
                                <p class="text-xl">{{ $financial_item["cus_name"] }}</p>
                            </div>
                        </td>
                        <td class="">
                            <p class="text-xl">R$ {{ number_format($financial_item["total_price"], 2, ",", ".") }}</p>
                        </td>
                        <td class="">
                            <p class="text-xl">{{ $financial_item["total_items"] }} Units</p>
                        </td>
                        <td class="">
                            @foreach ($financial_item["items"] as $item)
                                <p class="text-base">{{ $item["service_name"] }} - {{ $item["item_qtd"] }} Units</p>
                            @endforeach
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
