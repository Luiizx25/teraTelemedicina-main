@extends('_layout.side-menu',[
    'title' => __('Answer RX OIT'),
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
    <div class="box text-lg font-medium px-3 w-full shadow rounded-md border">
        <!-- -->
        <div class="intro-y flex items-center m-2">
            <h2 class="text-2xl font-medium mr-auto">RAIO X OIT</h2>
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

                            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Start of service')}}</p>
                                <p class="font-medium">{{ $orderItem->item_start_datetime?$orderItem->item_start_datetime->format('d/m/Y H:i'):'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('End forecast')}}</p>
                                @php
                                    $EndForecast = $orderItem->item_start_datetime?$orderItem->item_start_datetime->addSeconds(strtotime('1970-01-01 '.$service->service_negotiated_time_estimated.'UTC'))->format('d/m/Y H:i'):false;
                                    if($now->format('Y-m-d') > $EndForecast) $EndForecastText = 'font-bold text-red-700';
                                @endphp
                                <p class="font-medium @if($EndForecastText??false) {{$EndForecastText}} @endif">
                                    {{ $EndForecast?$EndForecast:'--' }} ({{ $service->service_negotiated_time_estimated?$service->service_negotiated_time_estimated:'--' }})
                                </p>
                            </div>

                            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Conclusion')}}</p>
                                <p class="font-medium">{{ $orderItem->item_end_datetime?$orderItem->item_end_datetime->format('d/m/Y H:i'):'--' }} ({{ $orderItem->item_end_datetime?$orderItem->item_start_datetime->shortAbsoluteDiffForHumans($orderItem->item_end_datetime):'--' }})</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-3">
                                <p class="text-gray-600 text-xs">{{__('Status')}}</p>
                                <p class="font-medium">
                                    {{ $orderItem->status->ref_description }}
                                </p>
                            </div>

                            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                                <p class="text-gray-600 text-xs">{{__('Patient code')}}</p>
                                <p class="font-medium capitalize">{{ strtolower($orderItem->order->patient_id) }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-1">
                                <p class="text-gray-600 text-xs">{{__('Attachment(s)')}}</p>
                                <p class="font-medium">{{ $orderItem->files?$orderItem->files->count():'--' }}</p>
                            </div>

                            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-9">
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
        <div class="grid grid-cols-12 gap-1 flex mx-2 rounded-sm text-sm">

            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Genre')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_genre }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Age')}}
                <p class="font-medium">{{ $orderItem->order->pat_date_birth->age }} {{__('years')}}</p>
            </div>

            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Weight')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_weight }} Kg</p>
            </div>

            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-6 sm:col-span-4 lg:col-span-1">
                <p class="text-gray-600 text-xs">{{__('Height')}}</p>
                <p class="font-medium">{{ $orderItem->order->pat_height }} m</p>
            </div>

            <div class="bg-gray-100 rounded-sm border border-gray-300 shadow px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-8">
                <p class="text-gray-600 text-xs">{{__('Item Comments')}}</p>
                <p class="font-medium">{{ $orderItem->item_comments??'--' }}</p>
            </div>

            <!-- ANEXOS -->
            <div id="div-anexos" class="bg-gray-100 border border-gray-300 shadow rounded-sm mt-3 px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-12 hidden">
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
                                    <div class=" bg-teal-600 text-lg text-white rounded shadow">{{ strtoupper($file->file_type??'ND') }}</div>
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

        <!-- STYLE -->
        <style>
            table {
                border: 2px solid #a3a3a3;
                background-color: #f4f4f4;
            }
            td {
                border: 2px solid #a3a3a3;
                background-color: #f4f4f4;
            }
            td input {
                border: 1px solid #a3a3a3;
                background-color: #fff;
            }
        </style>
        <!-- -->
        @php
            // PROCESSA SERIAL
            $reportResults = unserialize($orderItem->conclusionReport->report_results);
        @endphp
        <!-- -->
        <form id="form_complete_report_oit" action="{{ route('toProvider.orderItem.report.conclusion',['orderItemNum'=>$orderItem->item_num])}}" method="post">
            @csrf
            @method('POST')

            @if($providerSlug)
                <input type="hidden" name="providerSlug" value="{{$providerSlug}}" />
            @endif


            <div class="grid grid-cols-12 gap-2 mt-3 mx-2 pt-3 border-t">

                <div class="col-span-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">{{__('leitor')}}</p>
                    <input type="text" value="{{ $orderItem->ConclusionProvider->user->name }}" class="input w-full border flex-1 mt-1" readonly disabled />
                </div>

                <div class="col-span-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">{{__('rx_digital')}}</p>
                    <select id="order_item_report[rx_digital]" name="order_item_report[rx_digital]" class="input w-40 border flex-1 mt-1" aria-required="" required>
                        <option value=""> -- </option>
                        @foreach (['SIM', 'NÃO'] as $item)
                        <option value="{{$item}}" @if ( $item == old('order_item_report[rx_digital]', $reportResults['rx_digital'] ?? false ) ) selected @endif>{{$item}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">{{__('negatoscopio')}}</p>
                    <select id="order_item_report[negatoscopio]" name="order_item_report[negatoscopio]" class="input w-40 border flex-1 mt-1" aria-required="" required>
                        <option value=""> -- </option>
                        @foreach (['SIM', 'NÃO'] as $item)
                        <option value="{{$item}}" @if ( $item == old('order_item_report[negatoscopio]', $reportResults['negatoscopio'] ?? false ) ) selected @endif>{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">

                <div class="col-span-3 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">1A - QUALIDADE TÉCNICA?</p>
                    <select id="order_item_report[1a]" name="order_item_report[1a]" class="input w-40 border flex-1 mt-1" aria-required="" required>
                        <option value=""> -- </option>
                        @foreach (range(1,4) as $item)
                        <option value="{{$item}}" @if ( $item == old('order_item_report[1a]', $reportResults['1a'] ?? false ) ) selected @endif>{{$item}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-5 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">1A - COMENTÁRIO</p>
                    <input id="order_item_report[1a_comentario]" name="order_item_report[1a_comentario]" placeholder="Comentário" value="{{ old('order_item_report[1a_comentario]', $reportResults['1a_comentario'] ?? null) }}" class="input w-full  border mt-1">
                </div>

                <div class="col-span-4 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">1B - RADIOGRAFIA NORMAL?</p>
                    <select id="order_item_report_1b" name="order_item_report[1b]" class="input border w-40 flex-1 mt-1" aria-required="" required>
                    <option value=""> -- </option>
                    @foreach (['SIM', 'NÃO'] as $item)
                    <option value="{{$item}}" @if ( $item == old('order_item_report[1b]', $reportResults['1b'] ?? false ) ) selected @endif>{{$item}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">

                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">2A - ALGUMA ANORMALIDADE PLEURAL CONSISTENTE COM PNEUMOCONIOSE?</p>
                    <select id="order_item_report_2a" name="order_item_report[2a]" class="input w-40 border flex-1 mt-1" aria-required="" required>
                    <option value=""> -- </option>
                    @foreach (['SIM', 'NÃO'] as $item)
                    <option value="{{$item}}" @if ( $item == old('order_item_report[2a]', $reportResults['2a'] ?? false ) ) selected @endif>{{$item}}</option>
                    @endforeach
                    </select>
                </div>

            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">

                <div class="col-span-6 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">2B - PEQUENAS OPACIDADES</p>
                    <div class="mt-2 bg-red-700">
                        <table class="bg-white" style="width: 100%;" cellspacing="0px" cellpadding="0px">
                            <tbody>
                                <tr>
                                    <td class="p-1 text-center text-xs" style="width: 46%;" colspan="4">A) FORMA TAMANHO</td>
                                    <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                    <td class="p-1 text-center text-xs" style="width: 20%;" colspan="2">B) ZONAS</td>
                                    <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                    <td class="p-1 text-center text-xs" style="width: 30%;" colspan="3">C) PROFUSAO</td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center text-xs" style="width: 16%;" colspan="2">Prim&aacute;ria</td>
                                    <td class="p-1 text-center text-xs" style="width: 16%;" colspan="2">Secund&aacute;ria</td>
                                    <td class="p-1 text-center">D</td>
                                    <td class="p-1 text-center">E</td>
                                    <td class="p-1 text-center">0/-</td>
                                    <td class="p-1 text-center">0/0</td>
                                    <td class="p-1 text-center">0/1</td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center">
                                        <p>p</p>
                                        <input type="hidden"   name="order_item_report[2b][ftp][p]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ftp][p]" value="1" class="input border" @if ($reportResults['2b']['ftp']['p'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>s</p>
                                        <input type="hidden"   name="order_item_report[2b][ftp][s]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ftp][s]" value="1" class="input border" @if ($reportResults['2b']['ftp']['s'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>p</p>
                                        <input type="hidden"   name="order_item_report[2b][fts][p]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][fts][p]" value="1" class="input border" @if ($reportResults['2b']['fts']['p'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>s</p>
                                        <input type="hidden"   name="order_item_report[2b][fts][s]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][fts][s]" value="1" class="input border" @if ($reportResults['2b']['fts']['s'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>Superior</p>
                                        <input type="hidden"   name="order_item_report[2b][zd][superior]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][zd][superior]" value="1" class="input border" @if ($reportResults['2b']['zd']['superior'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>Superior</p>
                                        <input type="hidden"   name="order_item_report[2b][ze][superior]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ze][superior]" value="1" class="input border" @if ($reportResults['2b']['ze']['superior'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>1/0</p>
                                        <input type="hidden"   name="order_item_report[2b][p][10]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][10]" value="1" class="input border" @if ($reportResults['2b']['p']['10'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>1/1</p>
                                        <input type="hidden"   name="order_item_report[2b][p][11]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][11]" value="1" class="input border" @if ($reportResults['2b']['p']['11'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>1/2</p>
                                        <input type="hidden"   name="order_item_report[2b][p][12]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][12]" value="1" class="input border" @if ($reportResults['2b']['p']['12'] ?? false) checked @endif>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center">
                                        <p>q</p>
                                        <input type="hidden"   name="order_item_report[2b][ftp][q]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ftp][q]" value="1" class="input border" @if ($reportResults['2b']['ftp']['q'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>t</p>
                                        <input type="hidden"   name="order_item_report[2b][ftp][t]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ftp][t]" value="1" class="input border" @if ($reportResults['2b']['ftp']['t'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>q</p>
                                        <input type="hidden"   name="order_item_report[2b][fts][q]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][fts][q]" value="1" class="input border" @if ($reportResults['2b']['fts']['q'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>t</p>
                                        <input type="hidden"   name="order_item_report[2b][fts][t]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][fts][t]" value="1" class="input border" @if ($reportResults['2b']['fts']['t'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>Médio</p>
                                        <input type="hidden"   name="order_item_report[2b][zd][medio]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][zd][medio]" value="1" class="input border" @if ($reportResults['2b']['zd']['medio'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>Médio</p>
                                        <input type="hidden"   name="order_item_report[2b][ze][medio]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ze][medio]" value="1" class="input border" @if ($reportResults['2b']['ze']['medio'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>2/1</p>
                                        <input type="hidden"   name="order_item_report[2b][p][21]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][21]" value="1" class="input border" @if ($reportResults['2b']['p']['10'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>2/2</p>
                                        <input type="hidden"   name="order_item_report[2b][p][22]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][22]" value="1" class="input border" @if ($reportResults['2b']['p']['10'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>2/3</p>
                                        <input type="hidden"   name="order_item_report[2b][p][23]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][23]" value="1" class="input border" @if ($reportResults['2b']['p']['10'] ?? false) checked @endif>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center">
                                        <p>r</p>
                                        <input type="hidden"   name="order_item_report[2b][ftp][r]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ftp][r]" value="1" class="input border" @if ($reportResults['2b']['ftp']['r'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>u</p>
                                        <input type="hidden"   name="order_item_report[2b][ftp][u]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ftp][u]" value="1" class="input border" @if ($reportResults['2b']['ftp']['u'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>r</p>
                                        <input type="hidden"   name="order_item_report[2b][fts][r]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][fts][r]" value="1" class="input border" @if ($reportResults['2b']['fts']['r'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>u</p>
                                        <input type="hidden"   name="order_item_report[2b][fts][u]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][fts][u]" value="1" class="input border" @if ($reportResults['2b']['fts']['u'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>Inferior</p>
                                        <input type="hidden"   name="order_item_report[2b][zd][inferior]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][zd][inferior]" value="1" class="input border" @if ($reportResults['2b']['zd']['inferior'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>Inferior</p>
                                        <input type="hidden"   name="order_item_report[2b][ze][inferior]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][ze][inferior]" value="1" class="input border" @if ($reportResults['2b']['ze']['inferior'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>3/2</p>
                                        <input type="hidden"   name="order_item_report[2b][p][32]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][32]" value="1" class="input border" @if ($reportResults['2b']['p']['32'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>3/3</p>
                                        <input type="hidden"   name="order_item_report[2b][p][33]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][33]" value="1" class="input border" @if ($reportResults['2b']['p']['33'] ?? false) checked @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <p>3/+</p>
                                        <input type="hidden"   name="order_item_report[2b][p][3]" value="0">
                                        <input type="checkbox" name="order_item_report[2b][p][3]" value="1" class="input border" @if ($reportResults['2b']['p']['3'] ?? false) checked @endif>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-span-6 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">2C - GRANDES OPACIDADES</p>
                    <div>
                        <table class="mt-2" style="width: 100%;" border="0" cellspacing="0px" cellpadding="0px">
                            <tr>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[2c][go][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[2c][go][n0]" value="1" class="input border" @if ($reportResults['2c']['go']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>A</p>
                                    <input type="hidden"   name="order_item_report[2c][go][na]" value="0">
                                    <input type="checkbox" name="order_item_report[2c][go][na]" value="1" class="input border" @if ($reportResults['2c']['go']['na'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>B</p>
                                    <input type="hidden"   name="order_item_report[2c][go][nb]" value="0">
                                    <input type="checkbox" name="order_item_report[2c][go][nb]" value="1" class="input border" @if ($reportResults['2c']['go']['nb'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>C</p>
                                    <input type="hidden"   name="order_item_report[2c][go][nc]" value="0">
                                    <input type="checkbox" name="order_item_report[2c][go][nc]" value="1" class="input border" @if ($reportResults['2c']['go']['nc'] ?? false) checked @endif>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">
                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">3A - ALGUMA ANORMALIDADE DE PARÊNQUIMA CONSISTENTE COM PNEUMOCONIOSE?</p>
                    <select id="order_item_report_3a" name="order_item_report[3a]" class="input w-40 border flex-1 mt-1" aria-required="" required>
                    <option value=""> -- </option>
                    @foreach (['SIM', 'NÃO'] as $item)
                    <option value="{{$item}}" @if ( $item == old('order_item_report[3a]', $reportResults['3a'] ?? false ) ) selected @endif>{{$item}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">
                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">3B - PLACAS PLEURAIS?</p>
                    <div class="mt-2">
                        <table class="bg-white" style="width: 100%;" cellspacing="0px" cellpadding="0px">
                            <tr>
                                <td class="p-1 text-center text-xs" style="width: 20%" colspan="4">LOCAL</td>
                                <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 20%" colspan="3">CALCIFICA&Ccedil;&Atilde;O</td>
                                <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 22%" colspan="7">
                                    <p>EXTENS&Atilde;O PAREDE</p>
                                    <p>(combinado com perfil e frontal)</p>
                                </td>
                                <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 22%;" colspan="8">
                                    <p>LARGURA "OPCIONAL"</p>
                                    <p>(min de 3 mm para marca&ccedil;&atilde;o)</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Parede em perfil</td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][ppl][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppl][n0]" value="1" class="input border" @if ($reportResults['3b']['ppl']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][ppl][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppl][nd]" value="1" class="input border" @if ($reportResults['3b']['ppl']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][ppl][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppl][ne]" value="1" class="input border" @if ($reportResults['3b']['ppl']['ne'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][ppc][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppc][n0]" value="1" class="input border" @if ($reportResults['3b']['ppc']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][ppc][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppc][nd]" value="1" class="input border" @if ($reportResults['3b']['ppc']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][ppc][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppc][ne]" value="1" class="input border" @if ($reportResults['3b']['ppc']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][ppep][c1n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppep][c1n0]" value="1" class="input border" @if ($reportResults['3b']['ppep']['c1n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][ppep][c2nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppep][c2nd]" value="1" class="input border" @if ($reportResults['3b']['ppep']['c2nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" colspan="3">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][ppep][c6n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppep][c6n0]" value="1" class="input border" @if ($reportResults['3b']['ppep']['c6n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][ppep][c7ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][ppep][c7ne]" value="1" class="input border" @if ($reportResults['3b']['ppep']['c7ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][pplo][c1nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][pplo][c1nd]" value="1" class="input border" @if ($reportResults['3b']['pplo']['c1nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" colspan="6">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][pplo][c7ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][pplo][c7ne]" value="1" class="input border" @if ($reportResults['3b']['pplo']['c7ne'] ?? false) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Frontal</td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][fl][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fl][n0]" value="1" class="input border" @if ($reportResults['3b']['fl']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][fl][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fl][nd]" value="1" class="input border" @if ($reportResults['3b']['fl']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][fl][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fl][ne]" value="1" class="input border" @if ($reportResults['3b']['fl']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][fc][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fc][n0]" value="1" class="input border" @if ($reportResults['3b']['fc']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][fc][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fc][nd]" value="1" class="input border" @if ($reportResults['3b']['fc']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][fc][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fc][ne]" value="1" class="input border" @if ($reportResults['3b']['fc']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>1</p>
                                    <input type="hidden"   name="order_item_report[3b][fep][c1n1]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fep][c1n1]" value="1" class="input border" @if ($reportResults['3b']['fep']['c1n1'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>2</p>
                                    <input type="hidden"   name="order_item_report[3b][fep][c2n2]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fep][c2n2]" value="1" class="input border" @if ($reportResults['3b']['fep']['c2n2'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>3</p>
                                    <input type="hidden"   name="order_item_report[3b][fep][c3n3]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fep][c3n3]" value="1" class="input border" @if ($reportResults['3b']['fep']['c3n3'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>1</p>
                                    <input type="hidden"   name="order_item_report[3b][fep][c5n1]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fep][c5n1]" value="1" class="input border" @if ($reportResults['3b']['fep']['c5n1'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>2</p>
                                    <input type="hidden"   name="order_item_report[3b][fep][c6n2]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fep][c6n2]" value="1" class="input border" @if ($reportResults['3b']['fep']['c6n2'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>3</p>
                                    <input type="hidden"   name="order_item_report[3b][fep][c7n3]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][fep][c7n3]" value="1" class="input border" @if ($reportResults['3b']['fep']['c7n3'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>A</p>
                                    <input type="hidden"   name="order_item_report[3b][flo][c1na]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][flo][c1na]" value="1" class="input border" @if ($reportResults['3b']['flo']['c1na'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>B</p>
                                    <input type="hidden"   name="order_item_report[3b][flo][c2nb]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][flo][c2nb]" value="1" class="input border" @if ($reportResults['3b']['flo']['c2nb'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>C</p>
                                    <input type="hidden"   name="order_item_report[3b][flo][c3nc]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][flo][c3nc]" value="1" class="input border" @if ($reportResults['3b']['flo']['c3nc'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" colspan="2">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>A</p>
                                    <input type="hidden"   name="order_item_report[3b][flo][c5na]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][flo][c5na]" value="1" class="input border" @if ($reportResults['3b']['flo']['c5na'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>B</p>
                                    <input type="hidden"   name="order_item_report[3b][flo][c6nb]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][flo][c6nb]" value="1" class="input border" @if ($reportResults['3b']['flo']['c6nb'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>C</p>
                                    <input type="hidden"   name="order_item_report[3b][flo][c7nc]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][flo][c7nc]" value="1" class="input border" @if ($reportResults['3b']['flo']['c7nc'] ?? false) checked @endif>
                                </td>
                            </tr>

                            <tr>
                                <td class="p-1 text-center text-xs">Diafragma</td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][dl][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][dl][n0]" value="1" class="input border" @if ($reportResults['3b']['dl']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][dl][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][dl][nd]" value="1" class="input border" @if ($reportResults['3b']['dl']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][dl][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][dl][ne]" value="1" class="input border" @if ($reportResults['3b']['dl']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][dc][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][dc][n0]" value="1" class="input border" @if ($reportResults['3b']['dc']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][dc][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][dc][nd]" value="1" class="input border" @if ($reportResults['3b']['dc']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][dc][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][dc][ne]" value="1" class="input border" @if ($reportResults['3b']['dc']['ne'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center text-xs" colspan="7" rowspan="2">
                                    <p>At&eacute; 1/4 da parede lateral = 1</p>
                                    <p>1/4 a 1/2 da parede lateral = 2</p>
                                    <p>&gt; 1/2 da parede lateral = 3</p>
                                </td>
                                <td class="p-1 text-center text-xs" colspan="8" rowspan="2">
                                    <p>3 a 5mm = a</p>
                                    <p>5 a 10mm = b</p>
                                    <p>&gt; 10mm = c</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Outros locais</td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][oll][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][oll][n0]" value="1" class="input border" @if ($reportResults['3b']['oll']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][oll][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][oll][nd]" value="1" class="input border" @if ($reportResults['3b']['oll']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][oll][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][oll][ne]" value="1" class="input border" @if ($reportResults['3b']['oll']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3b][olc][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][olc][n0]" value="1" class="input border" @if ($reportResults['3b']['olc']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3b][olc][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][olc][nd]" value="1" class="input border" @if ($reportResults['3b']['olc']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3b][olc][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3b][olc][ne]" value="1" class="input border" @if ($reportResults['3b']['olc']['ne'] ?? false) checked @endif>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">
                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">3C - OBLITERAÇÃO DO SEIO COSTOFRÊNICO.</p>
                    <div class="flex gap-2 mt-2">
                        <div class="text-center border bg-white px-2">
                            <p>0</p>
                            <input type="hidden"   name="order_item_report[3c][n0]" value="0">
                            <input type="checkbox" name="order_item_report[3c][n0]" value="1" class="input border" @if ($reportResults['3c']['n0'] ?? false) checked @endif>
                        </div>
                        <p class="text-3xl font-light">/</p>
                        <div class="text-center border bg-white px-2">
                            <p>D</p>
                            <input type="hidden"   name="order_item_report[3c][nd]" value="0">
                            <input type="checkbox" name="order_item_report[3c][nd]" value="1" class="input border" @if ($reportResults['3c']['nd'] ?? false) checked @endif>
                        </div>
                        <p class="text-3xl font-light">/</p>
                        <div class="text-center border bg-white px-2">
                            <p>E</p>
                            <input type="hidden"   name="order_item_report[3c][ne]" value="0">
                            <input type="checkbox" name="order_item_report[3c][ne]" value="1" class="input border" @if ($reportResults['3c']['ne'] ?? false) checked @endif>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">
                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <div class="flex gap-2">
                        <p class="text-gray-600 text-xs uppercase">3D - ESPESSAMENTO PLEURAL DIFUSO?</p>
                        <div class="flex">
                            <input type="radio" id="order_item_report_3d_check_s" name="order_item_report[3d][check]" value="S" class="mt-1 mr-1" required="required" @if (($reportResults['3d']['check'] ?? false) == 'S') checked @endif/> SIM
                            <div class="-mt-1 px-1 text-lg font-light">/</div>
                            <input type="radio" id="order_item_report_3d_check_n" name="order_item_report[3d][check]" value="N" class="mt-1 mr-1" required="required" @if (($reportResults['3d']['check'] ?? false) == 'N') checked @endif/> NÃO
                        </div>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <table class="" style="width: 100%;" border="0" cellspacing="0px" cellpadding="0px">
                            <tr>
                                <td class="p-1 text-center text-xs" style="width: 20%" colspan="4">LOCAL</td>
                                <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 20%" colspan="3">CALCIFICA&Ccedil;&Atilde;O</td>
                                <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 22%" colspan="7">
                                    <p>EXTENS&Atilde;O PAREDE</p>
                                    <p>(combinado com perfil e frontal)</p>
                                </td>
                                <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 22%;" colspan="8">
                                    <p>LARGURA "OPCIONAL"</p>
                                    <p>(min de 3 mm para marca&ccedil;&atilde;o)</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Parede em perfil</td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3d][ppl][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppl][n0]" value="1" class="input border" @if ($reportResults['3d']['ppl']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3d][ppl][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppl][nd]" value="1" class="input border" @if ($reportResults['3d']['ppl']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3d][ppl][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppl][ne]" value="1" class="input border" @if ($reportResults['3d']['ppl']['ne'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3d][ppc][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppc][n0]" value="1" class="input border" @if ($reportResults['3d']['ppc']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3d][ppc][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppc][nd]" value="1" class="input border" @if ($reportResults['3d']['ppc']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3d][ppc][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppc][ne]" value="1" class="input border" @if ($reportResults['3d']['ppc']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3d][ppep][c1n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppep][c1n0]" value="1" class="input border" @if ($reportResults['3d']['ppep']['c1n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3d][ppep][c2nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppep][c2nd]" value="1" class="input border" @if ($reportResults['3d']['ppep']['c2nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" colspan="3">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3d][ppep][c6n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppep][c6n0]" value="1" class="input border" @if ($reportResults['3d']['ppep']['c6n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3d][ppep][c7ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][ppep][c7ne]" value="1" class="input border" @if ($reportResults['3d']['ppep']['c7ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3d][pplo][c1nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][pplo][c1nd]" value="1" class="input border" @if ($reportResults['3d']['pplo']['c1nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" colspan="6">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3d][pplo][c7ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][pplo][c7ne]" value="1" class="input border" @if ($reportResults['3d']['pplo']['c7ne'] ?? false) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Frontal</td>
                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3d][fl][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fl][n0]" value="1" class="input border" @if ($reportResults['3d']['fl']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3d][fl][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fl][nd]" value="1" class="input border" @if ($reportResults['3d']['fl']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3d][fl][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fl][ne]" value="1" class="input border" @if ($reportResults['3d']['fl']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>0</p>
                                    <input type="hidden"   name="order_item_report[3d][fc][n0]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fc][n0]" value="1" class="input border" @if ($reportResults['3d']['fc']['n0'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>D</p>
                                    <input type="hidden"   name="order_item_report[3d][fc][nd]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fc][nd]" value="1" class="input border" @if ($reportResults['3d']['fc']['nd'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>E</p>
                                    <input type="hidden"   name="order_item_report[3d][fc][ne]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fc][ne]" value="1" class="input border" @if ($reportResults['3d']['fc']['ne'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>1</p>
                                    <input type="hidden"   name="order_item_report[3d][fep][c1n1]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fep][c1n1]" value="1" class="input border" @if ($reportResults['3d']['fep']['c1n1'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>2</p>
                                    <input type="hidden"   name="order_item_report[3d][fep][c2n2]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fep][c2n2]" value="1" class="input border" @if ($reportResults['3d']['fep']['c2n2'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>3</p>
                                    <input type="hidden"   name="order_item_report[3d][fep][c3n3]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fep][c3n3]" value="1" class="input border" @if ($reportResults['3d']['fep']['c3n3'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>1</p>
                                    <input type="hidden"   name="order_item_report[3d][fep][c5n1]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fep][c5n1]" value="1" class="input border" @if ($reportResults['3d']['fep']['c5n1'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>2</p>
                                    <input type="hidden"   name="order_item_report[3d][fep][c6n2]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fep][c6n2]" value="1" class="input border" @if ($reportResults['3d']['fep']['c6n2'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>3</p>
                                    <input type="hidden"   name="order_item_report[3d][fep][c7n3]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][fep][c7n3]" value="1" class="input border" @if ($reportResults['3d']['fep']['c7n3'] ?? false) checked @endif>
                                </td>

                                <td class="p-1 text-center">
                                    <p>A</p>
                                    <input type="hidden"   name="order_item_report[3d][flo][c1na]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][flo][c1na]" value="1" class="input border" @if ($reportResults['3d']['flo']['c1na'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>B</p>
                                    <input type="hidden"   name="order_item_report[3d][flo][c2nb]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][flo][c2nb]" value="1" class="input border" @if ($reportResults['3d']['flo']['c2nb'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>C</p>
                                    <input type="hidden"   name="order_item_report[3d][flo][c3nc]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][flo][c3nc]" value="1" class="input border" @if ($reportResults['3d']['flo']['c3nc'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center" colspan="2">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center">
                                    <p>A</p>
                                    <input type="hidden"   name="order_item_report[3d][flo][c5na]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][flo][c5na]" value="1" class="input border" @if ($reportResults['3d']['flo']['c5na'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>B</p>
                                    <input type="hidden"   name="order_item_report[3d][flo][c6nb]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][flo][c6nb]" value="1" class="input border" @if ($reportResults['3d']['flo']['c6nb'] ?? false) checked @endif>
                                </td>
                                <td class="p-1 text-center">
                                    <p>C</p>
                                    <input type="hidden"   name="order_item_report[3d][flo][c7nc]" value="0">
                                    <input type="checkbox" name="order_item_report[3d][flo][c7nc]" value="1" class="input border" @if ($reportResults['3d']['flo']['c7nc'] ?? false) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs" colspan="4" rowspan="2">&nbsp;</td>
                                <td class="p-1 text-center text-xs" colspan="3" rowspan="2">&nbsp;</td>
                                <td class="p-1 text-center text-xs" colspan="7" rowspan="2">
                                    <p>At&eacute; 1/4 da parede lateral = 1</p>
                                    <p>1/4 a 1/2 da parede lateral = 2</p>
                                    <p>&gt; 1/2 da parede lateral = 3</p>
                                </td>
                                <td class="p-1 text-center text-xs" colspan="8" rowspan="2">
                                    <p>3 a 5mm = a</p>
                                    <p>5 a 10mm = b</p>
                                    <p>&gt; 10mm = c</p>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">
                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">4A - OUTRAS ANORMALIDADES?</p>
                    <select id="order_item_report_4a" name="order_item_report[4a]" class="input w-40 border flex-1 mt-1" aria-required="" required>
                    <option value=""> -- </option>
                    @foreach (['SIM', 'NÃO'] as $item)
                    <option value="{{$item}}" @if ( $item == old('order_item_report[4a]', $reportResults['4a'] ?? false ) ) selected @endif>{{$item}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">
                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">4B - SÍMBOLOS</p>
                    <div class="mt-1 gap-2">
                        @foreach (['AA','AT','AX','BU','CA','CG','CN','CO','CP','CV','DI','EF','EM','ES','FR','HI','HO','ID','IH','KL','ME','PA','PB','PI','PX','RA','RP','TB'] as $item)
                            <div class="inline-block border pl-2 bg-white">
                                <label class="flex cursor-pointer select-none" for="order_item_report[4b][{{$item}}]">{{__($item)}}</label>
                                <input type="hidden"   name="order_item_report[4b][{{$item}}]" value="0">
                                <input type="checkbox" name="order_item_report[4b][{{$item}}]" value="1" id="order_item_report[4b][{{$item}}]" class="input border mr-2" @if ($reportResults['4b'][$item] ?? false) checked @endif>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-2 mx-2">
                <div class="col-span-12 mt-4 py-2 px-4 bg-gray-100 rounded-sm text-sm border border-gray-300 shadow">
                    <p class="text-gray-600 text-xs uppercase">4C - COMENTÁRIOS</p>
                    <input id="order_item_report[4c_comentarios]" name="order_item_report[4c_comentarios]" value="{{ old('order_item_report[4c_comentarios]') }}" class="input w-full border flex-1 mt-1">
                </div>
            </div>

            <!--  -->
            <div class="grid grid-cols-1 gap-2 my-4 mx-2 rounded-sm text-sm">

                <div>
                    <p class="text-gray-600 py-1">
                        {{__('Report Comments')}}
                        <span class="text-xs text-red-800 font-light">{{__('Only seen internally')}}</span>
                    </p>
                    <input type="text" name="report_results_comments" id="report_results_comments" value="{{old('report_results_comments',$orderItem->ConclusionReport->report_results_comments)}}" placeholder="{{__('Comments')}}" class="input w-full border">
                </div>
                <div class="text-right my-4">
                    {{-- <a href="javascript:;" data-toggle="modal" data-target="#success-modal-preview-complete-report" class="button w-24 bg-theme-1 text-white">
                        {{__('Complete Report')}}
                    </a> --}}
                    <button type="submit" href="javascript:;" data-toggle="modal" data-target="#success-modal-preview-complete-report" class="button bg-theme-1 text-white">
                        {{__('Complete Report')}}
                    </button>
                </div>
                <!-- -->
                <div class="modal" id="success-modal-preview-complete-report">
                    <div class="modal__content">
                        <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                            <div class="text-2xl mt-5">{{__('Confirm finish')}}</div>
                        </div>
                        <div class="px-16 pb-8 text-center flex">
                            <button type="button" data-dismiss="modal" class="m-2 button w-full border text-gray-700 dark:border-dark-5 dark:text-gray-300">{{__('Cancel')}}</button>
                            {{-- <button type="submit" onclick="submitReport('form-complete-report')" class="m-2 button w-full bg-green-600 text-white">{{__('Conclude')}}</button> --}}
                            <button type="submit" class="m-2 button w-full bg-green-600 text-white">{{__('Conclude')}}</button>
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

        var order_item_report_1b = document.getElementById("order_item_report_1b");

        order_item_report_1b.addEventListener('change', (event) => {

            document.getElementById("order_item_report_2a").value = '';
            document.getElementById("order_item_report_3a").value = '';
            document.getElementById("order_item_report_4a").value = '';
            //
            document.getElementById("order_item_report_3d_check_s").checked = false;
            document.getElementById("order_item_report_3d_check_n").checked = false;

            var value = document.getElementById('order_item_report_1b').value;

            if(value == 'SIM')
            {
                document.getElementById("order_item_report_2a").value = 'NÃO';
                document.getElementById("order_item_report_3a").value = 'NÃO';
                document.getElementById("order_item_report_4a").value = 'NÃO';
                //
                document.getElementById("order_item_report_3d_check_n").checked = true;
            }
        });

        $(document).ready( function ()
        {
            divShowHide('div-anexos','show');
        });
    </script>
@endsection
