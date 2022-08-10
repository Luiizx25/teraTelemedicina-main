@extends('_layout.side-menu',[
    'title' => __('Answer'),
    'useCkeditor' => true,
    'useJquery' => true,
    'useToastr' => false,
    'useDataTable' => false,
    'fullPage' => true,
])

@section('subcontent')
    <!-- -->
    <div class="intro-y p-2">
        <span class="text-base" title="Item: {{ $orderItem->id??'--' }} Report: {{ $orderItem->ConclusionReport->id??'--' }}">{{ $orderItem->item_num }}</span>
    </div>
    <!-- -->
    <div class="box text-lg font-medium px-3 w-full shadow-md rounded-md border">
        <!-- -->
        <div class="intro-y flex items-center m-2">
            <h2 class="text-2xl font-medium mr-auto">{{ $orderItem->service->service_name}}</h2>
            <div class="p-1">
                <!-- -->
                <a href="javascript:;" onclick="divShowHide('div-anexos','show')" class="hover:text-orange-600" title="{{__('Attachments')}}">
                    <i data-feather="paperclip" class="w-5 h-5"></i>
                </a>
                <!-- -->
            </div>
            <div class="p-1">
                <!-- -->
                <a href="javascript:;" onclick="divShowHide('div-preformattedResponses','show')" class="hover:text-orange-600" title="{{__('Preformatted responses')}}">
                    <i data-feather="cast" class="w-5 h-5"></i>
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

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                <p class="text-gray-600 text-xs">{{__('Patient code')}}</p>
                                <p class="font-medium capitalize">{{ strtolower($orderItem->order->patient_id) }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-1">
                                <p class="text-gray-600 text-xs">{{__('Attachment(s)')}}</p>
                                <p class="font-medium">{{ $orderItem->files?$orderItem->files->count():'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-9">
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
                    <div class="dropdown-box w-56" data-popper-placement="top-end" style="position: absolute; top: auto; right: auto; bottom: 0px; left: 0px; transform: translate(-124px, -37px);" data-popper-reference-hidden="" data-popper-escaped="">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                            {{--  --}}
                            <a href="#" data-toggle="modal" data-target="#modal-cancel-report" class="flex my-1 p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 bg-gray-100 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="x-circle" class="w-5 h-5 text-red-700 pt-1 mr-1"></i> {{__('Cancel Report')}}
                            </a>
                            <!-- -->
                            <div class="modal" id="modal-cancel-report">
                                <div class="modal__content">
                                    <div class="p-5 text-center">
                                        <i data-feather="x-circle" class="w-16 h-16 text-red-700 mx-auto mt-3"></i>
                                        <div class="text-2xl mt-5">{{__('Confirm cancellation')}}</div>
                                    </div>
                                    <div class="px-16 pb-8 text-center flex">
                                        <a href="{{ route('toProvider.orderItem.report.cancel',['orderItemNum'=>$orderItem->item_num]) }}" type="submit" onclick="submitReport('form-complete-report')" class="m-2 button w-full bg-red-600 text-white">{{__('Cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <a href="#" data-toggle="modal" data-target="#modal-return-report" class="flex my-1 p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 bg-gray-100 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="rewind" class="w-5 h-5 text-blue-700 pt-1 mr-1"></i> {{__('Return Report')}}
                            </a>
                            <!-- -->
                            <div class="modal" id="modal-return-report">
                                <div class="modal__content">
                                    <form action="{{ route('toProvider.orderItem.report.return',['orderItemNum'=>$orderItem->item_num]) }}" method="post">
                                        @csrf
                                        <div class="p-4 text-center">
                                            <i data-feather="rewind" class="w-16 h-16 text-blue-700 mx-auto"></i>
                                            <div class="text-2xl mt-2">{{__('Confirm Return')}}</div>
                                        </div>
                                        <div class="p-4">
                                            <div class="text-gray-600 mb-1">
                                                {{__('Type reason')}}
                                            </div>
                                            <div>
                                                <input type="text" name="reasonReturn" id="reasonReturn" value="{{old('reasonReturn')}}" placeholder="{{__('Reason')}}" class="input w-full border" aria-required="" required>
                                            </div>
                                        </div>
                                        <div class="p-4 text-center flex">
                                            <button type="submit" class="m-1 button w-full bg-red-600 text-white">{{ __('Return') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{--  --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{ dd($orderItem->order->toArray()) }} --}}
        <div class="grid grid-cols-12 gap-2 flex mx-2 rounded-sm text-sm">

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Genre')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_genre }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Age')}}
                <p class="font-medium">{{ $orderItem->order->pat_date_birth->age }} {{__('years')}}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Weight')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_weight }} Kg</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Height')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_height }} m</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-8">
                <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                <p class="font-medium">{{ $orderItem->item_comments??'--' }}</p>
            </div>
            <!-- ANEXOS -->
            <div id="div-anexos" class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12 hidden">
                <p class="text-gray-600 text-xs">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <div class="text-left text-gray-600 text-xs">
                            {{__('Attachments')}}
                        </div>
                        <div class="text-right">
                            <a href="javascript:;" onclick="divShowHide('div-anexos','hide')" class="text-orange-600 hover:text-gray-600 m-2" title="{{__('Attachments')}}">
                                {{__('Close')}}
                            </a>
                        </div>
                    </div>
                </p>
                <p class="font-medium">
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 mb-2">
                    @forelse ($orderItem->files as $file)
                        <!-- -->
                        <div class="intro-y col-span-3 sm:col-span-3 md:col-span-3 lg:col-span-1 xxl:col-span-1">
                            <div class="box rounded-md px-2 py-2 px-2 sm:px-2 relative zoom-in border shadow text-center">
                                <a href="javascript:openWindow('{{ route('toProvider.app.showFile',['orderNum'=>$orderItem->order->order_num,'orderItem'=>$orderItem->item_num,'fileId'=>$file->id]) }}')" class="w-3/5 file__icon file__icon--file mx-auto" title="{{__('Open File')}}">
                                    <div class=" bg-teal-600 text-lg text-white rounded shadow-md">{{ strtoupper($file->file_type??'ND') }}</div>
                                </a>
                                <span class="block text-xs mt-1 text-center truncate">{{ $file->file_name??'---' }}</span>
                                <div class="text-gray-600 text-xs text-center">{{ number_format(($file->file_size??'0')/1024, 2, ',', '.') }} KB</div>
                                <a href="#" class="block bg-gray-100 rounded-md shadow px-2 py-1 w-full font-medium mt-2 text-sm text-center truncate" title="{{ $file->file_description??'---' }}">{{ $file->file_description??'---' }}</a>
                            </div>
                        </div>
                        <!-- -->
                    @empty
                        <div class="col-span-6">{{__('No Attachments')}}</div>
                    @endforelse
                    </div>
                </p>
            </div>
            <!-- PRE-RESPOSTAS -->
            <div id="div-preformattedResponses" class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12 hidden">
                <p class="text-gray-600 text-xs">
                    <div class="grid grid-cols-1 lg:grid-cols-2 mb-1">
                        <div class="text-left text-gray-600 text-xs">
                            {{__('Preformatted responses')}}
                        </div>
                        <div class="text-right">
                            <a href="javascript:;" onclick="divShowHide('div-preformattedResponses','hide')" class="text-orange-600 hover:text-gray-600 m-2" title="{{__('Attachments')}}">
                                {{__('Close')}}
                            </a>
                        </div>
                    </div>
                </p>
                <p class="font-medium">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-2">
                    @forelse ($orderItem->service->preResponse as $preResponse)
                        <input type="hidden" id="preResponse{{$preResponse->id}}" value="{{$preResponse->body}}</p>">
                        <div class="bg-white rounded-md shadow hover:shadow-lg text-center p-2 items-center align-middle">
                            <a href="javascript:;" onclick="preResponseApply('preResponse{{$preResponse->id}}')" class="text-orange-600 hover:text-gray-600" title="{{__('To apply')}}">
                                <p class="m-0 p-0 capitalize">{{$preResponse->title??'--'}}</p>
                                <p class="m-0 p-0 text-xs text-gray-700 capitalize">{{$preResponse->description??'--'}}</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-6">--</div>
                    @endforelse
                    </div>
                </p>
            </div>
        </div>
        <!-- -->
        <form id="form-complete-report" action="{{ route('toProvider.orderItem.report.conclusion',['orderItemNum'=>$orderItem->item_num])}}" method="post">
            @csrf
            @method('POST')
            @if($providerSlug)
            <input type="hidden" name="providerSlug" value="{{$providerSlug}}" />
            @endif
            <!--  -->
            <div class="grid grid-cols-1 gap-2 my-4 mx-2 rounded-sm text-sm">
                <div>
                    @php
                        $reportResult = $orderItem->ConclusionReport->report_results?$orderItem->ConclusionReport->report_results:false;
                        if($reportResult)
                            $setData = false;
                        else
                            $setData = true;
                    @endphp
                    <textarea class="ckeditor" name="order_item_report" id="order_item_report" rows="80">{{old('order_item_report',$reportResult)}}</textarea>
                </div>
                <div>
                    <p class="text-gray-600 py-1">
                        {{__('Report Comments')}}
                        <span class="text-xs text-red-800 font-light">{{__('Only seen internally')}}</span>
                    </p>
                    <input type="text" name="report_results_comments" id="report_results_comments" value="{{old('report_results_comments',$orderItem->ConclusionReport->report_results_comments)}}" placeholder="{{__('Comments')}}" class="input w-full border">
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
        function preResponseApply(formId)
        {
            CKEDITOR.instances['order_item_report'].insertHtml(document.getElementById(formId).value);
        }

        $(document).ready( function ()
        {
            divShowHide('div-anexos','show');

            //divShowHide('div-preformattedResponses','show');

            //cash('#pat_doc_type').val(docType);

            // CKEDITOR.replace('order_item_report', {
            //     height: 500,
            // });

            if("{{$setData??false}}")
                CKEDITOR.instances['order_item_report'].setData("{{old('order_item_report')}}");
        });
    </script>
@endsection
