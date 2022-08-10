@extends('_layout.side-menu',[
    'title' => __('Providers Type'),
    'useJquery' => true,
    'useDataTable' => true,
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-2">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <h2 class="text-2xl font-medium truncate">{{__('Providers Types')}}</h2>
            <div class="ml-auto mt-2">
                <a href="javascript:;" id="modal-provider-type-add-open-btn" data-toggle="modal" data-target="#modal-provider-type-add" class="button text-white bg-theme-1 shadow-md ml-auto">
                    {{__('New type')}}
                </a>
            </div>
            <!-- MODAL -->
            <div class="modal" id="modal-provider-type-add">
                <div class="modal__content modal__content--xl">
                    <form id="form_provider_add" action="{{route('toManager.providerType.store')}}" method="post">
                        @csrf
                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                <div class="mr-auto">
                                    <h2 class="font-medium text-base mr-auto">{{__('New Provider Type')}}</h2>
                                </div>
                                @if (session('status_error'))
                                <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="p-5">

                                <div class="grid grid-cols-12 gap-2 mt-4">
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-4">
                                        <div class="mb-2">{{__('Type')}}</div>
                                        <input type="text" id="ref_description" name="ref_description" value="{{old('ref_description')}}" class="input w-full border flex-1" aria-required="" required>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-8">
                                        <div class="mb-2">{{__('Description')}}</div>
                                        <input type="text" id="ref_placeholder" name="ref_placeholder" value="{{old('ref_placeholder')}}" class="input w-full border flex-1">
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-4">
                                    <div class="intro-y col-span-12 mt-2 text-right">
                                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                        <button class="button bg-theme-1 text-white">{{__('Add')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- MODAL -->

        </div>
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4 mt-2">
            <table id="table" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Status')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Type')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Description')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = $providerTypes->count();
                    @endphp
                    @forelse ($providerTypes as $typeKey => $typeItem)
                        <tr class="intro-x shadow hover:shadow-lg">
                            <td class="">
                                <div class="flex items-center justify-center {{ $typeItem->ref_to_view ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $typeItem->ref_to_view?'activity':'slash'}}" class="w-4 h-4 mr-1"></i>
                                </div>
                            </td>
                            <td class="">
                                {{$typeItem->ref_description}}
                            </td>
                            <td>
                                {{$typeItem->ref_placeholder}}
                            </td>
                            <td class="table-report__action w-20">
                                @if ($typeItem->customer_sys_id??false)
                                <a href="javascript:;" id="modal-provider-type-add-open-btn" data-toggle="modal" data-target="#modal-provider-edit-{{$typeItem->id}}" class="">
                                    <div class="flex items-center justify-center {{ $typeItem->to_view ? 'text-theme-9' : 'text-theme-6' }}">
                                        <i data-feather="edit" class="w-4 h-4 mr-1"></i> {{__('Edit')}}
                                    </div>
                                </a>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 cursor-not-allowed">
                                        <i data-feather="slash" class="w-4 h-4 mr-1"></i> {{__('No Edit')}}
                                    </div>
                                @endif
                                <!-- MODAL -->
                                @if ($typeItem->customer_sys_id??false)
                                <div class="modal" id="modal-provider-edit-{{$typeItem->id}}">
                                    <div class="modal__content modal__content--xl">
                                        <form id="form_provider_add" action="{{route('toManager.providerType.update',['providerType'=>$typeItem->id])}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="ref_slug" value="{{$typeItem->ref_slug}}">

                                            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                                                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                                    <div class="mr-auto">
                                                        <h2 class="font-medium text-base mr-auto">{{__('Edit type provider')}}</h2>
                                                    </div>
                                                    @if (session('status_error'))
                                                    <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                        <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                                        <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="p-5">

                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="col-span-12 sm:col-span-4 lg:col-span-4">
                                                            <div class="mb-2">{{__('Description')}}</div>
                                                            <input type="text" id="ref_description-{{$typeKey}}" name="ref_description" value="{{old('ref_description',$typeItem->ref_description)}}" class="input w-full border flex-1" aria-required="" required>
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-8 lg:col-span-8">
                                                            <div class="mb-2">{{__('Placeholder')}}</div>
                                                            <input type="text" id="ref_placeholder-{{$typeKey}}" name="ref_placeholder" value="{{old('ref_placeholder',$typeItem->ref_placeholder)}}" class="input w-full border flex-1">
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-left">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-{{$typeKey}}" class="button inline-block bg-theme-6 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Delete type')}}</a>
                                                        </div>
                                                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-right">
                                                            <button type="button" data-dismiss="modal" class="button w-full sm:w-1/2 lg:w-auto border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1 mt-2">{{__('Cancel')}}</button>
                                                            <button class="button bg-theme-1 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Change')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- -->
                                        <div class="modal" id="delete-modal-{{$typeKey}}">
                                            <div class="modal__content">
                                                <form action="{{route('toManager.providerType.destroy',['providerType'=>$typeItem->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                        <div class="text-2xl mt-5">{{__('Are you sure?')}}</div>
                                                        <div class="text-gray-600 mt-2">{{__('This process cannot be undone')}}</div>
                                                    </div>
                                                    <div class="px-5 pb-8 text-center">
                                                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                        <button type="submit" class="button w-24 bg-theme-6 text-white">{{__('Delete')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- -->
                                    </div>
                                </div>
                                @endif
                                <!-- MODAL -->
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

        $('#table').DataTable({
            dom: 'Bfrtip',
            language: dataOptionsLanguage, pageLength: 50,
            buttons: dataOptionsButtons,
            ordering: true,
            order: [],
            columnDefs: [
                { orderable: false, targets: [3] }
            ],
        });

        if("{{old('ref_description')??false}}" && "{{old('ref_placeholder')??false}}")
        {
            // OPEN MODAL
            cash('#modal-provider-type-add').modal('show')
        }

    </script>
@endsection
