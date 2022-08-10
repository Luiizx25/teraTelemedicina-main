@extends('_layout.side-menu',[
    'title' => __('Answer'),
    'ckeditor' => true,
    'useJquery' => true,
    'useToastr' => false,
    'useDataTable' => false,
    'fullPage' => true,
])

@section('subcontent')
    <!-- -->
    <div class="intro-y p-2">
        <span class="text-base">{{ $orderItem->item_num }}</span>
    </div>
    <!-- -->
    <div class="box text-lg font-medium px-3 w-full shadow-md rounded-md border">
        <!-- -->
        <div class="intro-y flex items-center m-2">
            <h2 class="text-2xl font-medium mr-auto">
                {{ $orderItem->service->service_name}}
            </h2>
            <div class="p-1">
                <!-- -->
                <a href="javascript:;" onclick="divShowHide('div-anexos','show')" class="hover:text-orange-600" title="{{__('Attachments')}}">
                    <i data-feather="paperclip" class="w-5 h-5"></i>
                </a>
                <!-- -->
            </div>
            <!-- -->
            <div class="p-1">
                <!-- -->
                <a href="javascript:;" class="hover:text-orange-600" data-toggle="modal" data-target="#large-modal-size-preview" title="{{__('More info')}}">
                    <i data-feather="info" class="w-5 h-5"></i>
                </a>
                <div class="modal" id="large-modal-size-preview">
                    <div class="modal__content modal__content--xl p-4 text-center z-50">
                        <!-- -->
                        <div class="grid grid-cols-12 gap-2 flex m-2 rounded-sm text-sm">

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Start of service')}}</p>
                                <p class="font-medium">{{ $orderItem->item_start_datetime?$orderItem->item_start_datetime->format('d/m/Y H:i'):'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('End forecast')}}</p>
                                @php
                                    $EndForecast = $orderItem->item_start_datetime?$orderItem->item_start_datetime->addSeconds(strtotime('1970-01-01 '.$service->service_negotiated_time_estimated.'UTC'))->format('d/m/Y H:i'):false;
                                    if($now->format('Y-m-d') > $EndForecast) $EndForecastText = 'font-bold text-red-700';
                                @endphp
                                <p class="font-medium @if($EndForecastText??false) {{$EndForecastText}} @endif">
                                    {{ $EndForecast?$EndForecast:'--' }} ({{ $service->service_negotiated_time_estimated?$service->service_negotiated_time_estimated:'--' }})
                                </p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Conclusion')}}</p>
                                <p class="font-medium">{{ $orderItem->item_end_datetime?$orderItem->item_end_datetime->format('d/m/Y H:i'):'--' }} ({{ $orderItem->item_end_datetime?$orderItem->item_start_datetime->shortAbsoluteDiffForHumans($orderItem->item_end_datetime):'--' }})</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Status')}}</p>
                                <p class="font-medium">
                                    {{ $orderItem->status->ref_description }}
                                </p>
                            </div>


                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Patient')}}</p>
                                <p class="font-medium capitalize">{{ strtolower($orderItem->order->pat_name) }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Birth')}}/{{__('Age')}}</p>
                                <p class="font-medium">{{ $orderItem->order->pat_date_birth->format('d/m/Y') }} - {{ $orderItem->order->pat_date_birth->age }} anos</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Genre')}}</p>
                                <p class="font-medium">{{ $orderItem->order->pat_genre }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Attachment(s)')}}</p>
                                <p class="font-medium">{{ $orderItem->files?$orderItem->files->count():'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12">
                                <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                                <p class="font-medium">{{ $orderItem->item_comments??'--' }}</p>
                            </div>

                        </div>
                        <!-- -->
                    </div>
                </div>
                <!-- -->
            </div>
            <div class="p-1">
                <div class="dropdown">
                    <button class="dropdown-toggle button px-0 hover:text-orange-600" title="{{__('Menu')}}">
                        <i data-feather="align-justify" class="w-5 h-5"></i>
                    </button>
                    <div class="dropdown-box w-56" id="_18hgyyal8" data-popper-placement="top-end" style="position: absolute; top: auto; right: auto; bottom: 0px; left: 0px; transform: translate(-124px, -37px);" data-popper-reference-hidden="" data-popper-escaped="">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                Cancelar Atendimento
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-2 flex m-2 rounded-sm text-sm">

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                <p class="text-gray-600 text-xs">{{__('Status')}}</p>
                <p class="font-medium">{{ $orderItem->status->ref_description }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                <p class="text-gray-600 text-xs">{{__('Patient')}}</p>
                <p class="font-medium capitalize">{{ strtolower($orderItem->order->pat_name) }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                <p class="text-gray-600 text-xs">{{__('Birth')}}
                    <p class="font-medium">{{ $orderItem->order->pat_date_birth->format('d/m/Y') }} - {{ $orderItem->order->pat_date_birth->age }} {{__('years')}}</p>
                </div>

                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                    <p class="text-gray-600 text-xs">{{__('Genre')}}</p>
                    <p class="font-medium">{{ $orderItem->order->pat_genre }}</p>
                </div>

                <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12">
                    <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                    <p class="font-medium">{{ $orderItem->item_comments??'--' }}</p>
                </div>

                <div id="div-anexos" class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12">
                    <p class="text-gray-600 text-xs">
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div class="text-left">
                                {{__('Attachments')}}
                            </div>
                            <div class="text-right">
                                <a href="javascript:;" onclick="divShowHide('div-anexos',250)" class="text-orange-600 hover:text-gray-600 m-2" title="{{__('Attachments')}}">
                                    {{__('Close')}}
                                </a>
                            </div>
                        </div>
                    </p>
                    <p class="font-medium float-none">
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 m-2 flex">
                        @forelse ($orderItem->files as $file)
                            <!-- -->
                            <div class="intro-y col-span-6 sm:col-span-4 md:col-span-2 lg:col-span-1 xxl:col-span-1">
                                <div class="file box rounded-md px-2 pt-8 pb-5 px-3 sm:px-5 relative zoom-in border shadow">
                                    <a href="javascript:openWindow('{{ route('toProvider.app.showFile',['orderNum'=>$orderItem->order->order_num,'orderItem'=>$orderItem->item_num,'fileId'=>$file->id]) }}')" class="w-3/5 file__icon file__icon--file mx-auto">
                                        <div class="file__icon__file-name">{{ strtoupper($file->file_type??'ND') }}</div>
                                    </a>
                                    <span class="block text-xs mt-1 text-center truncate">{{ $file->file_name??'---' }}</span>
                                    <div class="text-gray-600 text-xs text-center">{{ number_format(($file->file_size??'0')/1024, 2, ',', '.') }} KB</div>
                                    <a href="#" class="block bg-gray-100 rounded-md shadow px-2 py-1 w-full font-medium mt-2 text-center truncate" title="{{ $file->file_description??'---' }}">{{ $file->file_description??'---' }}</a>
                                </div>
                            </div>
                            <!-- -->
                        @empty
                            <div class="col-span-6">{{__('No Attachments')}}</div>
                        @endforelse
                        </div>
                    </p>
                </div>
            </div>

            <form id="form-complete-report" action="{{ route('toProvider.orderItem.report.store',['orderItemNum'=>$orderItem->item_num]) }}" method="post">
                @csrf
                @method('POST')
                <!-- -->
                <div class="grid grid-cols-1 gap-2 flex m-2 rounded-sm text-sm">
                    <div>
                        {{-- <textarea class="ckeditor" name="order_item_report" id="order_item_report">aabbcc</textarea> --}}
                        <textarea class="ckeditor" name="order_item_report" id="order_item_report">{{old('order_item_report')}}</textarea>
                    </div>
                    <div class="text-right my-4">
                        <a href="javascript:;" data-toggle="modal" data-target="#success-modal-preview-complete-report" class="button w-24 bg-theme-1 text-white">
                            {{__('Complete Report')}}
                        </a>
                    </div>
                    <!-- -->
                    <div class="modal" id="success-modal-preview-complete-report">
                        <div class="modal__content">
                            <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                                <div class="text-2xl mt-5">{{__('Confirm finish')}}</div>
                            </div>
                            <div class="px-16 pb-8 text-center flex">
                                <button type="button" data-dismiss="modal" class="m-2 button w-full border text-gray-700 dark:border-dark-5 dark:text-gray-300">{{__('Cancel')}}</button>
                                <button type="submit" onclick="submitReport('form-complete-report')" class="m-2 button w-full bg-green-600 text-white">{{__('Conclude')}}</button>
                            </div>
                        </div>
                    </div>
                    <!-- -->
                </div>
            </form>
        <!-- -->
    </div>
    <!-- -->
@endsection

@section('script')
    <script>

        function submitReport(formId)
        {
            var orderItemReport = document.getElementById("order_item_report").value;

            // alert(orderItemReport);

            // alert(cash('#order_item_report').val());

            // alert(cash('#myTextarea').val());

            document.getElementById(formId).submit();
        }

        $(document).ready( function () {
            divShowHide('div-anexos',1);
        });
    </script>
@endsection
