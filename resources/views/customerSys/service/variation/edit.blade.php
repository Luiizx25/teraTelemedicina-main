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
    <div class="grid grid-cols-12 gap-2 mt-2">

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12">

            <form action="{{route('toManager.serviceVariation.update',['serviceVariation'=>$Variation->slug])}}" method="post">
                @csrf
                @method('PUT')
                <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                    <div class="flex items-center p-4">
                        <h2 class="text-2xl font-medium truncate">{{__('Edit Variation Service')}}</h2>
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
                                <p class="mb-2">{{__('Service')}}</p>
                                <input  value="{{$Variation->service->service_name}}" class="input w-full border flex-1 bg-gray-200 font-semibold" readonly>
                            </div>
                            <div class="">
                                <p class="mb-2">{{__('variation_name')}}</p>
                                <input type="text" id="variation_name" name="variation_name" value="{{old('variation_name',$Variation->variation_name)}}" class="input w-full border flex-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-2 mt-2">
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
                    <form action="{{route('toManager.serviceVariation.destroy',['serviceVariation'=>$Variation->slug])}}" method="post">
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

        $(document).ready( function ()
        {
        });

    </script>
@endsection
