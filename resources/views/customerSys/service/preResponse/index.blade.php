@extends('_layout.side-menu',[
    'title' => __('Services Pre Response'),
    'useCkeditor' => true,
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => false,
    'useDataTable' => true,
    'useToastr' => true,
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-2">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <h2 class="text-2xl font-medium my-2 truncate">{{__('Services Pre Response')}}</h2>
            <div class="ml-auto mt-2">
                <a href="{{route('toManager.servicePreResponse.create')}}" class="button text-white bg-theme-1 shadow-md ml-auto">
                    {{__('New Pre Response')}}
                </a>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4">
            <table id="table_services" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Category')}}</th>
                        <th class="hover:bg-gray-200 text-center whitespace-no-wrap">{{__('Name')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Title')}}</th>
                        <th class="hover:bg-gray-200 whitespace-no-wrap">{{__('Description')}}</th>
                        <th class="">{{__('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = $services->count();
                    @endphp
                    @foreach ($services as $serviceKey => $serviceItem)
                        @foreach ($serviceItem->PreResponse as $PreResponseKey => $PreResponseItem)
                            <tr class="intro-x shadow hover:shadow-lg">
                                <td class="text-center capitalize">
                                    {{$serviceItem->category->ref_description}}
                                </td>
                                <td class="text-center capitalize">
                                    {{$serviceItem->service_name}}
                                </td>
                                <td class="text-left capitalize">
                                    {{$PreResponseItem->title}}
                                </td>
                                <td class="text-left capitalize">
                                    {{$PreResponseItem->description}}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('toManager.servicePreResponse.edit',['servicePreResponse'=>$PreResponseItem->slug])}}"class="flex hover:text-orange-600">
                                        <i data-feather="edit" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')
    <script>
        $('#table_services').DataTable({
            dom: 'Bfrtip',
            language: dataOptionsLanguage, pageLength: 50,
            buttons: dataOptionsButtons,
            ordering: true,
            order: [],
            columnDefs: [
                {
                    orderable: false, targets: [4]
                },
            ]
        });

        if("{{old('type_id')??false}}" && "{{old('category_id')??false}}")
        {
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

                    if(item.id == '{{old('type_id')}}')
                    {
                        $('#type_id').append(`<option value="${item.id}" selected>${item.ref_description}</option>`);
                    }
                    else
                    {
                        $('#type_id').append(`<option value="${item.id}">${item.ref_description}</option>`);
                    }
                });
            });

            $.getJSON('/api/serviceCategory/type/'+'{{old('type_id')}}', function(serviceCategory)
            {
                console.log('serviceCategory');
                console.log(serviceCategory);

                if(serviceCategory == '')
                {
                    toastr.error("{{__('No category to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceCategory, function (i, item) {

                    if(item.id == '{{old('category_id')}}')
                    {
                        $('#category_id').append(`<option value="${item.id}" selected>${item.ref_description}</option>`);
                    }
                    else
                    {
                        $('#category_id').append(`<option value="${item.id}">${item.ref_description}</option>`);
                    }
                });
            });

            // OPEN MODAL
            cash('#modal-service-add').modal('show')
        }

        $('#btn-service-open-modal').on('click', function()
        {
            if("{{old('type_id')??false}}" && "{{old('category_id')??false}}")
                return;

            // using the function:
            selectOptionsRemove(document.getElementById('category_id'));
            selectOptionsRemove(document.getElementById('type_id'));

            document.getElementById("category_id").disabled = true;

            $("#category_id").addClass('bg-gray-100 cursor-not-allowed');

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
                    $('#type_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });

        });

        $('#type_id').on('change', function()
        {
            // using the function:
            selectOptionsRemove(document.getElementById('category_id'));

            if($('#type_id').val() == '')
            {
                document.getElementById("category_id").disabled = true;
                $("#category_id").addClass('bg-gray-100 cursor-not-allowed');
                return;
            }

            $("#category_id").removeClass('bg-gray-100 cursor-not-allowed');
            document.getElementById("category_id").disabled = false;

            $.getJSON('/api/serviceCategory/type/'+$('#type_id').val(), function(serviceCategory)
            {
                console.log('serviceCategory');
                console.log(serviceCategory);

                if(serviceCategory == '')
                {
                    toastr.error("{{__('No category to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceCategory, function (i, item) {
                    $('#category_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });
        });


        $(document).ready( function ()
        {
            let count = "{{$count}}";

            console.log('count');
            console.log( count );

            var i, L = count - 1;

            for(i = L; i >= 0; i--)
            {

            }

        });

    </script>
@endsection
