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

            <form action="{{route('toManager.serviceVariation.store')}}" method="post">
                @csrf
                @method('POST')
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
                                <select name="service_id" class="input min-w-full border flex-1" aria-required="" required>
                                    <option value="">--</option>
                                    @foreach ($service as $serviceItem)
                                        <option value="{{$serviceItem->id}}" @if (old('service_id') == $serviceItem->id) selected @endif>{{$serviceItem->service_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <p class="mb-2">{{__('variation_name')}}</p>
                                <input type="text" id="variation_name" name="variation_name" value="{{old('variation_name')}}" class="input w-full border flex-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-2 mt-2">
                            <div class="intro-y col-span-12 text-right">
                                <button class="button bg-theme-1 text-white w-full sm:w-1/2 lg:w-auto mt-2">{{__('Create')}}</button>
                            </div>
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

        $(document).ready( function ()
        {
        });

    </script>
@endsection
