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
                <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Users')}}</h2>
            </div>
            <div class="ml-auto">
                <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button py-1 px-2 rounded inline-block bg-theme-1 text-white">
                    <div class="flex items-center justify-center text-white">
                        {{__('Add User')}}
                    </div>
                </a>
            </div>
            <!-- MODAL -->
            <div class="modal" id="modal-service-add">
                <div class="modal__content modal__content--xl">
                    <form id="form_customer_user_add" action="{{route('toManager.customerUser.create')}}" method="get">
                        <div class="flex items-center border-b border-teal-500 p-4">
                            <select id="customerSlug" name="customerSlug" data-search="true" class="tail-select w-full z-40 px-2" aria-required="" required>
                                <option value="">{{__('Select Customer')}}</option>
                                @foreach ($customers as $customer)
                                <option value="{{$customer->cus_slug}}">#{{str_pad($customer->id, 4, "0", STR_PAD_LEFT)}} - {{$customer->cus_name}}</option>
                                @endforeach
                            </select>
                            <button class="button bg-theme-1 text-white w-48 mr-1">{{__('Add User')}}</button>
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300">{{__('Cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- MODAL -->
        </div>
        <div class="col-span-12 sm:col-span-12 lg:col-span-12 lg:mt-1 box p-5">
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table id="tableUsers" class="table table-report -mt-4 display">
                    <thead>
                        <tr>
                            <th class="text-center whitespace-no-wrap">{{__('Status')}}</th>
                            <th class="whitespace-no-wrap">{{__('Name')}} / {{__('email')}}</th>
                            <th class="whitespace-no-wrap">{{__('Customer')}}</th>
                            <th class="text-center whitespace-no-wrap">{{__('Phone')}}</th>
                            <th class="text-center whitespace-no-wrap">
                                Técnico
                            </th>
                            <th class="text-center whitespace-no-wrap">
                                Financeiro
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <!-- -->
                            @foreach ($customer->user as $user)
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
                                        <a href="{{route('toManager.customerUser.edit',['customerUser' => $user->email,'customerSlug'=>$customer->cus_slug])}}" class="">
                                            <p class="text-lg font-medium">{{$user->name}}</p>
                                            <p class="text-sm text-gray-500 -mt-1">{{$user->email}}</p>
                                        </a>
                                    </td>
                                    <td class="">
                                        <p class="font-medium break-words">{{$customer->cus_name}}</p>
                                        <p class="text-gray-600 text-xs whitespace-no-wrap">{{$customer->cus_doc_num}}</p>
                                    </td>
                                    <td class="text-left">
                                        <p class="text-center text-xs whitespace-normal">{{$user->phone_mobile}}</p>
                                        <p class="text-center text-xs whitespace-normal">{{$user->phone}}</p>
                                    </td>
                                    <td class="text-center">
                                        @if ($user->pivot->tecnical)
                                            <i data-feather="check-circle" class="w-4 h-4 text-green-900 mx-auto"></i><span class="sr-only">X</span>
                                        @else
                                            <i data-feather="x-circle" class="w-4 h-4 text-red-900 mx-auto"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($user->pivot->financial)
                                            <i data-feather="check-circle" class="w-4 h-4 text-green-900 mx-auto"></i><span class="sr-only">X</span>
                                        @else
                                            <i data-feather="x-circle" class="w-4 h-4 text-red-900 mx-auto"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <!-- -->
                        @endforeach
                    </tbody>

                </table>
            </div>
            <!-- END: Data List -->
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#tableUsers').DataTable({
                dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                ordering: true,
                order: [],
                columnDefs: [
                    { }
                ]
            });
        } );
    </script>
@endsection
