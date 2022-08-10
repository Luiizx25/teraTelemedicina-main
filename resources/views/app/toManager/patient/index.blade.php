@extends('_layout.side-menu',[
    'title' => __('Patients'),
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => false,
    'useDataTable' => true,
    'useToastr' => false,
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
    <div class="grid grid-cols-12 gap-2">
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4 mt-2">
            <table id="table" class="table table-report display">
                <thead>
                    <tr>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Patient')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Document')}} / {{__('Location')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Orders')}}</th>
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
                        <td>
                            <a href="{{route('toCustomer.patient.showByDoc',['docType'=>strtoupper($patient->pat_doc_type),'docNum'=>$patient->pat_doc_num])}}">
                                <p class="text-base">{{ $patient->pat_doc_type }} {{ $patient->pat_doc_num }}</p>
                                <p class="">{{ $patient->pat_city??'--' }}/{{ $patient->pat_state??'--' }}</p>
                            </a>
                        </td>
                        <td>
                            @empty($patient->order)
                            <i data-feather="minus" class="w-5 h-5 mr-2 text-theme-6"></i>
                            @else
                            <div class=" text-theme-9 flex">
                                <i data-feather="layers" class="w-5 h-5 mr-1"></i> {{ $patient->order->count() }}
                            </div>
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
        columnDefs: []
    });
</script>
@endsection
