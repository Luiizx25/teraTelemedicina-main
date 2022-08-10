@extends('_layout.side-menu',[
    'title' => __('contratos Admin'),
    'useJquery' => true,
    'useDataTable' => true,
    'useInputmask' => true,
])


@section('subcontent')

    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

        <!-- BEGIN: Ticket -->
        @php
            switch (session('tabActive')) {
                case 'contratos':
                    $details = null;
                    $contratos = 'active';
                    break;
                default:
                    $details = 'active';
                    $contratos = null;
            }
        @endphp

        <div class="col-span-12 lg:col-span-12">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <div class="pos__tabs nav-tabs justify-center flex">
                        <a data-toggle="tab" data-target="#details" href="javascript:;" class="{{$details}} flex-1 py-2 rounded-md text-center">{{__('Details')}}</a>
                        <a data-toggle="tab" data-target="#contratos" href="javascript:;" class="{{$contratos}} flex-1 py-2 rounded-md text-center">{{__('Contratos')}}</a>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <!-- -->
                <div class="tab-content__pane {{$details}}" id="details">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 px-4">
                        <div class="mr-auto">
                            <h2 class="text-2xl font-medium mr-5">{{__('Details')}}</h2>
                        </div>
                    </div>
                    <div class="box p-5 mt-2">

                        <div class="flex items-center pb-5">
                            <div class="">
                                <div class="text-gray-900 text-2xl capitalize">{{ $provider->user->name }}</div>

                                @if ($provider->pvd_name_company)
                                    <div class="text-gray-600 -mt-1 text-sm capitalize">{{ $provider->pvd_name_company }}</div>
                                @endif

                                <div class="text-gray-900 text-base uppercase">
                                    {{ $provider->pvd_identity_type ?? '--' }} - {{ $provider->pvd_identity_uf ?? '--' }} / {{ $provider->pvd_identity_num?? '--' }}
                                </div>

                                @if ($provider->specialty_id)
                                    <div class="text-gray-600 -mt-1 text-sm capitalize">{{ $provider->specialty->ref_description }}</div>
                                @endif

                                <div class="text-gray-900 mt-2 pt-2 capitalize border-t">
                                    <p>
                                        {{ $provider->pvd_street }}
                                        {{ $provider->pvd_street_num }}
                                        @if ($provider->pvd_street_complement)
                                            - {{ $provider->pvd_street_complement }}
                                        @endif
                                    </p>
                                    <p>
                                        {{ $provider->pvd_neighborhood }} - {{ $provider->pvd_city }} / {{ $provider->pvd_state }}
                                    </p>
                                    <p>
                                        CEP: {{ $provider->pvd_postalcode }}
                                    </p>
                                </div>
                            </div>
                            <i data-feather="compass" class="w-4 h-4 text-gray-600 ml-auto"></i>
                        </div>

                    </div>
                </div>
                <!-- -->
                <div class="tab-content__pane {{$contratos}}" id="contratos">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 px-4">
                        <div class="mr-auto">
                            <h2 class="text-2xl font-medium mr-5">{{__('Contratos')}}</h2>
                        </div>
                    </div>

                    {{-- {{ dd(
                        $provider->ContractCustomer->toArray(),
                        $provider->toArray(),
                    ) }} --}}

                    <div class="box p-4 mt-2">
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table id="table" class="table table-report -mt-4 display">
                                <thead>
                                    <tr>
                                        <th class="whitespace-no-wrap">{{__('Número')}}</th>
                                        <th class="text-center whitespace-no-wrap">{{__('Situação')}}</th>
                                        <th class="text-center whitespace-no-wrap">{{__('Data')}}</th>
                                        <th class="text-center whitespace-no-wrap">{{__('Início')}}</th>
                                        <th class="text-center whitespace-no-wrap">{{__('Término')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($provider->ContractProvider as $contract)
                                        <tr class="intro-x shadow hover:shadow-lg">
                                            <td class="flex" title="">
                                                <a href="javascript:;" id="btn-services-{{$contract->id}}" data-toggle="modal" data-target="#modal-service-{{$contract->id}}" class="text-gray-600 hover:text-yellow-600">
                                                    <i data-feather="sliders" class="w-4 h-4 mt-1 mr-2"></i>
                                                </a>
                                                <!-- MODAL -->
                                                <div class="modal" id="modal-service-{{$contract->id}}">
                                                    <div class="modal__content modal__content--xl">
                                                        {{--  --}}

                                                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                                                            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                                                <h2 class="font-medium text-base mr-auto">{{__('Serviços do contrato')}} - {{ $contract->contract_num }}</h2>
                                                            </div>
                                                            <div class="p-4">
                                                                @if ($contract->contractService->count())
                                                                    <ul class="px-4 list-disc">
                                                                        @foreach ($contract->contractService as $service)
                                                                            <li>{{ $service->service->service_name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    <div class="bg-red-100 text-lg p-2">Contrato não possui serviços cadastrados.</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        {{--  --}}
                                                    </div>
                                                </div>
                                                <!-- MODAL -->
                                                {{ $contract->contract_num }}
                                            </td>
                                            <td class="" title="">
                                                <div class="flex justify-center text-green-600">
                                                    @if ($contract->active)
                                                        <i data-feather="activity" class="w-4 h-4 mt-1 mr-1"></i>
                                                        Ativo
                                                    @else
                                                        --
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center" title="">
                                                {{ $contract->contract_date->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center" title="">
                                                {{ $contract->contract_date_start->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center" title="">
                                                {{ $contract->contract_date_end->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- <tr class="intro-x shadow rounded"><td colspan="8">{{__('No items registered in the database')}}</td></tr> --}}
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- -->
            </div>
        </div>
        <!-- END: Ticket -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                bAutoWidth: true,
                ordering: true,
                order: [],
            });
        } );

        // mobile.mask(input_phone_mobile);
        // phone.mask(input_phone);

        // if("{{$errors->any()??false}}")
        // {
        //     // OPEN MODAL
        //     cash('#modal-contratos-user-add').modal('show')
        // }
    </script>
@endsection
