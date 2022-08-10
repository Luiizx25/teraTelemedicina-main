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
                {{__('Log de Acesso')}}
            </div>
        </div>
        <div class="ml-auto">
            <form action="{{route('toManager.log')}}" method="POST">
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
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Date')}}</th>
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('IP')}}</th>
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('E-mail')}}</th>
                    <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Ocorrência')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user_log as $userLog)
                    <tr class="intro-x shadow hover:shadow-lg">
                        <td class="">
                            <div class="py-1 px-2 rounded shadow-md bg-gray-200">
                                <p class="text-xl">{{ $userLog["created_at"]->format("d/m/Y H:i:s") }}</p>
                            </div>
                        </td>
                        <td class="">
                            <p class="text-xl">{{ $userLog["ip"] }}</p>
                        </td>
                        <td class="">
                            <p class="text-xl">{{ $userLog["user"] }} </p>
                        </td>
                        <td class="">
                            <p class="text-xl">{{ $userLog["occurrence"] }} </p>
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
        language: dataOptionsLanguage,
        buttons: dataOptionsButtons,
        ordering: true,
        order: [],
        columnDefs: [
            
        ]
    });
</script>
@endsection
