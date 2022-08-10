@extends('_layout.side-menu',[
    'title' => __('Patients'),
    'useJquery' => true,
    'useInputmask' => true,
    'useDataTable' => true,
])

@section('subcontent')
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <h2 class="text-2xl font-medium my-2 truncate">{{__('Patients')}}</h2>
        <div class="ml-auto mt-2">
            <a href="{{route('toCustomer.order.create')}}" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto">
                {{__('New order')}}
            </a>
        </div>
    </div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="ml-auto">
            <form action="{{route('toCustomer.patient.showByCPF')}}" method="POST">         
                @csrf
                <input type="text" id="doc_num" name="doc_num" data-toggle="modal" data-target="#modal-service-add" class="input border flex-1" placeholder="CPF">
                <input type="submit" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto" value="Buscar">
            </form>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-2">
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4 mt-2">
            <table id="table" class="table table-report display">
                <thead>
                    <tr>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Patient')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Document')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Location')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap text-center">{{__('Items')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                    <tr class="intro-x shadow hover:shadow-lg px-2">
                        <td>
                            <a href="{{route('toCustomer.patient.showByDoc',['docType'=>strtoupper($patient->pat_doc_type),'docNum'=>$patient->pat_doc_num])}}">
                                <div class="py-1 px-2 rounded shadow-md bg-gray-200">
                                    <p class="text-xl">{{ $patient->pat_name }}</p>
                                    <p class="text-xs text-gray-600">{{ $patient->pat_date_birth->format('d/m/Y')??'---' }} - {{ getAge($patient->pat_date_birth)??'--' }} {{__('Years')}}</p>
                                </div>
                            </a>
                        </td>
                        <td class="">
                            <div class="text-base">{{ $patient->pat_doc_num }}</div>
                            <div class="text-xs text-gray-600">{{ $patient->pat_doc_type }}</div>
                        </td>
                        <td>
                            <p class="">{{ $patient->pat_city??'--' }}/{{ $patient->pat_state??'--' }}</p>
                        </td>
                        <td class="text-center">
                            @empty($patient->order)
                                <i data-feather="minus" class="w-5 h-5 mr-2 text-theme-6"></i>
                            @else
                                @php
                                    $orderItensCount = 0;
                                    //
                                    foreach ($patient->order as $order)
                                        $orderItensCount = $orderItensCount + $order->itens->count();
                                @endphp
                                {{ $orderItensCount }}
                            @endempty
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
        columnDefs: [],
        searching: false
    });
    cpf.mask(doc_num);
</script>
@endsection
