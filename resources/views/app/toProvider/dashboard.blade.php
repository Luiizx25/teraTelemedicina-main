@extends('_layout.side-menu',[
    'title' => 'Dashboard',
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">

            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-2">

                {{-- <div class="intro-y flex items-end h-10">
                    <a href="{{ route('toProvider.dashboard') }}" class="ml-auto flex text-theme-1 dark:text-theme-10 hover:text-yellow-700 hover:font-semibold">
                        <i data-feather="refresh-ccw" class="w-5 h-5 mr-2"></i>
                    </a>
                </div> --}}
                @php

                // dd(
                //     $provider->toArray(),
                //     $provider->OrderItemReports->toArray(),
                //     $provider->OrderItemReports->where('report_status_id',6),
                //     $provider->OrderItemReports->where('report_status_id',10),
                // );

                $atentidimentos    = $provider->OrderItemReports->whereIn('report_status_id',[6,10]);
                $reportsConcluidas = $atentidimentos->where('report_status_id', 10); // 10.CONCLUIDAS
                $reportsDevolvidos = $atentidimentos->where('report_status_id', 6); // 6.DEVOLVIDOS

                // ATENDIMENTOS
                $totalConcluidas    = $atentidimentos->count();

                // Concluida CICLO
                $totalConcluidaCiclo      = $reportsConcluidas->where('report_cycle', $ciclo)->count();
                $totalConcluidaCicloAnt   = $reportsConcluidas->where('report_cycle', $cicloAnt)->count();
                $percentConcluidaCicloAnt = ($totalConcluidaCicloAnt == 0) ? 100 : ($totalConcluidaCiclo * 100) / $totalConcluidaCicloAnt;
                //
                if($totalConcluidaCicloAnt > $totalConcluidaCiclo)
                    $percentConcluidaCicloAnt = $percentConcluidaCicloAnt * (-1);

                // DEVOLVIDO CICLO
                $totalDevolvidoCiclo      = $reportsDevolvidos->where('report_cycle', $ciclo)->count();
                $totalDevolvidoCicloAnt   = $reportsDevolvidos->where('report_cycle', $cicloAnt)->count();
                $percentDevolvidoCicloAnt = ($totalDevolvidoCicloAnt == 0) ? 100 : ($totalDevolvidoCiclo * 100) / $totalDevolvidoCicloAnt;
                //
                if($totalDevolvidoCicloAnt > $totalDevolvidoCiclo)
                    $percentDevolvidoCicloAnt = $percentDevolvidoCicloAnt * (-1);

                @endphp
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                </div>
                                <div class="text-2xl font-bold leading-8 mt-6">{{ $totalConcluidas ?? '--' }}</div>
                                <div class="text-base text-gray-600 mt-1">{{ __('Total atendimentos') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="check-square" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                        @if ($percentConcluidaCicloAnt > 0)
                                            <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="{{ $percentConcluidaCicloAnt }}% em relação ao ciclo anterior ({{ $totalConcluidaCicloAnt }} concluídas)">
                                                {{ $percentConcluidaCicloAnt }}% <i data-feather="chevron-up" class="w-4 h-4 mx-1"></i>
                                            </div>
                                        @elseif ($percentConcluidaCicloAnt < 0)
                                            <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="{{ $percentConcluidaCicloAnt }}% em relação ao ciclo anterior ({{ $totalConcluidaCicloAnt }} concluídas)">
                                                {{ $percentConcluidaCicloAnt }}% <i data-feather="chevron-down" class="w-4 h-4 mx-1"></i>
                                            </div>
                                        @else
                                            <div class="report-box__indicator bg-gray-500 tooltip cursor-pointer px-2" title="{{ $percentConcluidaCicloAnt }}% em relação ao ciclo anterior ({{ $totalConcluidaCicloAnt }} concluídas)">
                                                {{ $percentConcluidaCicloAnt }}% <i data-feather="minus" class="w-4 h-4 mx-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-2xl font-bold leading-8 mt-6">{{ $totalConcluidaCiclo }}</div>
                                <div class="text-base text-gray-600 mt-1">{{ __('Concluídas no ciclo') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="rewind" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                        @if ($percentDevolvidoCicloAnt > 0)
                                            <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="{{ $percentDevolvidoCicloAnt }}% em relação ao ciclo anterior ({{ $totalDevolvidoCicloAnt }} devolvidas)">
                                                {{ $percentDevolvidoCicloAnt }}% <i data-feather="chevron-up" class="w-4 h-4 mx-1"></i>
                                            </div>
                                        @elseif ($percentDevolvidoCicloAnt < 0)
                                            <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="{{ $percentDevolvidoCicloAnt }}% em relação ao ciclo anterior ({{ $totalDevolvidoCicloAnt }} devolvidas)">
                                                {{ $percentDevolvidoCicloAnt }}% <i data-feather="chevron-down" class="w-4 h-4 mx-1"></i>
                                            </div>
                                        @else
                                            <div class="report-box__indicator bg-gray-500 tooltip cursor-pointer px-2" title="{{ $percentDevolvidoCicloAnt }}% em relação ao ciclo anterior ({{ $totalDevolvidoCicloAnt }} devolvidas)">
                                                {{ $percentDevolvidoCicloAnt }}% <i data-feather="minus" class="w-4 h-4 mx-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-2xl font-bold leading-8 mt-6">{{ $totalDevolvidoCiclo }}</div>
                                <div class="text-base text-gray-600 mt-1">{{ __('Devolvidos no ciclo') }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: General Report -->
        </div>
        <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
            <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                <!-- BEGIN: Important Notes -->
                <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-2xl font-medium truncate mr-auto">Últimos atendimentos</h2>
                        <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600 mr-2">
                            <i data-feather="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600">
                            <i data-feather="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="mt-5 intro-x">
                        <div class="box zoom-in">
                            <div class="tiny-slider" id="important-notes">
                                @php
                                    $reports = $reportsConcluidas->where('report_cycle', $ciclo)->sortBy('updated_at',SORT_REGULAR,true)->take(10)->keyBy('updated_at');
                                @endphp
                                @forelse ($reports as $report)
                                {{-- {{dd(
                                    $report->status->toArray(),
                                    $report->orderItem->service->toArray(),
                                    $report->orderItem->toArray(),
                                    )}} --}}
                                    <div class="p-5">
                                        <div class="flex justify-between mb-2">
                                            <div>
                                                <div class="text-xl font-semibold">{{ $report->orderItem->service->service_name ?? '--' }}</div>
                                                <div class="font-light">{{ $report->updated_at->format('d/m/Y H:i') }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xs font-medium">Ciclo</div>
                                                <div class="text-base text-gray-500">{{ $report->report_cycle ??'--' }}</div>
                                            </div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div>
                                                <div class="text-gray-500">Pedido</div>
                                                <div class="text-gray-600 text-justify">{{ $report->orderItem->item_num ?? '--' }}</div>
                                            </div>
                                            <div class="pt-4">
                                                <a href="{{ route('toProvider.orderItem.show',[ 'orderItemNum' => $report->orderItem->item_num,'reportId' => $report->id ]) }}" class="bg-{{ $report->status->ref_color_bg ?? 'gray-100' }} text-{{ $report->status->ref_color ?? 'gray-800' }} font-semi-bold rounded shadow hover:shadow-md p-2 uppercase align-bottom" title="Clique para abrir">
                                                    {{ $report->status->ref_placeholder ?? 'ABRIR' }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-5">
                                        Nenhum atendimento concluído ainda
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Important Notes -->
            </div>
        </div>
    </div>
@endsection
