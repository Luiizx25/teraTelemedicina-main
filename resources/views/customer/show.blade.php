@extends('_layout.side-menu',[
    'title' => __('Customer'),
    'useJquery' => true,
    'useDataTable' => true,
    'useMaskMoney' => false,
])

@section('subcontent')
<div class="grid grid-cols-12 gap-3">
    <div class="col-span-12 lg:col-span-12 xxl:col-span-12 flex lg:block flex-col-reverse">
        <div class="flex items-center">
            <div class="mr-auto">
                <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Customer')}}</h2>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                <div class="dropdown-box">
                    <div class="dropdown-box__content box dark:bg-dark-1">
                        <div class="p-2">
                            <a href="{{route('toManager.customer.edit',['customer' => $customer->cus_slug])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="edit-3" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('Edit')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro-y box p-4">
            <div class="flex justify-between">
                <div>
                    <div class="font-medium text-base">
                        <div>{{$customer->cus_name??'--'}}</div>
                        @if ($customer->cus_name_company)
                            <div class="text-gray-600 text-sm -mt-1">{{$customer->cus_name_company}}</div>
                        @endif
                    </div>
                    <p class="inline-block text-xs text-white mt-1 px-1 bg-theme-1 rounded">{{__('Customer')}} Id: {{$customer->id}}</span>
                </div>
                <div>
                    <div class="image-cover h-16 w-full">
                        @empty($customer->cus_logo)
                            <img class="rounded h-16" src="{{asset('/app/images/default_profile.png')}}">
                        @else
                            <img class="rounded h-16" src="{{asset('storage/' . $customer->cus_logo)}}">
                        @endempty
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-span-12 lg:col-span-12">
        <div class="grid grid-cols-12 gap-2">
            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12 box">
                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                    <div class="mr-auto">
                        <h2 class="font-medium text-base mr-auto">
                            {{__('Identification')}}
                        </h2>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-2">
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                            <div class="text-gray-600 text-xs">{{__('Customer Type')}}</div>
                            <p class="font-medium">{{$customer->type->ref_description??'--'}}</p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                            <div class="text-gray-600 text-xs uppercase">{{$customer->cus_doc_type}}</div>
                            <p class="font-medium">{{$customer->cus_doc_num??'--'}}</p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-7">
                            <div class="text-gray-600 text-xs">{{__('Address')}}</div>
                            <p class="font-medium">
                                {{$customer->cus_street??'--'}} {{$customer->cus_street_num??'--'}} {{$customer->cus_street_complement??''}}
                                {{$customer->cus_neighborhood??'--'}} - {{$customer->cus_city??'--'}}/{{$customer->cus_state??'--'}} - {{$customer->cus_postalcode??'--'}}
                            </p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                            <div class="text-gray-600 text-xs">{{__('Use Logo')}}</div>
                            <p class="font-medium">{{($customer->cus_logo_use?'Sim':'Não')??'--'}}</p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                            <div class="text-gray-600 text-xs">{{__('Phone')}}</div>
                            <p class="font-medium">{{$customer->cus_phone??'--'}}</p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-6">
                            <div class="text-gray-600 text-xs">{{__('Email')}}</div>
                            <p class="font-medium"><a href="mailto:{{$customer->cus_email??'#'}}" target="_blank">{{$customer->cus_email??'--'}}</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 lg:mt-1 box">
                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                    <div class="mr-auto">
                        <h2 class="font-medium text-base mr-auto">
                            {{__('Manager Contact')}}
                        </h2>
                    </div>
                </div>
                <div class="p-5">
                    <div class="tab-content">
                        <div class="tab-content__pane active" id="latest-tasks-new">
                            <div class="flex items-center">
                                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full">
                                    <div class="text-gray-600 text-xs">{{__('Name')}}</div>
                                    <p class="font-medium">{{$customer->cus_manager_name??'--'}}</p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full">
                                    <div class="text-gray-600 text-xs">{{__('Phone')}}</div>
                                    <p class="font-medium">{{$customer->cus_manager_phone??'--'}}</p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full">
                                    <div class="text-gray-600 text-xs">{{__('Email')}}</div>
                                    <p class="font-medium"><a href="mailto:{{$customer->cus_manager_email??'#'}}" target="_blank">{{$customer->cus_manager_email??'--'}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 lg:mt-1 box">
                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                    <div class="mr-auto">
                        <h2 class="font-medium text-base mr-auto">
                            {{__('Financial Contact')}}
                        </h2>
                    </div>
                </div>
                <div class="p-5">
                    <div class="tab-content">
                        <div class="tab-content__pane active" id="latest-tasks-new">
                            <div class="flex items-center">
                                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full">
                                    <div class="text-gray-600 text-xs">{{__('Name')}}</div>
                                    <p class="font-medium">{{$customer->cus_financial_name??'--'}}</p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full">
                                    <div class="text-gray-600 text-xs">{{__('Phone')}}</div>
                                    <p class="font-medium">{{$customer->cus_financial_phone??'--'}}</p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full">
                                    <div class="text-gray-600 text-xs">{{__('Email')}}</div>
                                    <p class="font-medium"><a href="mailto:{{$customer->cus_financial_email??'#'}}" target="_blank">{{$customer->cus_financial_email??'--'}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 lg:mt-1 box">
                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                    <div class="mr-auto">
                        <h2 class="font-medium text-base mr-auto">
                            {{__('Bank Information')}}
                        </h2>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-2">
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12">
                            <div class="text-gray-600 text-xs">{{__('Bank')}}</div>
                            <p class="font-medium">{{$customer->bank->ref_options??'--'}} - {{$customer->bank->ref_description??'--'}}</p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6">
                            <div class="text-gray-600 text-xs">{{__('Agency')}}</div>
                            <p class="font-medium">{{$customer->bank_agency_num?str_pad($customer->bank_agency_num , 5 , '0' , STR_PAD_LEFT):' -- '}}-{{$customer->bank_agency_dv??' -- '}}</p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6">
                            <div class="text-gray-600 text-xs">{{__('Account Type')}}</div>
                            <p class="font-medium">{{$customer->bankAccountType->ref_description??'--'}}</p>
                        </div>
                        <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6">
                            <div class="text-gray-600 text-xs">{{__('Account')}}</div>
                            <p class="font-medium">{{$customer->bank_account_num??' -- '}}-{{$customer->bank_account_dv??' -- '}}</p>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 lg:mt-1 box p-5">
                <div class="relative flex items-center mb-4">
                    <div class="mr-auto">
                        <h2 class="font-medium text-base mr-auto">
                            {{__('Contracts')}}
                        </h2>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                        <div class="dropdown-box w-56">
                            <div class="dropdown-box__content box dark:bg-dark-1">
                                <div class="p-2">
                                    <a href="{{route('toManager.customerContract.create',['customerSlug' => $customer->cus_slug])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">{{__('New Contract')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table id="table" class="table table-report -mt-2 display">
                        <thead>
                            <tr>
                                <th class="text-center whitespace-no-wrap">{{__('Status')}}</th>
                                <th class="whitespace-no-wrap">{{__('Contract')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Type')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Volume free')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Signing')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Start')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('End')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customer->ContractCustomer as $item)

                                <tr class="intro-x shadow hover:shadow-lg">

                                    <td class="">
                                        <div class="flex items-center justify-center {{ $item->active ? 'text-theme-9' : 'text-theme-6' }}">
                                            <i data-feather="{{ $item->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i> {{$item->active?'Ativo':'Inativo'}}
                                        </div>
                                    </td>

                                    <td class="text-left">
                                        <a href="{{route('toManager.customerContract.show',[$item->contract_num])}}" class="flex items-center mr-3 font-medium whitespace-no-wrap">
                                            {{$item->contract_num}}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{$item->type->ref_description}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->contract_volume_free?'Sim':'Não'}}
                                    </td>
                                    <td class="text-left">
                                        <p class="text-center text-xs whitespace-normal">{{$item->contract_date->format('d/m/Y')}}</p>
                                    </td>
                                    <td class="text-left">
                                        <p class="text-center text-xs whitespace-normal">{{$item->contract_date_start->format('d/m/Y')}}</p>
                                    </td>
                                    <td class="text-left">
                                        <p class="text-center text-xs whitespace-normal">{{$item->contract_date_end->format('d/m/Y')}}</p>
                                    </td>
                                </tr>
                            @empty
                                {{-- <tr class="intro-x shadow rounded"><td colspan="8">{{__('No items registered in the database')}}</td></tr> --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- END: Data List -->
            </div>

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 lg:mt-1 box p-5">
                <div class="relative flex items-center mb-4">
                    <div class="mr-auto">
                        <h2 class="font-medium text-base mr-auto">
                            {{__('Users')}}
                        </h2>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                        <div class="dropdown-box w-56">
                            <div class="dropdown-box__content box dark:bg-dark-1">
                                <div class="p-2">
                                    <a href="{{route('toManager.customerUser.create',['customerSlug' => $customer->cus_slug])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">{{__('New User')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table id="tableUsers" class="table table-report -mt-4 display">
                        <thead>
                            <tr>
                                <th class="text-center whitespace-no-wrap">{{__('Status')}}</th>
                                <th class="whitespace-no-wrap">{{__('Name')}} / {{__('Email')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Phone')}}</th>
                                <th class="text-center whitespace-no-wrap">{{__('Permissions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customer->user as $user)
                                @if ($user->id < 1000)
                                    @continue
                                @endif
                                {{--  --}}
                                <tr class="intro-x shadow hover:shadow-lg">
                                    <td class="">
                                        <div class="flex items-center justify-center {{ $user->active ? 'text-theme-9' : 'text-theme-6' }}">
                                            <i data-feather="{{ $user->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i> {{$user->active?'Ativo':'Inativo'}}
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        <a href="{{route('toManager.customerUser.edit',['customerUser' => $user->email,'customerSlug'=>$customer->cus_slug])}}" class="hover:text-yellow-800">
                                            <p class="text-lg font-medium">{{$user->name}}</p>
                                            <p class="text-sm text-gray-500 -mt-1 font-medium">{{$user->email}}</p>
                                        </a>
                                    </td>
                                    <td class="text-left">
                                        <p class="text-center text-xs whitespace-normal">{{$user->phone_mobile}}</p>
                                        <p class="text-center text-xs whitespace-normal">{{$user->phone}}</p>
                                    </td>
                                    <td class="">
                                        <div class="flex justify-center">
                                        @if ($user->pivot->tecnical)
                                            <i data-feather="activity" class="w-4 h-4 mx-1"></i>
                                        @endif
                                        @if ($user->pivot->financial)
                                            <i data-feather="dollar-sign" class="w-4 h-4 mx-1"></i>
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                {{-- <tr class="intro-x shadow rounded"><td colspan="8">{{__('No items registered in the database')}}</td></tr> --}}
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <!-- END: Data List -->
            </div>

        </div>

    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                //dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                ordering: true,
                order: [],
            });
            $('#tableUsers').DataTable({
                //dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                ordering: true,
                order: [],
            });
        } );
    </script>
@endsection
