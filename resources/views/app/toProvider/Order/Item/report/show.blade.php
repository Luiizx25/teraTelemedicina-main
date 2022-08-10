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
        <span class="text-base">{{ $report->OrderItem->item_num }}</span>
    </div>
    <!-- -->
    <div class="intro-y box text-lg font-medium p-3 w-full shadow-md rounded-md border">
        <!-- -->
        <div class="flex items-center">
            <h2 class="text-2xl font-medium mr-auto">
                {{ $report->OrderItem->service->service_name}}
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
                                <p class="font-medium">{{ $report->OrderItem->item_start_datetime?$report->OrderItem->item_start_datetime->format('d/m/Y H:i'):'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Conclusion')}}</p>
                                <p class="font-medium">{{ $report->OrderItem->item_end_datetime?$report->OrderItem->item_end_datetime->format('d/m/Y H:i'):'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Tempo do atendimento')}}</p>
                                <p class="font-medium">{{ $report->OrderItem->item_end_datetime?$report->OrderItem->item_start_datetime->shortAbsoluteDiffForHumans($report->OrderItem->item_end_datetime):'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Status')}}</p>
                                <p class="font-medium">
                                    {{ $report->OrderItem->status->ref_description }}
                                </p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                <p class="text-gray-600 text-xs">{{__('Patient code')}}</p>
                                <p class="font-medium capitalize">{{ strtolower($report->OrderItem->order->patient_id) }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                <p class="text-gray-600 text-xs">{{__('Attachment(s)')}}</p>
                                <p class="font-medium">{{ $report->OrderItem->files?$report->OrderItem->files->count():'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-8">
                                <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                                <p class="font-medium">{{ $report->OrderItem->item_comments??'--' }}</p>
                            </div>

                        </div>
                        <!-- -->
                    </div>
                </div>
                <!-- -->
            </div>
        </div>

        {{-- {{ dd($report->OrderItem->order->toArray()) }} --}}
        <div class="grid grid-cols-12 gap-2 flex rounded-sm text-sm mt-2">

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Genre')}}</p>
                <p class="font-medium">{{ $report->OrderItem->order->pat_genre }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Age')}}
                <p class="font-medium">{{ $report->OrderItem->order->pat_date_birth->age }} {{__('years')}}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Weight')}}</p>
                <p class="font-medium">{{ $report->OrderItem->order->pat_weight }} Kg</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-2">
                <p class="text-gray-600 text-xs">{{__('Height')}}</p>
                <p class="font-medium">{{ $report->OrderItem->order->pat_height }} m</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                <p class="font-medium">{{ $report->OrderItem->item_comments??'--' }}</p>
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
                    @forelse ($report->OrderItem->files as $file)
                        <!-- -->
                        <div class="intro-y col-span-3 sm:col-span-3 md:col-span-3 lg:col-span-1 xxl:col-span-1">
                            <div class="box rounded-md px-2 py-2 px-2 sm:px-2 relative zoom-in border shadow text-center">
                                <a href="javascript:openWindow('{{ route('toProvider.app.showFile',['orderNum'=>$report->OrderItem->order->order_num,'orderItem'=>$report->OrderItem->item_num,'fileId'=>$file->id]) }}')" class="w-3/5 file__icon file__icon--file mx-auto" title="{{__('Open File')}}">
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
                <p class="font-medium">{{ $report->report_results_comments??'--' }}</p>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="intro-y mt-4 p-6 bg-white rounded shadow">
        <div>
            {!!html_entity_decode($report->report_results)!!}
        </div>
    </div>
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
