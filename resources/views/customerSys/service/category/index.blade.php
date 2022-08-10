@extends('_layout.side-menu',[
    'title' => __('Services Category'),
    'useJquery' => true,
    'useDataTable' => true,
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-2">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <h2 class="text-2xl font-medium truncate">{{__('Services Categories')}}</h2>

            <div class="ml-auto mt-2">
                <a href="javascript:;" id="btn-open-modal-add" data-toggle="modal" data-target="#modal-add" class="button-sm py-1 px-2 rounded inline-block bg-theme-1 text-white">
                    <div class="flex items-center justify-center text-white">
                        {{__('Register')}}
                    </div>
                </a>
            </div>
            <!-- MODAL -->
            <div class="modal" id="modal-add">
                <div class="modal__content modal__content--xl">
                    <form id="form_service_add" action="{{route('toManager.serviceCategory.store')}}" method="post">
                        @csrf
                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                <div class="mr-auto">
                                    <h2 class="font-medium text-base mr-auto">{{__('New Service Category')}}</h2>
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
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-3">
                                        <div class="mb-2">{{__('Type')}}</div>
                                        <select id="service_type_id" name="service_type_id" class="input w-full border flex-1" aria-required="" required>
                                            <option value=""> -- </option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-3">
                                        <div class="mb-2">{{__('Description')}}</div>
                                        <input type="text" id="ref_description" name="ref_description" value="{{old('ref_description')}}" class="input w-full border flex-1" aria-required="" required>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12 lg:col-span-6">
                                        <div class="mb-2">{{__('Placeholder')}}</div>
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
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4">
            <table id="table" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Status')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Type')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Description')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Placeholder')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = $serviceCategories->count();
                    @endphp
                    @forelse ($serviceCategories as $typeKey => $typeItem)
                        <tr class="intro-x shadow hover:shadow-lg">
                            <td class="">
                                <div class="flex items-center justify-center {{ $typeItem->ref_to_view ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $typeItem->ref_to_view?'activity':'slash'}}" class="w-4 h-4 mr-1"></i>
                                </div>
                            </td>
                            <td class="">
                                {{$typeItem->type->ref_description}}
                                <p class="text-gray-600 text-xs ">{{$typeItem->type->ref_placeholder}}</p>
                            </td>
                            <td class="">
                                {{$typeItem->ref_description}}
                            </td>
                            <td>
                                {{$typeItem->ref_placeholder}}
                            </td>
                            <td class="table-report__action w-20">
                                @if ($typeItem->customer_sys_id??false)
                                <a href="javascript:;" id="btn-open-modal-add" data-toggle="modal" data-target="#modal-service-edit-{{$typeItem->id}}" class="">
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
                                <div class="modal" id="modal-service-edit-{{$typeItem->id}}">
                                    <div class="modal__content modal__content--xl">
                                        <form id="form_service_add" action="{{route('toManager.serviceCategory.update',['serviceCategory'=>$typeItem->id])}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="ref_slug" value="{{$typeItem->ref_slug}}">

                                            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                                                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                                    <div class="mr-auto">
                                                        <h2 class="font-medium text-base mr-auto">{{__('Edit Category')}}</h2>
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
                                                        <div class="col-span-12 sm:col-span-4 lg:col-span-3">
                                                            <div class="mb-2">{{__('Type')}}</div>
                                                            <select id="service_type_id-{{$typeKey}}" name="service_type_id" class="input w-full border flex-1" aria-required="" required>
                                                                <option value=""> -- </option>
                                                                @foreach ($RefServiceType as $refItem)
                                                                    <option value="{{$refItem->id}}" @if ($refItem->id==old('service_type_id',$typeItem->service_type_id)) selected @endif>{{$refItem->ref_description}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-4 lg:col-span-3">
                                                            <div class="mb-2">{{__('Description')}}</div>
                                                            <input type="text" id="ref_description-{{$typeKey}}" name="ref_description" value="{{old('ref_description',$typeItem->ref_description)}}" class="input w-full border flex-1" aria-required="" required>
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-8 lg:col-span-6">
                                                            <div class="mb-2">{{__('Placeholder')}}</div>
                                                            <input type="text" id="ref_placeholder-{{$typeKey}}" name="ref_placeholder" value="{{old('ref_placeholder',$typeItem->ref_placeholder)}}" class="input w-full border flex-1">
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-left">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-{{$typeKey}}" class="button inline-block bg-theme-6 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Delete Service')}}</a>
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
                                                <form action="{{route('toManager.serviceCategory.destroy',['serviceCategory'=>$typeItem->id])}}" method="post">
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
        });

        if("{{old('ref_description')??false}}" && "{{old('ref_placeholder')??false}}")
        {
            // using the function:
            selectOptionsRemove(document.getElementById('service_type_id'));

            $.getJSON('/api/serviceType', function(serviceType)
            {
                console.log('serviceType');
                console.log(serviceType);

                if(serviceType == '')
                {
                    toastr.error("{{__('No service type to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceType, function (i, item) {

                    if(item.id == '{{old('service_type_id')}}')
                        var selected = 'selected';
                    else
                        var selected = null;

                    $('#service_type_id').append(`<option value="${item.id}" ${selected}>${item.ref_description}</option>`);
                });
            });

            // OPEN MODAL
            cash('#modal-add').modal('show')
        }

        $('#btn-open-modal-add').on('click', function()
        {
            if("{{old('ref_description')??false}}" && "{{old('ref_placeholder')??false}}")
                return;

            // using the function:
            selectOptionsRemove(document.getElementById('service_type_id'));

            $.getJSON('/api/serviceType', function(serviceType)
            {
                console.log('serviceType');
                console.log(serviceType);

                if(serviceType == '')
                {
                    toastr.error("{{__('No service type to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceType, function (i, item) {
                    $('#service_type_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });

        });

    </script>
@endsection
