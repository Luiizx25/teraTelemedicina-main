@extends('_layout.side-menu',[
    'title' => __('Answer'),
    'useJquery' => false,
    'useDataTable' => false,
])

@section('subcontent')
    @php
        $itemStatusIdList = [50,90];
        // dd($provider->OrderItems->toArray());

        //
        //dd($providers);
        //dd($simulated);

    @endphp

    @if($providers ?? false)
        <!--  -->
        <div class="intro-y col-span-12 lg:col-span-8 mt-4">
            <div class="grid grid-cols-1 gap-2">
                @foreach($providers as $provider)
                <a href="{{ route('toProvider.orderItem.answer',['providerSlug'=>$provider->pvd_slug]) }}">
                    <div class="box p-2 captalize">
                        {{ $provider->user->name }}
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <!--  -->
    @else
        <!--  -->
        @if ($provider->OrderItems->whereIn('item_status_id',$itemStatusIdList)->count())
            <div class="text-2xl font-bold leading-8 mt-4 mb-1 p-2 intro-y">
                {{__('Itens in progress')}}
            </div>

            <div class="intro-y col-span-12 lg:col-span-8">
                <div class="grid grid-cols-1 gap-2">
                    @forelse ($provider->OrderItems->whereIn('item_status_id',$itemStatusIdList) as $OrderItem)
                        <div class="box p-2">
                            <div class="grid grid-cols-1 lg:grid-cols-6 gap-2">
                                <div class="text-center text-base text-gray-600">
                                    {{ $OrderItem->item_start_datetime->format('d/m/Y H:i') }}
                                </div>
                                <div class="col-span-3 text-base text-gray-800 font-semibold">
                                    {{ $OrderItem->Service->service_name }}
                                    @if($OrderItem->serviceVariation ?? false)
                                        - {{ $OrderItem->serviceVariation->variation_name }}
                                    @endif
                                </div>
                                <div class="col-span-2 flex text-right">
                                    <div class="text-center bg-gray-200 rounded mr-2 py-1 h-full w-full">
                                        {{ $OrderItem->status->ref_description }}
                                    </div>
                                    <div class="text-center">
                                        @php
                                            if($simulated)
                                                $param = ['orderItemNum'=>$OrderItem->item_num, 'providerSlug' => $provider->pvd_slug];
                                            else
                                                $param = ['orderItemNum'=>$OrderItem->item_num];
                                        @endphp
                                        <a href="{{ route('toProvider.orderItem.report.process', $param) }}" data-toggle="modal" data-target="#success-modal-preview" class="flex items-center block p-1 transition duration-300 ease-in-out hover:text-orange-600 hover:shadow bg-white dark:bg-dark-1 dark:hover:bg-dark-2 rounded-md" title="{{__('Open')}}">
                                            <i data-feather="edit" class="w-5 h-5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="box p-4">
                            {{ __('No Items') }}
                        </div>
                    @endforelse
                    {{-- {{ dd($provider->OrderItems) }} --}}
                </div>
            </div>

        @else
            <div class="intro-y col-span-12 lg:col-span-8 mt-4">
                <div class="grid grid-cols-2 gap-2">
                @if($contract ?? false)
                    @forelse ($contract->contractService as $contractService)
                        @php
                            $orderItemsQtd = $contractService->service->orderItem()->whereIn('item_status_id',[40])->count(); // 40 - aguardando-atendimento
                        @endphp
                        @if ($orderItemsQtd)
                            @php
                                if($simulated)
                                    $param = ['serviceSlug'=>$contractService->service->service_slug, 'providerSlug' => $provider->pvd_slug];
                                else
                                    $param = ['serviceSlug'=>$contractService->service->service_slug];
                            @endphp
                            <a href="{{ route('toProvider.orderItem.answer', $param) }}" class="box hover:bg-theme-1 hover:text-white p-4 cursor-pointer zoom-out shadow-md">
                                <div class="">
                                    <div class="flex">
                                        <i data-feather="activity" class="w-6 h-6 mr-2 text-green-800"></i>
                                        <div class="font-medium text-base">{{$contractService->service->service_name}}</div>
                                    </div>
                                    <div class="ml-8 text-xs">{{$contractService->service->category->ref_description}}</div>
                                    <div class="text-gray-600 hover:text-white ml-8 text-center lg:text-left">
                                        {{$orderItemsQtd}} {{ ($orderItemsQtd == 1?__('Queued Item'):__('Queued Items')) }}
                                    </div>
                                </div>
                            </a>
                        @else
                            <div class="bg-red-100 box p-4 cursor-not-allowed shadow-md hover:text-red-500">
                                <div class="flex">
                                    <i data-feather="slash" class="w-6 h-6 mr-2 text-red-600"></i>
                                    <div class="font-medium text-base">{{$contractService->service->service_name}}</div>
                                </div>
                                <div class="ml-8 text-xs">{{$contractService->service->category->ref_description}}</div>
                                <div class="ml-8 text-center lg:text-left">
                                    {{$orderItemsQtd}} {{ ($orderItemsQtd == 1?__('Queued Item'):__('Queued Items')) }}
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="box p-2">
                            {{__('No Service Contract')}}
                        </div>
                    @endforelse
                @else
                    SEM ITENS PARA EXIBIR
                @endif
                </div>
            </div>
        @endif
        <!--  -->
    @endif
@endsection

@section('script')
    <script>
        $(document).ready( function () {

        });
    </script>
@endsection
