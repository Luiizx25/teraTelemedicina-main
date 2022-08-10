@extends('_layout.side-menu',[
    'title' => __('Customers'),
    'useJquery' => true,
    'useDataTable' => true,
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-2">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <h2 class="text-2xl font-medium my-2 mr-5">{{__('Customers')}}</h2>
            <a href="{{route('toManager.customer.create')}}" class="button-sm py-1 px-2 rounded inline-block bg-theme-1 text-white ml-auto">{{__('New Customer')}}</a>
        </div>
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4">
            <table id="table_costumers" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="text-center">{{__('Logo')}}</th>
                        <th class="text-center">{{__('Name')}}</th>
                        <th class="text-center">{{__('Contact')}}</th>
                        <th class="text-center">{{__('Location')}}</th>
                        <th class="text-center">{{__('Status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $item)
                        <tr class="intro-x shadow hover:shadow-lg">
                            <td class="w-10">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    @if ($item->cus_logo_use == 'customerSys')
                                        <img class="rounded" src="{{asset('dist/images/default_profile.png')}}">
                                    @elseif ($item->cus_logo_use == 'customer')
                                        <img class="rounded" src="{{asset('storage/' . $item->cus_logo)}}">
                                    @else
                                        <img class="rounded" src="{{asset('dist/images/default_profile.png')}}">
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{route('toManager.customer.show',[$item->cus_slug])}}">
                                    <div class="truncate">
                                        <p class="text-gray-900 truncate text-sm">{{$item->cus_name}}</p>
                                        <p class="text-gray-600 truncate text-xs">
                                            {{$item->cus_name_company}}
                                        </p>
                                    </div>
                                </a>
                            </td>
                            <td class="text-left">
                                <p class="truncate font-medium">{{$item->cus_email}}</p>
                                <p class="truncate text-gray-600 text-xs">{{$item->cus_phone}}</p>
                            </td>
                            <td class="text-center">
                                <div class="text-xs">{{$item->cus_city}}/{{$item->cus_state}}</div>
                            </td>
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ false ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $item->status->ref_icon??'--'}}" class="w-4 h-4 mr-1"></i> {{ $item->status->ref_description??'--'}}
                                </div>
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
            $('#table_costumers').DataTable({
                dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                order: [],
                columnDefs: [
                    { orderable: false, targets: [0] }
                ]
            });
        } );
    </script>
@endsection
