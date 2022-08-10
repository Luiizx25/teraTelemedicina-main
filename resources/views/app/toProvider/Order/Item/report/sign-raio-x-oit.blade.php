@extends('_layout.side-menu',[
    'title' => __('Answer RAIO X OIT'),
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
                RAIO X OIT
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
        $report_results = unserialize($orderItem->ConclusionReport->report_results);
        // dd($report_results);
    @endphp
    <div class="mt-4 p-6 bg-white rounded shadow">
        @foreach ($report_results as $field => $value)
            <div class="bg-gray-100 rounded-sm mb-4 p-2">
                <p class="text-gray-600 text-xs uppercase">{{__($field)}}</p>
                @if (is_array($value))
                    @if ($field == '2b')
                        <table class="mt-2 bg-white" style="width: 100%;" cellspacing="0px" cellpadding="0px">
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
                                    <td class="p-1 text-center align-top">D</td>
                                    <td class="p-1 text-center align-top">E</td>
                                    <td class="p-1 text-center align-top">0/-</td>
                                    <td class="p-1 text-center align-top">0/0</td>
                                    <td class="p-1 text-center align-top">0/1</td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center align-top">
                                        <p>p</p>
                                        @if ($value['ftp']['p'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>s</p>
                                        @if ($value['ftp']['s'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>p</p>
                                        @if ($value['fts']['p'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>s</p>
                                        @if ($value['fts']['s'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>Superior</p>
                                        @if ($value['zd']['superior'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>Superior</p>
                                        @if ($value['ze']['superior'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>1/0</p>
                                        @if ($value['p']['10'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>1/1</p>
                                        @if ($value['p']['11'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>1/2</p>
                                        @if ($value['p']['12'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center align-top">
                                        <p>q</p>
                                        @if ($value['fts']['q'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>t</p>
                                        @if ($value['fts']['t'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>q</p>
                                        @if ($value['fts']['q'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>t</p>
                                        @if ($value['fts']['t'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>Médio</p>
                                        @if ($value['zd']['medio'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>Médio</p>
                                        @if ($value['ze']['medio'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>2/1</p>
                                        @if ($value['p']['21'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>2/2</p>
                                        @if ($value['p']['22'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>2/3</p>
                                        @if ($value['p']['23'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center align-top">
                                        <p>r</p>
                                        @if ($value['ftp']['r'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>u</p>
                                        @if ($value['ftp']['u'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>r</p>
                                        @if ($value['fts']['r'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>u</p>
                                        @if ($value['fts']['u'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>Inferior</p>
                                        @if ($value['zd']['inferior'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>Inferior</p>
                                        @if ($value['ze']['inferior'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>3/2</p>
                                        @if ($value['p']['32'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>3/3</p>
                                        @if ($value['p']['33'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        <p>3/+</p>
                                        @if ($value['p']['3'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @elseif ($field == '2c')
                        <table class="mt-2" style="width: 100%;" border="0" cellspacing="0px" cellpadding="0px">
                            <tr>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>0</p>
                                    @if ($value['go']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>A</p>
                                    @if ($value['go']['na'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>B</p>
                                    @if ($value['go']['nb'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    <p>C</p>
                                    @if ($value['go']['nc'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                            </tr>
                        </table>
                    @elseif ($field == '3b')
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
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppl']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['ppl']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['ppl']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppc']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['ppc']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['ppc']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppep']['c1n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['ppep']['c2nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" colspan="3">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppep']['c6n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['ppep']['c7ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['pplo']['c1nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" colspan="6">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['pplo']['c7ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Frontal</td>
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['fl']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['fl']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['fl']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['fc']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['fc']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['fc']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>1</p>
                                    @if ($value['fep']['c1n1'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>2</p>
                                    @if ($value['fep']['c2n2'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>3</p>
                                    @if ($value['fep']['c3n3'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>1</p>
                                    @if ($value['fep']['c5n1'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>2</p>
                                    @if ($value['fep']['c6n2'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>3</p>
                                    @if ($value['fep']['c7n3'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>A</p>
                                    @if ($value['flo']['c1na'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>B</p>
                                    @if ($value['flo']['c2nb'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>C</p>
                                    @if ($value['flo']['c3nc'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" colspan="2">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>A</p>
                                    @if ($value['flo']['c5na'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>B</p>
                                    @if ($value['flo']['c6nb'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>C</p>
                                    @if ($value['flo']['c7nc'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="p-1 text-center text-xs">Diafragma</td>
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['dl']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['dl']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['dl']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['dc']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['dc']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['dc']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
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
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['oll']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['oll']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['oll']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['olc']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['olc']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['olc']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                            </tr>
                        </table>
                    @elseif ($field == '3c')
                        <div class="flex gap-2 mt-2">
                            <div class="text-center border bg-white px-2">
                                <p>0</p>
                                @if ($value['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                            </div>
                            <p class="text-3xl font-light">/</p>
                            <div class="text-center border bg-white px-2">
                                <p>D</p>
                                @if ($value['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                            </div>
                            <p class="text-3xl font-light">/</p>
                            <div class="text-center border bg-white px-2">
                                <p>E</p>
                                @if ($value['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                            </div>
                        </div>
                    @elseif ($field == '3d')
                        <p class="font-bold">
                            @if (in_array(($value['check'] ?? false),['S','SIM']))
                                <input value="SIM" class="input w-full border flex-1 mt-1" readonly>
                            @elseif (in_array(($value['check'] ?? false),['N','NÃO']))
                                <input value="NÃO" class="input w-full border flex-1 mt-1" readonly>
                            @else
                                <input value="--" class="input w-full border flex-1 mt-1" readonly>
                            @endif
                        </p>
                        <table class="mt-2" style="width: 100%;" border="0" cellspacing="0px" cellpadding="0px">
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
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppl']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['ppl']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['ppl']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppc']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['ppc']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['ppc']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppep']['c1n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['ppep']['c2nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" colspan="3">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['ppep']['c6n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['ppep']['c7ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['pplo']['c1nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" colspan="6">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['pplo']['c7ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Frontal</td>
                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['fl']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['fl']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['fl']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>0</p>
                                    @if ($value['fc']['n0'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>D</p>
                                    @if ($value['fc']['nd'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>E</p>
                                    @if ($value['fc']['ne'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>1</p>
                                    @if ($value['fep']['c1n1'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>2</p>
                                    @if ($value['fep']['c2n2'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>3</p>
                                    @if ($value['fep']['c3n3'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>1</p>
                                    @if ($value['fep']['c5n1'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>2</p>
                                    @if ($value['fep']['c6n2'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>3</p>
                                    @if ($value['fep']['c7n3'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    <p>A</p>
                                    @if ($value['flo']['c1na'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>B</p>
                                    @if ($value['flo']['c2nb'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>C</p>
                                    @if ($value['flo']['c3nc'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center" colspan="2">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>A</p>
                                    @if ($value['flo']['c5na'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>B</p>
                                    @if ($value['flo']['c6nb'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    <p>C</p>
                                    @if ($value['flo']['c7nc'] ?? false)<p class="text-lg font-bold">x</p>@else <p>&nbsp;</p> @endif
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
                    @elseif ($field == '4b')
                        <div class="mt-1 gap-2">
                        @foreach ($value as $key => $item)
                            <div class="inline-block border px-2 bg-white text-center">
                                <p>{{__($key)}}</p>
                                <p class="text-lg font-bold">@if ($item ?? false) X @else &nbsp; @endif</p>
                            </div>
                        @endforeach
                        </div>
                    @else
                        @dump($field)
                        @dump($value)
                    @endif
                @else
                    <input value="{{ __($value) }}" class="input w-full border flex-1 mt-1" readonly>
                @endif
            </div>




            @continue
            @if ($field == '4b')
                <div class="bg-gray-100 rounded-sm mb-4 p-2">
                    <p class="text-gray-600 text-xs uppercase">{{__($field ?? '--')}}</p>
                    @foreach ($value as $field4b => $value4b)
                        <div class="inline-block border w-8 p-1 m-2 text-xs text-center uppercase @if ($value4b ?? false)
                            bg-gray-500 text-white
                        @else
                            bg-white text-gray-600
                        @endif">
                            <p>{{__($field4b ?? '--')}}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-100 rounded-sm mb-4 p-2">
                    <p class="text-gray-600 text-xs uppercase">{{__($field ?? '--')}}</p>
                    <input value="{{ __($value ?? '--') }}" class="input w-full border flex-1 mt-1" readonly>
                </div>
            @endif
        @endforeach

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
