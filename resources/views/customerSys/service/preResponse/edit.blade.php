@extends('_layout.side-menu',[
    'title' => __('Services'),
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
            <h2 class="text-2xl font-medium mt-2 truncate">{{__('Edit Pre Response')}}</h2>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12">

            <form action="{{route('toManager.servicePreResponse.update',['servicePreResponse'=>$PreResponse->slug])}}" method="post">
                @csrf
                @method('PUT')
                <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                    <div class="flex items-center p-4 border-b border-gray-200 dark:border-dark-5">
                        <div class="mr-auto">
                            <h2 class="font-medium text-base mr-auto">
                                <span class="text-lg text-gray-600 font-semibold">{{$PreResponse->service->service_name}}</span>
                            </h2>
                        </div>
                        @if (session('status_error'))
                            <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="">
                                <p class="mb-2">{{__('Title')}}</p>
                                <input type="text" id="title" name="title" value="{{old('title',$PreResponse->title)}}" class="input w-full border flex-1">
                            </div>
                            <div class="">
                                <p class="mb-2">{{__('Description')}}</p>
                                <input type="text" id="description" name="description" value="{{old('description',$PreResponse->description)}}" class="input w-full border flex-1">
                            </div>
                            <div class="my-2 col-span-2">
                                <textarea class="ckeditor" name="body" id="body">{{old('body',$PreResponse->body)}}</textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-left">
                                <a href="javascript:;" data-toggle="modal" data-target="#delete-modal" class="button inline-block bg-theme-6 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Delete')}}</a>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-6 text-right">
                                <button class="button bg-theme-1 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Change')}}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- -->
            <div class="modal" id="delete-modal">
                <div class="modal__content">
                    <form action="{{route('toManager.servicePreResponse.destroy',['servicePreResponse'=>$PreResponse->slug])}}" method="post">
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
