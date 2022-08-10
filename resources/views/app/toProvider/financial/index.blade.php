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
            <form action="{{route('toProvider.financial')}}" method="POST">
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
        @php
            $count = $financials->count();
        @endphp
        @forelse ($financials as $financial)
            <div class="flex items-center border-b dark:border-dark-5 pb-5">
                <div class="">
                    <div class="text-gray-600">{{$financial->service_name}}</div>
                    <div>{{$financial->total_items}}</div>
                </div>
            </div>
        @empty
            {{-- <tr class="intro-x shadow rounded"><td colspan="4">{{__('No items registered in the database')}}</td></tr> --}}
        @endforelse
    </div>
    <!-- END: Data List -->
</div>
@endsection

@section('script')
@endsection
