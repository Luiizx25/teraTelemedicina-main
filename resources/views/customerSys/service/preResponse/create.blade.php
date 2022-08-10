@extends('_layout.side-menu',[
    'title' => __('New Pre Response'),
    'useCkeditor' => true,
    'useJquery' => true,
    'useInputmask' => false,
    'useMaskMoney' => false,
    'useDataTable' => true,
    'useToastr' => true,
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-2">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center">
            <h2 class="text-2xl font-medium mt-2 truncate">{{__('New Pre Response')}}</h2>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12">

            <form action="{{route('toManager.servicePreResponse.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                    <div class="flex items-center p-4 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <p class="mb-2">{{__('Service Name')}}</p>
                            <select name="service_id" class="input min-w-full border flex-1" aria-required="" required>
                                <option value="">--</option>
                                @foreach ($service as $serviceItem)
                                    <option value="{{$serviceItem->id}}" @if (old('service_id') == $serviceItem->id) selected @endif>{{$serviceItem->service_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="">
                                <p class="mb-2">{{__('Title')}}</p>
                                <input type="text" id="title" name="title" value="{{old('title')}}" class="input w-full border flex-1" aria-required="" required>
                            </div>
                            <div class="">
                                <p class="mb-2">{{__('Description')}}</p>
                                <input type="text" id="description" name="description" value="{{old('description')}}" class="input w-full border flex-1" aria-required="" required>
                            </div>
                            <div class="my-2 col-span-4">
                                <textarea class="ckeditor" name="body" id="body">{{old('body')}}</textarea aria-required="" required>
                            </div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-right">
                            <button class="button bg-theme-1 text-white w-full sm:w-1/2 lg:w-auto mt-2 px-4">{{__('Create')}}</button>
                        </div>
                    </div>
                </div>
            </form>
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
        });

    </script>
@endsection
