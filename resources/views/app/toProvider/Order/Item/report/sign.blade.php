@extends('_layout.side-menu',[
    'title' => __('Answer'),
    'titlePage' => __('Signing'),
    'useCkeditor' => true,
    'useJquery' => true,
    'useToastr' => false,
    'useDataTable' => false,
    'fullPage' => false,
])

@section('subcontent')
    <!-- -->
    <div class="intro-y p-2">
        <span class="text-base">{{ $orderItem->item_num }}</span>
    </div>
    <!-- -->
    <div class="box text-lg font-medium p-3 w-full shadow-md rounded-md border">
        <!-- -->
        <div class="intro-y flex items-center">
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
                            <a href="javascript:;" data-toggle="modal" data-target="#modal-cancel-report" class="items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-100 dark:hover:bg-dark-2 rounded-md">
                                {{__('Reopen report')}}
                            </a>
                            <!-- -->
                            <div class="modal" id="modal-cancel-report">
                                <div class="modal__content">
                                    <div class="p-5 text-center">
                                        <i data-feather="activity" class="w-16 h-16 text-orange-500 mx-auto mt-3"></i>
                                        <div class="text-2xl mt-5">{{__('Confirm reopen')}}</div>
                                    </div>
                                    <form action="{{ route('toProvider.orderItem.report.reopen', ['orderItemNum'=>$orderItemNum]) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <div class="px-16 pb-8 text-center flex">
                                            <button type="button" data-dismiss="modal" class="m-2 button w-full border text-gray-700 dark:border-dark-5 dark:text-gray-300">{{__('Cancel')}}</button>
                                            <button type="submit" class="m-2 button w-full bg-orange-600 text-white">{{__('Reopen')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- {{ dd($orderItem->order->toArray()) }} --}}
        <div class="grid grid-cols-12 gap-2 flex rounded-sm text-sm mt-2">

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Genre')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_genre }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Age')}}
                <p class="font-medium">{{ $orderItem->order->pat_date_birth->age }} {{__('years')}}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Weight')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_weight }} Kg</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Height')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_height }} m</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
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
            <!-- /ANEXOS -->
            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12">
                <p class="text-gray-600 text-xs">{{__('Report Comments')}}
                    <span class="text-xs text-red-800 font-light">{{__('Only seen internally')}}</span></p>
                <p class="font-medium">{{ $orderItem->ConclusionReport->report_results_comments??'--' }}</p>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="mt-4 p-6 bg-white rounded shadow">
        <div class="font-semibold uppercase">Anexos do médico</div>
        @if ($orderItem->ConclusionReportFiles->count())
            <div class="w-full bg-gray-200 rounded my-2 p-2">
                @foreach ($orderItem->ConclusionReportFiles as $reportFile)
                    {{-- <div class="w-full flex gap-2">
                        @dump($reportFile->toArray())
                    </div>
                    <hr> --}}
                    <div class="intro-y">
                        <div class="flex justify-between gap-3 box rounded-md py-2 px-2 sm:px-2 relative border shadow text-center">
                            <div class="flex w-full gap-2">
                                <div class="w-2/12 bg-teal-600 text-white rounded shadow-md px-2 relative zoom-in ">
                                    <a href="javascript:openWindow('{{ route('toProvider.app.showFileMedico',['orderNum'=>$orderItem->order->order_num,'orderItem'=>$orderItem->item_num,'fileId'=>$reportFile->id]) }}')" class="flex pt-1" title="{{__('Open File')}}">
                                        <span class="inline-block align-middle text-lg m-0 p-0">{{ strtoupper($reportFile->file_type??'ND') }}</span> <i data-feather="external-link" class="w-5 h-5 pt-1 mr-1"></i>
                                    </a>
                                </div>
                                <div class="w-10/12 text-xs text-left truncate">
                                    <div class="bg-gray-100 rounded shadow px-1 w-full font-medium truncate" >{{ $reportFile->file_description??'---' }}</div>
                                    <div class="px-1 truncate" title="{{ $reportFile->file_description??'---' }}">{{ $reportFile->file_comments??'---' }}</div>
                                </div>
                            </div>
                            <div class="w-auto text-red-600 px-1">
                                <form action="{{ route('toProvider.orderItem.report.conclusion.fileRemove',['orderItemNum' => $orderItem->item_num,'fileId' => $reportFile->id]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="file" value="{{$reportFile->id}}">
                                    <input type="hidden" name="file_type" value="{{$reportFile->file_type}}">
                                    <button type="submit" class="text-xs p-0">REMOVER</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="mt-2">
            <form action="{{ route('toProvider.orderItem.report.conclusion.fileUpload',['orderItemNum' => $orderItem->item_num])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-full flex gap-2">
                    <input id="file" name="file" value="{{ old('file') }}" type="file" class="input w-1/2 border py-1">
                    <input id="file_comments" name="file_comments" value="{{ old('file_comments') }}" type="text" class="input w-1/2 border py-1" placeholder="Comentário do arquivo">
                    <button type="submit" class="px-2 rounded border bg-green-700 hover:bg-green-900 text-white font-semibold"><i data-feather="file-plus" class="w-5 h-5"></i></button>
                </div>
            </form>
        </div>
        {{--
        {{ dd(
            $orderItem->order->toArray(),
            $orderItem->toArray(),
            $orderItem->ConclusionReportFiles->toArray(),
            $orderItem->ConclusionReport->toArray(),
            $orderItem->reports->toArray(),
            $orderItem->ConclusionReport->toArray(),
        ) }} --}}

    </div>
    <!-- -->
    <div class="mt-4 p-6 bg-white rounded shadow">
        <div>
            {!!html_entity_decode($orderItem->ConclusionReport->report_results)!!}
        </div>
        <div class="mt-2 pt-4 border-t-2 text-right">
            <div>
                <a href="javascript:;" data-toggle="modal" data-target="#modal-sign-report" class="items-center mt-2 py-2 px-4 transition duration-300 text-white bg-theme-1 hover:text-white hover:bg-green-400 rounded-md">
                    {{__('Sign')}}
                </a>
                <!-- -->
                <div class="modal" id="modal-sign-report">
                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="check-circle" class="w-16 h-16 text-green-500 mx-auto mt-3"></i>
                            <div class="text-2xl mt-5">{{__('Confirm document signature')}}</div>
                            <div class="text-xs text-red-800 mt-2">{{__('This action cannot be undone')}}</div>
                        </div>
                        <form action="{{ route('toProvider.orderItem.report.sign', ['orderItemNum'=>$orderItemNum]) }}" method="post">
                            @csrf
                            @method('POST')
                            @if($providerSlug)
                            <input type="hidden" name="providerSlug" value="{{$providerSlug}}" />
                            @endif
                            <!--  -->
                            <div class="px-16 pb-8 text-center flex">
                                <button type="button" data-dismiss="modal" class="m-2 button w-full border text-gray-700 dark:border-dark-5 dark:text-gray-300">{{__('Cancel')}}</button>
                                <button type="submit" class="m-2 button w-full bg-green-600 text-white">{{__('Confirm')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- -->
        </div>
    </div>

    {{-- <div class="book">
        <div class="page">
            <div class="">{!!html_entity_decode($orderItem->ConclusionReport->report_results)!!}</div>
        </div>
    </div> --}}

@endsection

@section('script')
    <script>
        $(document).ready( function ()
        {
            //divShowHide('div-anexos','show');
            //window.print();
        });
    </script>
@endsection
