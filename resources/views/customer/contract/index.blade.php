@extends('_layout.side-menu',[
    'title' => __('Customer Contracts'),
    'useJquery' => true,
    'useDataTable' => true,
    'useMaskMoney' => false,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Customer Contracts')}}</h2>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-2">

        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4">
            <table id="table" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="text-center whitespace-no-wrap">{{__('Status')}}</th>
                        <th class="whitespace-no-wrap">{{__('Customer')}} {{__('Contract')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Type')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Volume free')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Reference')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Start')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('End')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contracts as $item)

                        <tr class="intro-x shadow hover:shadow-lg">

                            <td class="">
                                <div class="flex items-center justify-center {{ $item->active ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $item->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i> {{$item->active?'Ativo':'Inativo'}}
                                </div>
                            </td>

                            <td class="text-left">
                                <a href="{{route('toManager.customerContract.show',[$item->contract_num])}}" class="font-medium whitespace-no-wrap">
                                    {{$item->customer->cus_name}}
                                    <p class="text-gray-600 text-xs whitespace-normal">{{$item->contract_num}}</p>
                                </a>
                            </td>
                            <td class="text-center">
                                {{$item->type->ref_description}}
                            </td>
                            <td class="text-center">
                                {{$item->contract_volume_free?'Sim':'Não'}}
                            </td>
                            <td class="text-left">
                                <p class="text-center text-xs whitespace-normal">{{date_format(date_create($item->contract_date),'Y-m')}}</p>
                            </td>
                            <td class="text-left">
                                <p class="text-center text-xs whitespace-normal">{{date_format(date_create($item->contract_date_start),'d/m/Y')}}</p>
                            </td>
                            <td class="text-left">
                                <p class="text-center text-xs whitespace-normal">{{date_format(date_create($item->contract_date_end),'d/m/Y')}}</p>
                            </td>

                        </tr>
                    @empty
                        {{-- <tr class="intro-x shadow rounded"><td colspan="6">{{__('No items registered in the database')}}</td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                ordering: true,
                order: []
            });
        } );
    </script>
@endsection
